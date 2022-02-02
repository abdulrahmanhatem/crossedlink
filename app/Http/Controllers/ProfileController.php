<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Education;
use App\Skill;
use App\Language;
use App\SavedJob;
use App\Experience;
use App\Social;
use App\PricingRequest;
use App\JobRequest;
use App\Job;
use App\Country;
use App\City;
use App\Gallery;
use App\Review;
use App\UnlockWorker;
use App\FavWorker;
use App\Branch;
use Hash;
use Auth;
use URL;
use Helper;
use Twilio\Rest\Client;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\EnvironmentException;
use Twilio\Exceptions\HttpException;
use Twilio\Exceptions\RestException;
use Twilio\Exceptions\TwimlException;
use Response;
use Validator;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CompanyViewedNotfication;
use App\Notifications\jobRequestNotfication;
use App\SocialFacebookAccount;
use App\SocialGoogleAccount;
use App\SocialTwitterAccount;

class ProfileController extends Controller
{
     public function get_notify()
    {   
        $notification = auth()->user()->unreadNotifications;
        return $notification ;
    }
    public function read(Request $request)
    {
        $notification = auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();
        return 'success';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 3)->get();
        $data = array(
            'users' => $users, 
        );
        // return view('users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->check()) {
            app('App\Http\Controllers\ProfileController')->last_seen(auth()->user()->id);
        }
        if(auth()->user()->role == 1 || auth()->user()->role == 2 ){
            if($request->has('create-unlock')){

                $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->first();
                if($pricing){
                    $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
                    $unlock_this = UnlockWorker::where('employer_id', auth()->user()->id)->where('worker_id', $request->input('worker_id'))->get();
                    
                    if(count($unlock_this) > 0){
                        return Redirect::back()->with('success', trans('main.User In Unblock List Already!'));
                    }else{
                        $this->validate($request, [
                            ]);
                            // Create Unlock Worker
                            if($pricing->profiles > 0){
                                $pricing->profiles = $pricing->profiles -1;
                                $pricing->save();
                            }else{
                                $extention = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [4])->where('state', 1)->where('profiles', '>', 0)->first();

                                if($extention){
                                    $extention->profiles = $extention->profiles -1;
                                    $extention->save();

                                }else{
                                    return Redirect::back()->with('error', trans('main.Your Profile Package is empty!')); 
                                }
                                
                            }
                            
                            $skill = new UnlockWorker;
                            $skill->employer_id = auth()->user()->id;
                            $skill->worker_id = $request->input('worker_id');
                            $skill->save();
            
                            return Redirect('profiles/'. $request->input('worker_id'));
                    }
                }else{
                    return Redirect::back()->with('error', trans('main.You Can not Unlock Candidate Untill You Subscribe A Packge!'));
                }
                
                
            }
            if($request->has('create-fav')){
                $this->validate($request, [
                ]);
        
                // Create experience
                $fav = new FavWorker;
                $fav->worker_id = $request->input('worker_id');
                $fav->employer_id = auth()->user()->id;
                $fav->save();
                // return Redirect::back()->with('success', trans('main.'Worker Added To Save List'));
               return 'done';
                
            }
            if($request->has('create-branch')){
                $this->validate($request, [
                    'name' => 'required',
                    'address' => 'required',
                ]);
        
                // Create experience
                $branch = new Branch;
                $branch->name = $request->input('name');
                $branch->address = $request->input('address');
                $branch->user_id = auth()->user()->id;
                $branch->save();
                return Redirect::back()->with('success', trans('main.Branch Added')); 
                /*return dd($request->input('company_logo'));*/
            } 
        }

        if(auth()->user()->role == 0){
            if($request->has('create-experience')){
                $this->validate($request, [
                    'job_title' => 'required',
                    'company_name' => 'required',
                ]);
        
                // Create experience
                $experience = new experience;
                $experience->job_title = $request->input('job_title');
                $experience->company_name = $request->input('company_name');
                $experience->ref = $request->input('ref');
                $experience->from = $request->input('from');
                $experience->to = $request->input('to');
                $experience->user_id = auth()->user()->id;
                $experience->save();
                return Redirect::back()->with('success', trans('main.Experience Added'));
                /*return dd($request->input('company_logo'));*/
            } 
    
            if($request->has('create-education')){
                $this->validate($request, [
                    'school' => 'required',
                    'degree' => 'required',
                    'level' => 'required',
                    'from' => 'required',
                    'to' => 'required',
                ]);
        
                // Create education
                $education = new Education;
                $education->level = $request->input('level');
                $education->school = $request->input('school');
                $education->degree = $request->input('degree');
                $education->from = $request->input('from');
                $education->to = $request->input('to');
                $education->brief = $request->input('brief');
                $education->user_id = auth()->user()->id;
                $education->save();
        
                return Redirect::back()->with('success', trans('main.Education Added'));
            }
    
            if($request->has('create-skill')){
                $this->validate($request, [
                    'name' => 'required',
                ]);
               
        
                // Create skill
                $skill = new Skill;
                $skill->type = 1;
                $skill->name = $request->input('name');
                $skill->percentage = '100';
                $skill->user_id = auth()->user()->id;
                $skill->save();
        
                return Redirect::back()->with('success', trans('main.Skill Added'));
            }

            if($request->has('create-gallery')){
                $this->validate($request, [
                    /*'gallery_image' => 'image|nullable|max:1999',*/
                ]);
               
                if($request->hasFile('gallery_image')){
                    foreach ($request->file('gallery_image') as $file) {
                         // Get Filename With Extension
                        $filenameWithExt = $file->getClientOriginalName();
                        // Get Just Filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // Get Just Extension
                        $extension = $file->getClientOriginalExtension();
                        // Filename To Store
                        $gallery_image = $filename.'_'.time().'.'.$extension;
                        // Upload Image
                        //$path = $file->storeAs('public/gallery_image', $filenameToStore);
                        $file->move(base_path('/uploads/images/gallery_images'), $gallery_image);

                        $gallery = new Gallery;
                        $gallery->gallery_video = $request->input('gallery_video');
                        $gallery->user_id = auth()->user()->id;
                        $gallery->gallery_image = $gallery_image;
                        $gallery->save();
                        
                    }
                    return Redirect::back()->with('success', trans('main.Gallery Added'));


                }

                
            }
    
            if($request->has('create-language')){
                $this->validate($request, [
                    'language' => 'required',
                    'proficiency' => 'required',
                ]);
        
                // Create language
                $language = new Language;
                $language->language = $request->input('language');
                $language->proficiency = $request->input('proficiency');
                $language->user_id = auth()->user()->id;
                $language->save();
                return Redirect::back()->with('success', trans('main.Language Added'));
            }
    
            if($request->has('create-social')){
                $this->validate($request, [
                ]);
               
        
                // Create social
                $social = new Social;
                $social->facebook = $request->input('facebook');
                $social->twitter = $request->input('twitter');
                $social->google_plus = $request->input('linkedin');
                $social->linkedin = $request->input('linkedin');
                $social->pinterest = $request->input('pinterest');
                $social->instagram = $request->input('instagram');
                $social->user_id = auth()->user()->id;
                $social->save();
        
                return Redirect::back()->with('success', trans('main.Social Added') );
            }
    
            if($request->has('create-review')){
    
                $this->validate($request, [
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
        
                /*return Redirect::back()->with('success', trans('main.Review Created'));*/
                dd($request);
    
            }
    
            if ($request->has('create-apply')) {
                $job = JobRequest::where('worker_id', auth()->user()->id)->where('job_id', $request->input('job_id'))->get();
                if (count($job) > 0){
                    return Redirect::back()->with('success', trans('main.You Applied For This Job Already!'));
                }else{
                    $job = new JobRequest;
                    $job->job_id = $request->input('job_id');
                    $job->worker_id =  auth()->user()->id;
                    $job->state = 0;
                    $job->save();
                     // get employer data to sent notfication
                    $job_employer = Job::find($request->input('job_id'))->employer;
                    Notification::send($job_employer, new jobRequestNotfication($job));

                    return Redirect::back()->with('success', trans('main.Job Apply Requested'));
                }
            }
    
            if ($request->has('create-saved-job')) {
                $job = SavedJob::where('user_id', auth()->user()->id)->where('saved_id', $request->input('saved_id'))->get();
                if (count($job) > 0){
                    return Redirect::back()->with('success', trans('main.This Job Is Saved Already!'));
                }else{
                    $job = new SavedJob;
                    $job->saved_id = $request->input('saved_id');
                    $job->user_id =  auth()->user()->id;
                    $job->save();
                    return Redirect::back()->with('success', trans('main.Job Saved'));
                }
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {

        if (auth()->check()) {
            $this->last_seen(auth()->user()->id);
        }
        
        $user = User::find($id);
        
        
        
        $data = array(
            'user' => $user, 
        );
        if ($user) {
            if($user->role == 2 ||  $user->role == 1){
                if($user->id == auth()->user()->id){
                    return view('companies.profile.view_as')->with($data);
                }else{
                    Notification::send($user, new CompanyViewedNotfication(auth()->user()->id));

                    return view('companies.profile.view_as')->with($data);
                }
            }elseif($user->role == 0){
                
                if($user->id == auth()->user()->id){
                    $country = Country::pluck('name','id');
                
                    $user_country = Country::where('code',auth()->user()->country)->first();
                    if($user_country != null){
                        if (app()->getLocale() == 'ar') {
                            $user_city = City::where('country_id',$user_country->id)->pluck('name_ar','id');
                        }else{
                            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
                        }
                    }else{
                        $user_city =[];
                    }
                    if($user->role == 1){
                        return view('workers.profile.view_as',compact('country','user_city'))->with($data);
                    }
                }else{
                    
                    
                     Notification::send($user, new CompanyViewedNotfication(auth()->user()->id));

                    $pricing = PricingRequest::where('user_id', auth()->user()->id)->whereIn('state', [1,2])->first();
                    $workers = \Helper::unblockList(auth()->user()->id);
                    $data = array(
                        'user' => $user, 
                        'pricing' => $pricing
                    );
                    
                    
                    
                    
                    
                    if(!empty($pricing)){
                      
                        if (count($workers) > 0) {
                            $check = \Helper::unlockCheck($user->id);
                            if($check){
                                return view('workers.profile.view_as')->with($data);
                               
                            }else{
                                return view('companies.cannot_view')->with($data);
                            }
                        }else{
                            return view('companies.cannot_view')->with($data);
                        }
                    }else{
                        if($user->role == 1){
                            if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3){
                                return view('companies.cannot_view')->with($data);
                            }else{
                                abort(404); 
                            }
                        }else{
                            abort(404);
                        }
                    }
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
        
    }

    
   public function getCites($country){
        $country = Country::where('code',$country)->first();
        $cities = City::where('country_id',$country->id)->get();
        $cities = json_decode($cities, true);
        
    
        foreach ($cities as $key => $city) {
            if (app()->getLocale() == 'ar') {
                if (!empty($city['name_ar'])) {
                    return City::where('country_id',$country->id)->pluck('name_ar','id');
                }else{
                    return City::where('country_id',$country->id)->pluck('name','id');
                }
                return $city;
            }else{
                return City::where('country_id',$country->id)->pluck('name','id');
            } 
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 2 && $user->id == auth()->user()->id){
            return view('companies.profile.edit')->with($data);
        }elseif($user->role == 1 && $user->id == auth()->user()->id){
            return view('companies.profile.edit')->with($data);
        }elseif($user->role == 0 && $user->id == auth()->user()->id){
            $jobs = \Helper::categoryJobs(auth()->user()->category_id);
            $saved = \Helper::savedJobsByUser(auth()->user()->id);
            $apply = \Helper::applysByUser(auth()->user()->id);
            $data = array(
            'user' => $user,
            'jobs' => $jobs,
            'saved' => $saved,
            'apply' => $apply,
            );
            return view('workers.profile.show')->with($data);
        }else{
            abort(404);
        }
    }

    public function editBranch($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role > 0 && $user->id == auth()->user()->id){
            return view('companies.profile.branch')->with($data);
        }else{
            abort(404); 
        }
    }

    public function editExperience($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.experience')->with($data);
        }else{
            abort(404); 
        }
    }
    public function editEducation($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.education')->with($data);
        }else{
            abort(404); 
        }
    }
    public function editSkills($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.skills')->with($data);
        }else{
            abort(404); 
        }
    }
    public function editLanguages($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.languages')->with($data);
        }else{
            abort(404); 
        }
    }
    public function editSocial($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.social')->with($data);
        }else{
            abort(404); 
        }
    }

    public function editGallery($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        if($user->role == 0 && $user->id == auth()->user()->id){
            return view('workers.profile.gallery')->with($data);
        }else{
            abort(404); 
        }
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
       

        if($request->has('accept-job')){

            $this->validate($request, [
            ]);

            // Close Job
            $job = Job::find($request->input('job_id'));
            $job->state = 1; // Closed
            

            // Close Job 
            $req = JobRequest::where('job_id',$request->input('job_id'))->where('worker_id',$request->input('worker_id'))->first();

            if($req){
                $req = JobRequest::find($req->id);
                $req->state = 2; // 0 => open, 1 => Liked, 2 => approved, 3 => rejected 
                $req->save();
                return Redirect::back()->with('success', trans('main.Job Accepted'));
            }else{
                return Redirect::back()->with('error', trans('main.Job Not Accepted'));
            }
            
        }
        if($request->has('edit-email')){
                $this->validate($request, [
                    'email' => 'required|email|unique:users,email|same:email_confirm',
                    'email_confirm' => 'required',
                ]);
                $user->email = $request->input('email');
                $user->save();

                $data = array(
                    'user' => $user,
                    'success' => trans('main.Email Changed Successfully')
                );
                
                return Redirect::back()->with($data);
                
        }

        if($request->has('reset-password')){

            $this->validate($request, [
                'old-password' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);
           
            if(Hash::check($request->input('old-password') ,$user->password)) {
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return Redirect::back()->with('success' , trans('main.Password Changed'));
            } else {
                return Redirect::back()->with('error' , trans('main.Wrong Password!'));
            } 
            
        }

        if($user->role == 1 || $user->role == 2){
            if ($user->id == auth()->user()->id) {
                if($request->has('edit-branch')){
                    $this->validate($request, [
                        'name' => 'required',
                        'address' => 'required',
                    ]);
            
                    // Update experience
                    $branch = Branch::find($request->input('branch_id'));
                    $branch->name = $request->input('name');
                    $branch->address = $request->input('address');
                    $branch->user_id = auth()->user()->id;
                    $branch->save();
                    return Redirect::back()->with('success', trans('main.Branch Updated'));
                }
                    // Deleting Methods
                if($request->has('delete-branch')){
                    $branch = Branch::find($request->input('branch_id'));

                    $branch->delete();
            
                    return Redirect::back()->with('success', trans('main.Branch Deleted'));
                }
                if($request->has('delete-unlock')){
                    $worker = UnlockWorker::where('worker_id', $request->input('worker_id'))->where('employer_id', auth()->user()->id)->get();
                    $worker->each->delete();
            
                    return Redirect::back()->with('success', trans('main.Worker Removed From You List'));
                }

                if($request->has('delete-fav')){
                    $fav = FavWorker::where('worker_id', $request->input('worker_id'))->where('employer_id', auth()->user()->id)->get();

                    $fav->each->delete();
            
                    return 'done';
                }

            }  
        }
            
       
        
        
            if($user->role == 2 && $user->id == auth()->user()->id){

            $this->validate($request, [
                'company_name' => 'required',
                'email' => 'required',
                'profile_image' => 'image|nullable|max:1999',
                'country' => 'required',
            ]);
        
            // Handle File Upload
            if($request->hasFile('profile_image')){
        
                // Get Filename With Extension
                $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
                // Get Just Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get Just Extension
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                // Filename To Store
                $profile_image = $filename.'_'.time().'.'.$extension;
                // Upload Image
                //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
            }
        
            // Create company
            $user->role = 2;
            // Company Indormations
            $user->company_name = $request->input('company_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->phone_2 = $request->input('phone_2');
            $user->website = $request->input('website');
            $user->address = $request->input('address');
            $user->experience = $request->input('experience');
            $user->employers = $request->input('employers');
        
            // Contact Informations
            $user->first_name = $request->input('first_name');
            $user->middle_name = $request->input('middle_name');
            $user->name = $request->input('first_name') . ' '. $request->input('middle_name');
            $user->country = $request->input('country');
        
            // Overview & Services
            $user->overview = $request->input('overview');
            $user->services = $request->input('services');
        
            // Work Houres
            $user->sa_from = $request->input('sa_from');
            $user->su_from  = $request->input('su_from');
            $user->mo_from  = $request->input('mo_from');
            $user->tu_from  = $request->input('tu_from');
            $user->we_from  = $request->input('we_from');
            $user->th_from  = $request->input('th_from');
            $user->fr_from  = $request->input('fr_from');
            $user->sa_to= $request->input('sa_to');
            $user->su_to  = $request->input('su_to');
            $user->mo_to = $request->input('mo_to');
            $user->tu_to  = $request->input('tu_to');
            $user->we_to  = $request->input('we_to');
            $user->th_to  = $request->input('th_to');
            $user->fr_to = $request->input('fr_to');

            if($request->hasFile('profile_image')){
                $user->profile_image = $profile_image;
            }
        }

        if($user->role == 1 && $user->id == auth()->user()->id){
            $this->validate($request, [
                'first_name' => 'required',
                'middle_name' => 'required',
                'email' => 'required',
                'profile_image' => 'image|nullable|max:1999',
                'password' => 'min:6', 
                'country' => 'required',
            ]);
        
            // Handle File Upload
            if($request->hasFile('profile_image')){
        
                // Get Filename With Extension
                $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
                // Get Just Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get Just Extension
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                // Filename To Store
                $profile_image = $filename.'_'.time().'.'.$extension;
                // Upload Image
                //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
            }
        
            // Create Personal
            $user->role = 1;
            // Personal Indormations
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->phone_2 = $request->input('phone_2');
            $user->website = $request->input('website');
            $user->address = $request->input('address');
            $user->experience = $request->input('experience');
            $user->employers = $request->input('employers');
        
            // Contact Informations
            $user->first_name = $request->input('first_name');
            $user->middle_name = $request->input('middle_name');
            $user->name = $request->input('first_name') . ' '. $request->input('middle_name');
            $user->password = bcrypt($request->input('password'));
            $user->country = $request->input('country');
        
            // Overview & Services
            $user->overview = $request->input('overview');
            $user->services = $request->input('services');
        
            // Work Houres
            $user->sa_from = $request->input('sa_from');
            $user->su_from  = $request->input('su_from');
            $user->mo_from  = $request->input('mo_from');
            $user->tu_from  = $request->input('tu_from');
            $user->we_from  = $request->input('we_from');
            $user->th_from  = $request->input('th_from');
            $user->fr_from  = $request->input('fr_from');
            $user->sa_to= $request->input('sa_to');
            $user->su_to  = $request->input('su_to');
            $user->mo_to = $request->input('mo_to');
            $user->tu_to  = $request->input('tu_to');
            $user->we_to  = $request->input('we_to');
            $user->th_to  = $request->input('th_to');
            $user->fr_to = $request->input('fr_to');

            if($request->hasFile('profile_image')){
                $user->profile_image = $profile_image;
            }
        }

        

        if($user->role == 0 && $user->id == auth()->user()->id){
            $page = '';
            // Updating Methods
            if($request->has('edit-interest')){
                $this->validate($request, [
                    'category_id' => 'required',
                    'average_salary' => 'required',
                    'experience' => 'required',
                ]);

                $user->category_id = $request->input('category_id');
                
                $user->average_salary = $request->input('average_salary');
                $user->experience = $request->input('experience');
                $user->salary_hide = $request->input('salary_hide');
                
                $user->save();

                $data = array(
                    'user' => $user
                );
                
                return Redirect::to('/general')->with($data);
            }
            
            if($request->has('edit-general-info')){
                $this->validate($request, [
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'birth' => 'required',
                    'gender' => 'required',
                    'married' => 'required',
                    'country' => 'required',
                    'city' => 'required',
                    'countryCode' => 'required',
                    'religion' => 'required',
                    'profile_image' => 'image|nullable|max:1999',
                ]);

                // dd($request->all());

                // Handle File Upload
                if($request->hasFile('profile_image')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    // Filename To Store
                    $profile_image = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                    $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
                }

                // General Info
                $user->first_name = $request->input('first_name');
                $user->middle_name = $request->input('middle_name');
                $user->name = $request->input('first_name') . ' '. $request->input('middle_name');
                $user->nationality = $request->input('nationality');
                $user->birth = $request->input('birth');
                $user->religion = $request->input('religion');
                $user->gender = $request->input('gender');
                $user->married = $request->input('married');
                $user->legal = $request->input('legal');

                if($request->hasFile('profile_image')){
                    $user->profile_image = $profile_image;
                }
                

                // Location
                $user->country = $request->input('country');
                $user->city = $request->input('city');
                $user->address = $request->input('address');
                
                // Contact Info
                $user->phone_code = $request->input('countryCode') . '-'.preg_replace('/[^0-9]/', '', $request->input('phone_no'));
                $user->phone = $request->input('phone');

                /*$user->phone_2 = $request->input('phone_2');*/
                $user->save();
                $data = array(
                    'user' => $user
                );
                return Redirect::to('/professional')->with($data);
            }
            if($request->has('edit-professional')){
                $this->validate($request, [
                    'cv' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf|max:2999',
                ]);
                // Handle File Upload
                if($request->hasFile('cv')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('cv')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('cv')->getClientOriginalExtension();
                    // Filename To Store
                    $cv = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('cv')->storeAs('public/cv', $filenameToStore);
                    $request->file('cv')->move(base_path('/uploads/files/cv'), $cv);
                }
                // General Info
                $user->about = $request->input('about');
                if($request->hasFile('cv')){
                    $user->cv = $cv;
                }
                $user->save();
                $data = array(
                    'user' => $user
                );
                return Redirect::to('/')->with($data);
            }
            
            if($request->has('edit-gov_id')){
                $this->validate($request, [
                    'gov_id' => 'image|nullable|max:1999',
                ]);

                // Handle File Upload
                if($request->hasFile('gov_id')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('gov_id')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('gov_id')->getClientOriginalExtension();
                    // Filename To Store
                    $gov_id = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                    $request->file('gov_id')->move(base_path('/uploads/images/gov_id'), $gov_id);
                }
                if($request->hasFile('gov_id')){
                    $user->gov_id = $gov_id;
                }
                $user->save();
                return Redirect::back()->with('success', trans('main.Government ID Sent'));
            }
            if($request->has('general-box-1')){
                $this->validate($request, [
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'country' => 'required',
                    'city' => 'required',
                    'category_id' => 'required',
                    'profile_image' => 'image|nullable|max:1999',
                ]);
                // Handle File Upload
                if($request->hasFile('profile_image')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('profile_image')->getClientOriginalExtension();
                    // Filename To Store
                    $profile_image = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                    $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
                }
                $user->first_name = $request->input('first_name');
                $user->middle_name = $request->input('middle_name');
                $user->name = $request->input('first_name') . ' '. $request->input('middle_name');
                $user->country = $request->input('country');
                $user->town = $request->input('town');
                
        
                $user->city = $request->input('city');
                $user->category_id = $request->input('category_id');
    
                if($request->hasFile('profile_image')){
                    $user->profile_image = $profile_image;
                }
            }
            if($request->has('general-box-2')){
                $this->validate($request, [
                    'email' => 'required',
                ]);
                // Personal Informations
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->experience = $request->input('experience');
                $user->average_salary = $request->input('average_salary');
                $user->salary_hide = $request->input('salary_hide');
            }
            if($request->has('general-box-3')){
                $this->validate($request, [
                    'nationality' => 'required',
                    'religion' => 'required',
                    'cv' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2999'
                ]);
        
                if($request->hasFile('cv')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('cv')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('cv')->getClientOriginalExtension();
                    // Filename To Store
                    $cv = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                    $request->file('cv')->move(base_path('/uploads/files/cv'), $cv);
                }

                $user->nationality = $request->input('nationality');
                $user->religion = $request->input('religion');
                $user->address = $request->input('address');
        
                $user->birth = $request->input('birth');
                $user->gender = $request->input('gender');
                $user->married = $request->input('married');
                $user->legal = $request->input('legal');
                if($request->hasFile('cv')){
                    $user->cv = $cv;
                }
            }
            if($request->has('general-box-4')){
                $this->validate($request, [
                ]);
                $user->about = $request->input('about');
            }
            if($request->has('edit-experience')){
                $this->validate($request, [
                    'job_title' => 'required',
                    'company_name' => 'required',
                ]);
        
                if($request->hasFile('company_logo')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('company_logo')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('company_logo')->getClientOriginalExtension();
                    // Filename To Store
                    $company_logo = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('company_logo')->storeAs('public/company_logo', $filenameToStore);
                    $request->file('company_logo')->move(base_path('/uploads/images/profile_images'), $company_logo);
                }
        
                // Create experience
                $experience = experience::find($request->input('experience_id'));
                $experience->job_title = $request->input('job_title');
                $experience->company_name = $request->input('company_name');
                $experience->from = $request->input('from');
                $experience->to = $request->input('to');
        
                if($request->hasFile('company_logo')){
                    $experience->company_logo = $company_logo;
                }
        
                $experience->user_id = auth()->user()->id;
                $experience->save();
                $page = 'experience';
                $data= array(
                    'page' => $page,
                    'success' => trans('main.Experience Added')
                );
                return Redirect::back()->with($data);
            } 
            if($request->has('edit-education')){
                $this->validate($request, [
                    'title' => 'required',
                    'school' => 'required',
                    'degree' => 'required',
                    'level' => 'required',
                    'from' => 'required',
                    'to' => 'required',
                    'brief' => 'string|min:10|max:90',
                ]);
        
                // Create education
                $education = Education::find($request->input('education_id'));
                $education->title = $request->input('title');
                $education->level = $request->input('level');
                $education->school = $request->input('school');
                $education->degree = $request->input('degree');
                $education->ref = $request->input('ref');
                $education->from = $request->input('from');
                $education->to = $request->input('to');
                $education->brief = $request->input('brief');
                $education->user_id = auth()->user()->id;
                $education->save();
        
                return Redirect::back()->with('success', trans('main.Education Added'));
            }
            if($request->has('edit-skill')){
                $this->validate($request, [
                    'name' => 'required',
                ]);
               
        
                // Create skill
                $skill = Skill::find($request->input('skill_id'));
                $skill->name = $request->input('name');
                $skill->user_id = auth()->user()->id;
                $skill->save();
        
                return Redirect::back()->with('success', trans('main.Skill Apdated'));
            }
            if($request->has('edit-language')){
                $this->validate($request, [
                    'language' => 'required',
                    'proficiency' => 'required',
                ]);
        
                // Create language
                $language = Language::find($request->input('language_id'));
                $language->language = $request->input('language');
                $language->proficiency = $request->input('proficiency');
                $language->user_id = auth()->user()->id;
                $language->save();
                return Redirect::back()->with('success', trans('main.Language Edited'));
            }
            if($request->has('edit-social')){
                $this->validate($request, [
                ]);
               
        
                // Create social
                $social = Social::find($request->input('social_id'));
                $social->facebook = $request->input('facebook');
                $social->twitter = $request->input('twitter');
                $social->google_plus = $request->input('linkedin');
                $social->linkedin = $request->input('linkedin');
                $social->pinterest = $request->input('pinterest');
                $social->instagram = $request->input('instagram');
                $social->user_id = auth()->user()->id;
                $social->save();
        
                return Redirect::back()->with('success', trans('main.Social Edited'));
            }

            if($request->has('edit-gallery')){
                $this->validate($request, [
                    'gallery_image' => 'image|nullable|max:1999',
                ]);

                if($request->hasFile('gallery_image')){
        
                    // Get Filename With Extension
                    $filenameWithExt = $request->file('gallery_image')->getClientOriginalName();
                    // Get Just Filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get Just Extension
                    $extension = $request->file('gallery_image')->getClientOriginalExtension();
                    // Filename To Store
                    $gallery_image = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    //$path = $request->file('gallery_image')->storeAs('public/gallery_image', $filenameToStore);
                    $request->file('gallery_image')->move(base_path('/uploads/images/gallery_images'), $gallery_image);
                }

                // Create skill
                $gallery = Gallery::find($request->input('gallery'));
                $gallery->gallery_image = $request->input('gallery_image');
                $gallery->gallery_video = $request->input('gallery_video');
                $gallery->user_id = auth()->user()->id;

                if($request->hasFile('gallery_image')){
                    $gallery->gallery_image = $gallery_image;
                }

                $gallery->save();
        
                return Redirect::back()->with('success', trans('main.Gallery Updated'));
            }

            if($request->has('edit-review')){

                $this->validate($request, [
                    'to_id' => 'required',
                    'rating' => 'required',
                ]);

                // Edit review
                $review = Review::find($request->input('review_id'));
                $review->from_id = auth()->user()->id;
                $review->to_id = $request->input('to_id');
                $review->rating = $request->input('rating');
                $review->text = $request->input('text');
                $review->save();
        
                return Redirect::back()->with('success', trans('main.Review Edited'));
            }

            if($request->has('edit-notes')){
                $this->validate($request, [
                ]);
                // Edit notes
                $notes = JobRequest::where('worker_id', auth()->user()->id)->where('worker_seen', 0)->get();
                $review->worker_seen = 1;
                $review->save();
                return Redirect::back();
            }

           
            if($request->has('delete-experience')){
                $experience = Experience::find($request->input('experience_id'));

                $experience->delete();
        
                return Redirect::back()->with('success', trans('main.Experience Deleted'));
            }
            if($request->has('delete-education')){
                $education = Education::find($request->input('education_id'));

                $education->delete();
        
                return Redirect::back()->with('success', trans('main.Education Deleted'));
            }
            if($request->has('delete-skill')){
                $skill = Skill::find($request->input('skill_id'));

                $skill->delete();
        
                return Redirect::back()->with('success', trans('main.Skill Deleted'));
            }
            if($request->has('delete-language')){
                $language = Language::find($request->input('language_id'));

                $language->delete();
        
                return Redirect::back()->with('success', trans('main.Language Deleted'));
            }
            if($request->has('delete-review')){
                $review = Review::find($request->input('review_id'));
                $review->delete();
                return Redirect::back()->with('success', trans('main.Review Deleted'));
            }
            if($request->has('delete-saved-job')){
                $saved = SavedJob::find($request->input('saved_id'));
                $saved->delete();
                return Redirect::back()->with('success', trans('main.Deleted From Saved Jobs'));
            }
            if($request->has('unapply-job')){
                $req = JobRequest::where('worker_id', auth()->user()->id)->where('job_id', $request->input('job_id'))->first();
                $req->delete();
                return Redirect::back()->with('success', trans('main.Job Unapplied'));
            }
            

            if($request->has('delete-gallery-image')){
                $saved = Gallery::find($request->input('image_id'));
                $saved->delete();
                return Redirect::back()->with('success', trans('main.Image Deleted'));
            }
        }

        

    
        $user->save();
        return Redirect::back()->with('success', trans('main.Profile Edited'));
    }

    public function last_seen($id)
    {
        $user = User::find($id);
        $user->last_seen = Carbon::now();
        $user->save();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find(auth()->user()->id);
        
         $SocialFacebookAccountCount = SocialFacebookAccount::where('user_id',$id)->count();
		if($SocialFacebookAccountCount>0){
			$SocialFacebookAccount = SocialFacebookAccount::where('user_id',$id);
			$SocialFacebookAccount->delete();
		}
        $SocialGoogleAccountCount = SocialGoogleAccount::where('user_id',$id)->count();
		if($SocialGoogleAccountCount>0){
			$SocialGoogleAccount = SocialGoogleAccount::where('user_id',$id);
			$SocialGoogleAccount->delete();
		}
        $SocialTwitterAccountCount = SocialTwitterAccount::where('user_id',$id)->count();
		if($SocialTwitterAccountCount>0){
			$SocialTwitterAccount = SocialTwitterAccount::where('user_id',$id);
			$SocialTwitterAccount->delete();
		}

        Auth::logout();

        if ($user->delete()) {

            return Redirect::to('/')->with('global', trans('main.Your account has been deleted!'));
        }
    }

    public function viewAs(){
        if (auth()->check()) {
            app('App\Http\Controllers\ProfileController')->last_seen(auth()->user()->id);
            $user = User::find(auth()->user()->id);
            $country = Country::pluck('name','id');
                
             $user_country = Country::where('code',auth()->user()->country)->first();
                    if($user_country != null){
                        if (app()->getLocale() == 'ar') {
                            $user_city = City::where('country_id',$user_country->id)->pluck('name_ar','id');

                        }else{
                            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
                        }
                    }else{
                        $user_city =[];
                    }
            $data = array(
                'user' => $user,
                'country' => $country,
                'user_city' => $user_city
            );
            return view('workers.profile.view_as')->with($data);
        }else{
            return Redirect::back();
        }
        
    }

    public function settings(){
        $user = User::find(auth()->user()->id);
        $data = array(
            'user' => $user
        );
        if( auth()->user()->role == 2){
            return view('companies.profile.settings')->with($data);
        }elseif( auth()->user()->role == 1){
            return view('companies.profile.settings')->with($data);
        }elseif( auth()->user()->role == 0){
            
            return view('workers.profile.settings')->with($data);
        }
    } 
    
    //SEND VERIFIACTION LINK TO VERIFY EMAIL 
    public function SendVerifyEmailLink()
    {
         $user = User::where('id',auth()->user()->id)->get();
         $name = $user[0]->first_name .' '. $user[0]->middle_name;
        //SEND EMAIL TO VERIFY USER.
        $register_token = Helper::getToken();   
        $userUpdate = User::where('email',$user[0]->email);
        //if($user[0]->email_verify_token==NULL){
            
             $data['email_verify_token'] =$register_token;  
             $userUpdate->update($data);    
             $link = url('verify/email/'.$register_token);
             if($user[0]->email){
                $to = $user[0]->email;
                //EMAIL REGISTER EMAIL TEMPLATE 
                $view = view('emailtemplate.verify_email')->render();
                $subject = 'Verify Your Email';
                $message_body = $view;
                $list = Array
                  ( 
                     '[NAME]' => $name,
                     '[LINK]' => $link,
                  );

                $find = array_keys($list);
                $replace = array_values($list);
                $message = str_ireplace($find, $replace, $message_body);
                $mail = Helper::send_email($to, $subject, $message);
                
                return Redirect::back()->with('success', trans('main.Please check your email and verify from there.'));  
             }
        /*  }else{
             return redirect('me')->with('error', trans('main.Email Already sent to verify.'));  
            
        } */
    }
    
    public function SendPasswordResetEmailLink($request)
    {
         $user = User::where('email',$request)->get();
         $email = $user[0]->email;
        //SEND EMAIL TO VERIFY USER.
        $password_token = Helper::getToken();   
        $userUpdate = User::where('email',$user[0]->email);
        //if($user[0]->email_verify_token==NULL){

             /*$data['password'] =$password_token;  
             $userUpdate->update($data);*/
             
             DB::table('password_resets')->insert(
                 array(
                        'email'     =>   $email, 
                        'token'   =>   $password_token,
                        'created_at' => Carbon::now()
                 )
            );
             $link = url('password/reset/'.$password_token);
             if($user[0]->email){
                $to = $user[0]->email;
                //EMAIL REGISTER EMAIL TEMPLATE 
                $view = view('emailtemplate.reset_password_email')->render();
                $subject = 'Reset Your Password';
                $message_body = $view;
                $list = Array
                  ( 
                     '[email]' => $email,
                     '[LINK]' => $link,
                  );

                $find = array_keys($list);
                $replace = array_values($list);
                $message = str_ireplace($find, $replace, $message_body);
                $mail = Helper::send_email($to, $subject, $message);
                
                return Redirect::back()->with('success', trans('main.Please check your Password Reset email'));  
             }
        /*  }else{
             return redirect('me')->with('error', trans('main.Email Already sent to verify.'));  
            
        } */
    }
   //OPEN PHONE VERIFY POPUP
   public function OpenPhoneVerificationModal(Request $request)
   {
        $user_id   = auth()->user()->id;
        $user = User::where('id',$user_id)->get();
            $user=$user[0];
            $view = view("workers.profile.phone_verify_modal",compact('user'))->render();
            $success = true;
        
         return Response::json(array(
          'success'=>$success,
          'data'=>$view
         ), 200); 
   }
    
 //SEND CODE TO YOUR PHONE  
   public function sendPhoneVerificationCode(Request $request)
   {
      // dd('Hi');
        $user = User::where('id',auth()->user()->id)->get();   
        $data =array();
        //$data['phone_number'] ='+918894185904'; 
        $phone_number =$request->phone_number; 
        
        
        $validator = Validator::make($request->all(),[
                'phone_number' => 'required|min:11|numeric',
            ]);
            if($validator->fails()){
                  $errors = $validator->errors();
                  $errors =  json_decode($errors);
                  
                    return response( array( 'success' => false,
                'message' => $errors), 422);
            }
        $userPhone = User::where('phone',$request->phone_number)->count();  
        if($userPhone > 0){
			
			 return Response::json(array(
              'success'=>false,
              'msg'=> trans('main.Phone number already used.Use another number to verify') 
             ), 200); 
		}
        
            
        $token = '4e66e26bb98ddca4674a5430357c8498'; 
        $twilio_sid = 'ACbc156b338660868df95dd6eb142513a5';
        $twilio_verify_sid ='VA8ecce466a4224639a536ac2c2685a8ae';
         
        
        //$token = getenv("TWILIO_AUTH_TOKEN"); 
       // $twilio_sid = getenv("TWILIO_SID");
       // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        
        //echo $service = $twilio->verify->v2->services->create("Phone Number"); die;
     try{
        $verification = $twilio->verify->services($twilio_verify_sid)
                                       ->verifications
                                       ->create($phone_number, "sms");
        
        
        if($verification->sid){
             return Response::json(array(
               'success'=>true,
               'msg'=> trans('main.Code Sent successfully.Please check your phone.')
             ), 200); 
        }else{
             return Response::json(array(
              'success'=>false,
              'msg'=> trans('main.Something Went Wrong.') 
             ), 200); 
         }  
     }catch (\Exception $e) {
         return Response::json(array(
              'success'=>false,
              'msg'=>$e->getMessage(),
             ), 200);  
      }
    }
    
  //VERIFY CODE  THAT IS SEND TO YOUR PHONE.
   public function verifyPhoneCode(Request $request)
    {
        
        $user_id = auth()->user()->id;   
        $validator = Validator::make($request->all(),[
            'verfication_code' => 'required',
        ]);
        if($validator->fails()){
              $errors = $validator->errors();
              $errors =  json_decode($errors);
                return response( array( 'success' => false,
            'message' => $errors), 422);
        }

        /* Get credentials from .env */
        $token = '4e66e26bb98ddca4674a5430357c8498'; 
        $twilio_sid = 'ACbc156b338660868df95dd6eb142513a5';
        $twilio_verify_sid ='VA8ecce466a4224639a536ac2c2685a8ae';
       // $token = getenv("TWILIO_AUTH_TOKEN");
       // $twilio_sid = getenv("TWILIO_SID");
       // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        try{
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($request->verfication_code, array('to' => $request->phone_number));
            if ($verification->valid) {
                $user = User::where('id', $user_id)->update(['IsPhoneVerified' => true,'phone'=>$request->phone_number]);

                 return Response::json(array(
                'success'=>true,
                'msg'=> trans('main.Phone number verified.')
                ), 200); 
               // return redirect()->route('home')->with(['message' => 'Phone number verified']);
            }
            return Response::json(array(
                'success'=>false,
                'msg'=> trans('main.Invalid verification code entered!')
            ), 200); 
        }catch (\Exception $e) {
         return Response::json(array(
              'success'=>false,
              'msg'=>$e->getMessage(),
             ), 200);  
      }

    }
    
    
}
