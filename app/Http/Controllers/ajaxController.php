<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Job;
use App\User;
use App\Education;
use App\Skill;
use App\UnlockWorker;
use App\FavWorker;
use App\JobRequest;
use App\SavedJob;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CompanyViewedNotfication;
use App\Notifications\jobRequestNotfication;



class ajaxController extends Controller
{
    public function Jobs(Request $request){
        // dd($request->all());
        // Jobs By Category With No Search Changes 
        if(auth()->user()->role == 0){
            $jobs = \Helper::categoriesJobsSearch(auth()->user()->category_id)->where('state', 0); 
        }else{
            $jobs = job::where('id', '>', 0);
        }
        
        $selceted_country = '';
        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selected_type = '';
        $selceted_period = '';

        if ($request->has('updated_at')  && $request->updated_at !== null) {
            if($request->updated_at ==  0){

                $jobs->whereBetween('updated_at', [Carbon::now()->subHour(), Carbon::now()]);
                $selceted_period = 0;
            }
            if($request->updated_at ==  1){
                $jobs->whereBetween('updated_at', [Carbon::now()->subHours(24), Carbon::now()]);
                $selceted_period = 1;
            }
            if($request->updated_at ==  2){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(7), Carbon::now()]);
                $selceted_period = 2;
            }
            if($request->updated_at ==  3){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(14), Carbon::now()]);
                $selceted_period = 3;
            }
            if($request->updated_at ==  4){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(30), Carbon::now()]);
                $selceted_period = 4;
            }
            if($request->updated_at ==  5){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(180), Carbon::now()]);
                $selceted_period = 5;
            }
        }


        if ($request->has('country')  && $request->country !== null) {
            $jobs->whereIn('country', $request->input('country'));
            $selceted_country = $request->input('country');
        }

        if ($request->has('type') && $request->type !== null ) {
            $type = explode(',',$request->type);
            $jobs->whereIn('type', $type);
            $selected_type = $type;
        }
        

        if ($request->has('gender') && $request->gender !== null ) {
             $gender = explode(',',$request->gender);
            $jobs->whereIn('gender', $gender);
            
            
            $selceted_gender =$gender;
        }
        
        if ($request->has('salary') && $request->salary !== null) {
             $salary = explode(',',$request->salary);
            $jobs->whereIn('salary', $salary);
            $selceted_salary = $salary;
        }

        

        if ($request->has('experience') && $request->experience !== null ) {
            $experience = explode(',',$request->experience);
            $ex_array = [];
            if(in_array( 1, $experience)){
                foreach ([0,1,2,3] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 2, $experience)){
                foreach ([4,5,6] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 3, $experience)){
                foreach ([7,8,9] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 4, $experience)){
                array_push($ex_array, 9);
            }

            $jobs->whereIn('experience', $ex_array);
            $selceted_experience = $experience;
        }

        
        
        $jobs = $jobs->paginate(9);
        foreach($jobs as $job){
            foreach (\Helper::job_type() as $key => $type){
                if ($key == $job->type ){
                    $job['job_type'] = $type;
                }
            }
            foreach (\Helper::experience() as $key => $type){
                if ($key == $job->experience ){
                    $job['exp'] = $type;
                    
                }
            }
            $job['saved'] = SavedJob::where('user_id', auth()->user()->id)->where('saved_id', $job->id)->first()? 1 : 0;
            $job['salary_range'] = \Helper::getSalaryRange($job->salary)?\Helper::getSalaryRange($job->salary) : null;
            $job['applied'] = JobRequest::where('worker_id', auth()->user()->id)->where('job_id',$job->id)->first() ? 1 : 0 ;
            $job['canApply'] = \Helper::canJobApply() ? 1 : 0 ;
            $job['profile_image'] = !empty($job->employer->profile_image)?$job->employer->profile_image:null ;
            
        }
        return response()->json(['jobs'=>$jobs]);

        
    }
    
    public function workers(Request $request){
            
        // Jobs By Category With No Search Changes 
        $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
        
      
        
        $selceted_country = '';
        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selceted_type = '';
        $selceted_skill = '';
        $selceted_category = '';
        $selceted_education = '';
        $selceted_sorting = '';
        $educational_level = [];
        $skills_workers = [];
        

        if ($request->has('category') ) {
            
            if($request->category != null && $request->category != 0){
                if($request->category == 'all'){
                    if(auth()->user()->role == 3){
                        $workers = User::where('role', 0);
                    }elseif(auth()->user()->role == 2){
                        $workers = \Helper::categoriesWorkersSearch();
                        
                    }elseif(auth()->user()->role == 1){
                        $workers = \Helper::categoriesWorkersSearch();
                    } 
                }else{
                    $workers =  \Helper::categoriesWorkersSearchByOne($request->input('category'));
                }
                $selceted_category = $request->input('category');
            }else{
                
                if(auth()->user()->role == 3){
                    $workers = User::where('role', 0);
                }elseif(auth()->user()->role == 2){
                    $workers = \Helper::categoriesWorkersSearch();
                }elseif(auth()->user()->role == 1){
                    $workers = \Helper::categoriesWorkersSearch();
                } 
            }
        }else{
            if(auth()->user()->role == 3){
                $workers = User::where('role', 0);
            }elseif(auth()->user()->role == 2){
                $workers = \Helper::categoriesWorkersSearch();
            }elseif(auth()->user()->role == 1){
                $workers = \Helper::categoriesWorkersSearch();
            }
        }

        
        if ($request->has('country') && $request->country !== "null" && $request->country !== null&& $request->country !== 'all,'&& $request->country !== 'all'&& $request->country !== ',') {
            $country =  explode(',',$request->country);
            if( count($country) > 0){
                $workers->whereIn('country', $country);
                $selceted_country = $country;
            }
        }
        if ($request->has('gender') && $request->gender !== null ) {
            $gender = explode(',',$request->gender);
            $workers->whereIn('gender', $gender);
            
            
            $selceted_gender = $request->input('gender');
        }
        
        if ($request->has('salary') && $request->salary !== null ) {
            $salary = explode(',',$request->salary);

            $workers->whereIn('average_salary', $salary);
            $selceted_salary = $request->input('salary');
        }

        if ($request->has('experience')&& $request->experience !== null ) {
            
            $exp = explode(',',$request->experience);
            $ex_array = [];
            if(in_array( 1, $exp)){
                foreach ([0,1,2] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 2, $exp)){
                foreach ([3,4,5] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 3, $exp)){
                foreach ([6,7,8] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 4, $exp)){
                array_push($ex_array, 9);
            }

            $workers->whereIn('experience', $ex_array);
            $selceted_experience = $exp;
        }
        if ($request->has('education') && $request->education !== null) {
            $education = explode(',',$request->education);

            $educational_level = \Helper::usersByEducationalLevel($education);

        }

        $workers_id = [];
        $workers_sorting = [];
        $workers = $workers->get();
        
        $workers_ = json_decode($workers, true);
        
        foreach($workers_ as $worker){
            if($request->education !== null){
                $educational_level = \Helper::usersByEducationalLevel($education);
                $educational_level = json_decode($educational_level, true);
                if (count($educational_level) > 0) {
                    foreach($educational_level as $level_worker){
                        if($worker['id'] == $level_worker['id']){
                            array_push($workers_id, $worker['id']);
                        }   
                    }
                }
            }else{
                array_push($workers_id, $worker['id']);
            }
        }
        if ($request->has('sorting') ) {
            if($request->sorting != 0 || null){
                if($request->sorting == 1){
                    $workers = User::with('category','city','country')->orderBy('name')->whereIn('id', $workers_id)->paginate(6);
                }
                if($request->sorting == 2){
                    $workers = User::with('category','city','country')->where('experience' ,'!=',null)->where('experience' ,'!=',0)->orderBy('experience','DESC' )->whereIn('id', $workers_id)->paginate(6);
                }
                if($request->sorting == 3){
                    $workers = User::with('category','city','country')->where('average_salary' ,'!=',null)->orderBy('average_salary', 'ASC')->whereIn('id', $workers_id)->paginate(6);
                }
                if($request->sorting == 4){
                    $workers = User::with('category','city','country')->where('average_salary' ,'!=',null)->orderBy('average_salary', 'DESC')->whereIn('id', $workers_id)->paginate(6);
                }
                $selceted_sorting = $request->sorting;
            }else{
                $workers = User::with('category','city','country')->whereIn('id', $workers_id)->paginate(6);
            }
        }else{
            $workers = User::with('category','city','country')->whereIn('id', $workers_id)->paginate(6);
        }
        foreach($workers as $worker){
            // dd($worker->average_salary);
            $work = UnlockWorker::where('employer_id', auth()->user()->id)->where('worker_id', $worker->id)->first();
            $worker['UnlockWorker'] = $work?1:0;
            $worker['skill'] = count($worker->skills)>0?explode(',',$worker->skills[0]->name):[];
            // $worker['name'] = $work?ucwords($worker->name):ucwords(\Helper::hashString($worker->name));
            $worker['name'] = $work?ucwords($worker->name):ucwords(\Helper::hashString($worker->name));
            $fav = FavWorker::where('employer_id', auth()->user()->id)->where('worker_id', $worker->id)->first();
            $worker['favourite'] = $fav?1:0;
            $worker['city_name'] = isset($worker->city)? \Helper::getCityByID($worker->city):null;
            $worker['country_name'] = isset($worker->country)? \Helper::getCountryByKey($worker->country) :null;
            
            
        }
        $workers = $this->convert_from_latin1_to_utf8_recursively($workers);
        return response()->json(['worker'=>$workers->toJson()],200,[],JSON_UNESCAPED_UNICODE);
    }
    
    public function accept(Request $request ,$id = null){
         if($request->has('delete-saved-job')){
                $saved = SavedJob::where('saved_id',$request->saved_id)->first();
                $saved->delete();
                return Redirect::back()->with('success', trans('main.Deleted From Saved Jobs'));
        }
       if ($request->has('create-apply')) {
            $job = JobRequest::where('worker_id', auth()->user()->id)->where('job_id', $request->job_id)->get();
            if (count($job) > 0){
                return Redirect::back()->with('success', trans('main.You Applied For This Job Already!'));
            }else{
                $job = new JobRequest;
                $job->job_id = $request->job_id;
                $job->worker_id =  auth()->user()->id;
                $job->state = 0;
                $job->save();
                 // get employer data to sent notfication
                $job_employer = Job::find($request->job_id)->employer;
                Notification::send($job_employer, new jobRequestNotfication($job));

                return 'done';
            }
        }

    
        if($request->has('unapply-job')){
            $req = JobRequest::where('worker_id', auth()->user()->id)->where('job_id', $request->job_id)->first();
            $req->delete();
            return Redirect::back()->with('success', trans('main.Job Unapplied'));
        }
    
        if($request->has('delete-saved-job-worker')){
            $saved = SavedJob::where('saved_id',$request->saved_id)->first();
            if($saved){
                $saved->delete();
            }
            return Redirect::back()->with('success', trans('main.Deleted From Saved Jobs'));
        }
         if ($request->has('create-saved-job-worker')) {
                $job = SavedJob::where('user_id', auth()->user()->id)->where('id',$request->saved_id)->get();
                if (count($job) > 0){
                    return Redirect::back()->with('success', trans('main.This Job Is Saved Already!'));
                }else{
                    $job = new SavedJob;
                    $job->saved_id = $request->saved_id;
                    $job->user_id =  auth()->user()->id;
                    $job->save();
                    return Redirect::back()->with('success', trans('main.Job Saved'));
                }
            }
       if ($request->has('create-saved-job')) {
            $job = SavedJob::where('user_id', auth()->user()->id)->where('saved_id', $request->input('saved_id'))->get();
            if (count($job) > 0){
                return Redirect::back()->with('success', trans('main.This Job Is Saved Already!'));
            }else{
                $job = new SavedJob;
                $job->saved_id = $request->saved_id;
                $job->user_id =  auth()->user()->id;
                $job->save();
                return Redirect::back()->with('success', trans('main.Job Saved'));
            }
        }
        
        return response()->json(['message'=>'done'],200);
            
    }
     public function convert_from_latin1_to_utf8_recursively($dat)
   {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
   }


      public function request(Request $request)
    {
       $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
        if(auth()->user()->role == 0){
            abort(404);
        }elseif(auth()->user()->role == 3){
            $workers = User::where('role', 0);
        }elseif(auth()->user()->role == 2){
            $workers = \Helper::categoriesWorkersSearch();
            
        }elseif(auth()->user()->role == 1){
            $workers = \Helper::categoriesWorkersSearch();
        }
        $workers = $workers->paginate(20);


        $selceted_country = '';
        $selceted_category = '';
        
        if ($request->has('category') && $request->category !== 0 && $request->category !== null && $request->category !== 'null' && $request->category !== 'all') {
            $selceted_category = $request->category;
        }
         if ($request->has('country') && $request->country !== 0 && $request->country !== null && $request->country !== 'null' && $request->country !== 'all') {
                    $selceted_country = $request->country;
                }
            // dd($selceted_country);


        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selceted_type = '';
        $selceted_skill = '';
        $selceted_sorting = '';
        $selceted_education = '';
        $gen = '';
        
        $data = array(
            'unlock' => $unlock,
            'workers' => $workers,
            'selceted_country' => $selceted_country,
            'selceted_gender' => $selceted_gender,
            'selceted_experience' => $selceted_experience,
            'selceted_salary' => $selceted_salary,
            'selceted_type' => $selceted_type,
            'selceted_skill' => $selceted_skill,
            'selceted_category' => $selceted_category,
            'selceted_education' => $selceted_education,
            'selceted_sorting' => $selceted_sorting,
        );
        if(auth()->user()->role != 0){
           return view('search.workers.index')->with($data);
        }
        
        
    }

}