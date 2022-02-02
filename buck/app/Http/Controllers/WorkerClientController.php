<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Job;
use App\Review;
use App\Country;
use App\City;
use App\JobRequest;
use App\PricingRequest;
use App\SavedJob;

use Illuminate\Http\Request;

class WorkerClientController extends Controller
{
    public static function jobs() {
        if(auth()->user()->role == 0)
        {   
            $jobs = \Helper::categoriesJobs(auth()->user()->category_id);
            $saved = \Helper::savedJobsByUser(auth()->user()->id);
            $apply = \Helper::applysByUser(auth()->user()->id);
            $data = array(
                'jobs' => $jobs,
                'saved' => $saved,
                'apply' => $apply,
            );
            return view('workers.jobs.discover')->with($data);
        }else{
            $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->get();
            $all_jobs = Job::where('employer_id', auth()->user()->id)->get();
            $opened_jobs = Job::where('employer_id', auth()->user()->id)->where('state', 0)->get();
            $data = array(
                'all_jobs' => $all_jobs,
                'opened_jobs' => $opened_jobs,
                'pricing' => $pricing
            );
            return view('companies.workers')->with($data);
        }
    }

    public static function saved_jobs() {
        if(auth()->user()->role == 0)
        {   
            $jobs = \Helper::categoriesJobs(auth()->user()->category_id);
            $saved = \Helper::savedJobsByUser(auth()->user()->id);
            $apply = \Helper::applysByUser(auth()->user()->id);
            $data = array(
                'jobs' => $jobs,
                'saved' => $saved,
                'apply' => $apply,
            );
            return view('workers.jobs.saved')->with($data);
        }else{
            return Redirect::back();
        }
    }


    public static function apply_jobs() {
        if(auth()->user()->role == 0)
        {   
            $jobs = \Helper::categoriesJobs(auth()->user()->category_id);
            $saved = \Helper::savedJobsByUser(auth()->user()->id);
            $apply = \Helper::applysByUser(auth()->user()->id);
            $data = array(
                'jobs' => $jobs,
                'saved' => $saved,
                'apply' => $apply,
            );
            return view('workers.jobs.apply')->with($data);
        }else{
            return Redirect::back();
        }
    }

    public static function job($id) {
        $job = Job::find($id);
        $data = array(
            'job' => $job,
        );
        return view('search.jobs.show')->with($data);
    }

    
    
    

    public function search(Request $request)
    {
        $jobs = \Helper::categoriesJobs(auth()->user()->category_id);
        $data = array(
            'jobs' => $jobs,
        );
        return view('search.jobs.index')->with($data);  
    }

    public function index()
    {
       
    }

    public function create()
    {
       
    }

    public function store(Request $request)
    {
        if($request->has('create-review')){
            /*$this->validate($request, [
                'from_id' => 'required',
                'to_id' => 'required',
                'rating' => 'required',
            ]);
           
    
            // Create review
            $review = new Review;
            
            $review->from_id = auth()->user()->id;
            $review->to_id = $request->input('to_id');
            $review->rating = $request->input('rating');
            $review->text = $request->input('text');
            $review->save();
    
            return Redirect::back()->with('success', 'Review Created');*/
            dd($request);
        }
       
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
       
    }

    public function update(Request $request)
    {
       
    }
    public function destroy($id)
    {
       
    }
    
    public function review(Request $request){
        $user = User::find(auth()->user()->id);
        $data = array(
            'user' => $user
        );
        return view('workers.profile.view_as');
    }

    public function interests(){
        $user = User::find(auth()->user()->id);
        $data = array(
            'user' => $user
        );
        if (auth()->user()->role == 0) {
            return view('workers.sign_up.interests')->with($data);
        }else{
            return Redirect::back();
        }
        
    }

    public function general(){
        $user = User::find(auth()->user()->id);
        $data = array(
            'user' => $user
        );
        if (auth()->user()->role == 0) {
            $country = Country::pluck('name','id');
                
            $user_country = Country::where('code',auth()->user()->country)->first();
            if($user_country != null){
                $user_city =  City::where('country_id',$user_country->id)->pluck('name','id');
            }else{
                $user_city =[];
            }
            return view('workers.sign_up.general',compact('country','user_city'))->with($data);
        }else{
            return Redirect::back();
        }
    }

    public function professional(){
        $user = User::find(auth()->user()->id);
        $data = array(
            'user' => $user
        );
        if (auth()->user()->role == 0) {
            return view('workers.sign_up.professional')->with($data);
        }else{
            return Redirect::back();
        }
        
    }

    public function download_job($id)
    {
        
        $job = Job::find($id);

        //PDF file is stored under project/public/download/info.pdf
        $docs = $job->docs;
        $file= base_path(). '/uploads/files/job_docs/'. $docs;

        $headers = array(
            'Content-Type: application/pdf',
            'Content-Type: image/png',
            'Content-Type: image/jpg'
        );
        if($docs){
            if (file_exists($file)) {
            return response()->download($file, $job->docs, $headers);
            }else{
                return Redirect::back()->with('error', trans("main.No File Available"));
            }
        }else{
             return Redirect::back()->with('error', trans("main.No File Available"));
        }
    }

    public function download($id)
    {
        
        $user = User::find($id);

        //PDF file is stored under project/public/download/info.pdf
        $cv = $user->cv;
        $file= base_path(). '/uploads/files/cv/'. $cv;
        $headers = array(
            'Content-Type: application/pdf',
            'Content-Type: image/png',
            'Content-Type: image/jpg'
        );
        
        if($user->cv){
            if (file_exists($file)) {
                return response()->download($file, $user->cv, $headers);
            }else{
                return Redirect::back()->with('error', trans("main.Worker Didn't Upload CV"));
            }
        }else{
            return Redirect::back()->with('error', trans("main.Worker Didn't Upload CV"));
        }
        

    }
    

}
