<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Job;
use App\Country;
use App\City;
use App\Package;
use App\PricingRequest;
use App\UnlockWorker;
use App\FavWorker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\jobPostedNotfication;

use Illuminate\Http\Request;

class EmployerClientController extends Controller
{
    public function workers()
    {
        $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->get();
        $all_jobs = Job::where('employer_id', auth()->user()->id)->get();
        $opened_jobs = Job::where('employer_id', auth()->user()->id)->where('state', 0)->get();
        $data = array(
            'all_jobs' => $all_jobs,
            'opened_jobs' => $opened_jobs,
            'pricing' => $pricing
        );
    
        if(auth()->user()->role == 2){
            return view('companies.workers')->with($data);
        }elseif(auth()->user()->role == 1){
            return view('companies.workers')->with($data);
        }else{
            abort(404);
        }
    }

    public function packages()
    {
        if(auth()->user()->role != 0){
            $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->get();
            $requested = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 0)->first();
            $approved = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first();
    
            $extentions = Package::whereIn('role', [3,4])->get();
    
            $myExtentions = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3,4])->get();
            $exRequested = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3,4])->where('state', 0)->first();
            $exApproved = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3,4])->where('state', 1)->first();
        }
        

        
        
        if(auth()->user()->role == 3){
            $packages = Package::all();
        }elseif(auth()->user()->role == 2){
            $packages = Package::where('role', 1)->get();
        }elseif(auth()->user()->role == 1){
            $packages = Package::where('role', 2)->get();
        }
        if(auth()->user()->role == 1 || auth()->user()->role == 2){
            $data = array(
                'pricing' => $pricing,
                'packages' => $packages,
                'approved' => $approved,
                'requested' => $requested,
                'extentions' => $extentions,
                'myExtentions' => $myExtentions,
                'exRequested' => $exRequested,
                'exApproved' => $exApproved,
            );
        }
    
        if(auth()->user()->role == 2){
            return view('companies.packages')->with($data);
        }elseif(auth()->user()->role == 1){
            return view('companies.packages')->with($data);
        }else{
            abort(404);
        }
    }

  public function pricing_request(Request $request)
    {
        
        $myPricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->where('state', 1)->first();
        $myExtentions = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('state', [1,2])->get();
        $user = auth()->user();
        $data = array(
            'pricing' => $myPricing, 
            'myExtentions' => $myExtentions, 
            'user' => $user
        );
     
        if(auth()->user()->role == 1 ||  auth()->user()->role == 2){

            if($request->has('add-extention')){
                $package = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first();
                if($package){
                    $pricing = new PricingRequest;
                    $pricing->package_id = $request->input('package_id');
                    $pricing->profiles = $request->input('profiles');
                    $pricing->ads = $request->input('ads');
                    $pricing->user_id =  auth()->user()->id;
                    if($request->input('ads') != 0){
                        $pricing->role =  3;
                    }else{
                        $pricing->role =  4;
                    }
                    $pricing->state = 0;
                    $pricing->start_date = Carbon::now();
                    $pricing->expired_date = Carbon::now()->addDays($request->input('period'));
                    $pricing->save();
                    return view('companies.profile.my_package')->with($data);
                }else{
                    $data = array(
                        'pricing' => $myPricing, 
                        'myExtentions' => $myExtentions, 
                        'user' => $user,
                        'packages' => $packages,
                        'error' => trans('main.You Have To Subscribe A Package First, Go To ') .'<a href="/packages">' .trans('main.Packages') . '</a>'
                    );
                    return view('companies.profile.my_package')->with($data);
                }
                
            }else{
                $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first();
               
                if ($pricing){
                    $data = array(
                        'pricing' => $myPricing, 
                        'myExtentions' => $myExtentions, 
                        'user' => $user,
                        'success' => 'You are in A Package Already.'
                    );
                        return view('companies.profile.my_package')->with($data);
                }else{
                    $pricing = new PricingRequest;
                    $pricing->package_id = $request->input('package_id');
                    $pricing->profiles = $request->input('profiles');
                    $pricing->ads = $request->input('ads');
                    $pricing->user_id =  auth()->user()->id;
                    $pricing->role =  auth()->user()->role;
                    $pricing->state = 0;
                    $pricing->start_date = Carbon::now();
                    $pricing->expired_date = Carbon::now()->addDays($request->input('period'));
                    $pricing->save();
                  
                    return view('companies.profile.my_package')->with($data);
                }
            }
        }else{
            abort(404);
        } 
    }

    public function profileView(Request $request)
    {
        $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->first();
        $pricing->profiles = $pricing->profiles -1 ;
        if($pricing->profiles == 0){
            $pricing->profiles = $pricing->profiles;
        }
        $pricing->save();
        /*return Redirect::back()->with('success', 'Candidate Unlocked');*/
        return Redirect::to('profiles/'.$request->input('worker_id'))->with('success', 'Candidate Unlocked');

    }

    public function viewAs(){
        $user = User::find(auth()->user()->id);
        if(auth()->user()->role > 0){
            $data = array(
                'user' => $user
            );
            return view('companies.profile.view_as')->with($data);
        }else{
            abort(404);
        }
    }

    public function createJob()
    {
        if(auth()->user()->role == 2 || auth()->user()->role == 1){
            $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first();
            if($pricing){
                if($pricing->ads > 0){
                    $country = Country::pluck('name','id');
                    $job_country = Country::where('code',auth()->user()->country)->first();
                    if($job_country != null){
                        $job_city =  City::where('country_id',$job_country->id)->pluck('name','id');
                    }else{
                        $job_city =[];
                    }
                    return view('companies.post_job', compact('country', 'job_city'));
                }else{
                    $extentions = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3])->where('state', 1)->get();
                    if(count($extentions) > 0){
                        foreach ($extentions as $key => $extention) {
                            if($extention->ads > 0){
                                $country = Country::pluck('name','id');
                                $job_country = Country::where('code',auth()->user()->country)->first();
                                if($job_country != null){
                                    $job_city =  City::where('country_id',$job_city->id)->pluck('name','id');
                                }else{
                                    $job_city =[];
                                }
                                return view('companies.post_job', compact('country', 'job_city'));
                            }else{
                                return REdirect::back()->with('error', trans('main.Your Job Package And Extention Is Finished.You Can Add Job Extention'));
                            }
                        }
                    }else{
                        return REdirect::back()->with('error', trans('main.Your Job Package Is Finished.You Can Add Job Extention'));
                    }
                }
            }else{
                return REdirect::back()->with('error', trans("main.Add Package and you can post a job, visit our").  '<a class="d-inline-block text-success" href="'.url("/packages").'">'. trans('main.Packages'). '</a>');
            }

        }else{
            abort(404);
        }
    }

    public function myPackage(Request $request)
    {
        $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('state', [1,2])->first();
        $myExtentions = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('state', [1,2])->get();
        $user = auth()->user();
        $data = array(
            'pricing' => $pricing, 
            'myExtentions' => $myExtentions, 
            'user' => $user
        );
        if(auth()->user()->role == 1 ||  auth()->user()->role == 2){
            return view('companies.profile.my_package')->with($data);
        }else{
            abort(404);
        }
    }
    
    public function unlockList()
    {
        $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
        $workers = \Helper::unblockList(auth()->user()->id);
        $user = auth()->user();
        $data = array(
            'workers' => $workers, 
            'unlock' => $unlock,
            'user' => $user,
        );
        if(auth()->user()->role == 1 ||  auth()->user()->role == 2){
            return view('companies.profile.unlock')->with($data);
        }else{
            abort(404);
        }
    }

    public function favList()
    {
        $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
        $fav = FavWorker::where('employer_id', auth()->user()->id)->get();
        $workers = \Helper::favList(auth()->user()->id);
        $user = auth()->user();
        $data = array(
            'workers' => $workers, 
            'fav' => $fav,
            'unlock' => $unlock,
            'user' => $user,
        );
        if(auth()->user()->role == 1 ||  auth()->user()->role == 2){
            return view('companies.profile.fav')->with($data);
        }else{
            abort(404);
        }
    }

    public function postJob(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'city' => 'required',
            'country' => 'required',
            'salary' => 'required',
            'docs' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2999'
        ]);

        // Handle File Upload
        if($request->hasFile('docs')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('docs')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('docs')->getClientOriginalExtension();
            // Filename To Store
            $docs = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('docs')->storeAs('public/docs', $filenameToStore);
            $request->file('docs')->move(base_path('/uploads/files/job_docs'), $docs);
        }

        // Create job
        $job = new Job;

        // job Indormations
        $job->title = $request->input('title');
        $job->country = $request->input('country');
        $job->city = $request->input('city');
        $job->address = $request->input('address');
        $job->category_id = $request->input('category_id');
        $job->employer_id = $request->input('employer_id');
        $job->type = $request->input('type');
        $job->sponsored = 0;
        $job->state = 0;

        // Overview & Details
        $job->overview = $request->input('overview');
        $job->desc = $request->input('desc');
        $job->qual = $request->input('qual');
        $job->resp = $request->input('resp');
        if($request->hasFile('docs')){
            $job->docs = $docs;
        }else{
            $job->docs = '';
        }

        // Candidate Indormations
        $job->gender = $request->input('gender');
        $job->experience = $request->input('experience');

        // Prices
        $job->salary = $request->input('salary');
        
        $job->save();
         // send notification to all users with same categoury
        $users = User::where('category_id','LIKE','%'.$request->input('category_id').'%')->get();
        foreach ($users as $user) {
            Notification::send($user, new jobPostedNotfication($job->id));

        }

        $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first(); 
        if($pricing->ads > 0){
            $pricing->ads = $pricing->ads -1;
            $pricing->save();
        }

        $extentions = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3])->where('state', 1)->get();
            if(count($extentions) > 0){
                foreach ($extentions as $key => $extention) {
                    if($extention->ads > 0){
                        $extention->ads = $extention->ads -1;
                        $extention->save();
                    }
                }
            }
        return Redirect::to('workers')->with('success', trans('main.Job Created'));
    }

    public function editJob($id)
    {
        $job = Job::find($id);
        if($job->employer_id == auth()->user()->id)
        {
            $country = Country::pluck('name','id');
            $job_country = Country::where('code',auth()->user()->country)->first();
            if($job_country != null){
                $job_city =  City::where('country_id',$job_country->id)->pluck('name','id');
            }else{
                $job_city =[];
            }
            $data = array(
                'job' => $job
            );
           
            return view('companies.edit_job', compact('country', 'job_city'))->with($data);
        }else{
            abort(404);
        }
        
    }

    public function updateJob(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'city' => 'required',
            'country' => 'required',
            'salary' => 'required',
            'docs' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:2999'
        ]);

        // Handle File Upload
        if($request->hasFile('docs')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('docs')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('docs')->getClientOriginalExtension();
            // Filename To Store
            $docs = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('docs')->storeAs('public/docs', $filenameToStore);
            $request->file('docs')->move(base_path('/uploads/files/job_docs'), $docs);
        }

        // Create job
        $job = Job::find($id);

        // job Indormations
        $job->title = $request->input('title');
        $job->country = $request->input('country');
        $job->city = $request->input('city');
        $job->address = $request->input('address');
        $job->category_id = $request->input('category_id');
        $job->employer_id = $request->input('employer_id');
        $job->type = $request->input('type');
        $job->sponsored = 0;
        $job->state = 0;

        // Overview & Details
        $job->overview = $request->input('overview');
        $job->desc = $request->input('desc');
        $job->qual = $request->input('qual');
        $job->resp = $request->input('resp');
        if($request->hasFile('docs')){
            $job->docs = $docs;
        }

        // Candidate Indormations
        $job->gender = $request->input('gender');
        $job->experience = $request->input('experience');

        // Prices
        $job->salary = $request->input('salary');
        
        $job->save();
        return Redirect::to('workers')->with('success', trans('main.Job Edit'));
    }

    public function destroyJob($id)
    {
        // Delete job
        $job = Job::find($id);

        $job->delete();

        return Redirect::to('workers')->with('success', trans('main.Job Deleted'));
    }

    public function checkout(Request $request)
    {
        $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('role', [1,2])->get();
        $package = Package::find($request->input('package_id'));
        $data = array(
            'package' => $package,
            'pricing' => $pricing,
        );
        if(auth()->user()->role == 1 || auth()->user()->role == 2){
            return view('companies.checkout')->with($data); 
        }
        
    }

    

}
