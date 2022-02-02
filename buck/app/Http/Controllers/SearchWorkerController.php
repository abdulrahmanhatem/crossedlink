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

class SearchWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selceted_type = '';
        $selceted_skill = '';
        $selceted_category = '';
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
        return view('search.workers.index')->with($data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        
        // Jobs By Category With No Search Changes 
        $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
        
        /*if(auth()->user()->role == 3){
            $workers = User::where('role', 0);
        }elseif(auth()->user()->role == 2){
            $workers = \Helper::categoriesWorkersSearch();
        }elseif(auth()->user()->role == 1){
            $workers = \Helper::categoriesWorkersSearch();
        }*/
        /*if(auth()->user()->role == 3){
            $workers = User::where('role', 0)->paginate(15);
        }elseif(auth()->user()->role == 2){
            $workers = \Helper::companyWorkers();
        }elseif(auth()->user()->role == 1){
            $workers = \Helper::personalWorkers();
        }*/
        
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
        

        if ($request->has('category')) {
            
            if($request->input('category') != null){
                if($request->input('category') == 'all'){
                    if(auth()->user()->role == 3){
                        $workers = User::where('role', 0);
                    }elseif(auth()->user()->role == 2){
                        $workers = \Helper::categoriesWorkersSearch();
                        
                    }elseif(auth()->user()->role == 1){
                        $workers = \Helper::categoriesWorkersSearch();
                    } 
                }else{
                    $workers =  \Helper::categoriesWorkersSearchByOne($request->input('category'));
                    /*$workers->where('category_id', $request->input('category'));*/
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
            /*$workers = \Helper::categoriesWorkersSearch(); */
            if(auth()->user()->role == 3){
                $workers = User::where('role', 0);
            }elseif(auth()->user()->role == 2){
                $workers = \Helper::categoriesWorkersSearch();
            }elseif(auth()->user()->role == 1){
                $workers = \Helper::categoriesWorkersSearch();
            }
        }

        
        if ($request->has('country')) {
            if( count($request->input('country')) > 0){
                $workers->whereIn('country', $request->input('country'));
               
                
                $selceted_country = $request->input('country');
            }
        }

        

        
        if ($request->has('gender')) {
            
            $workers->whereIn('gender', $request->input('gender'));
            
            
            $selceted_gender = $request->input('gender');
        }
        
        if ($request->has('salary')) {
            $workers->whereIn('average_salary', $request->input('salary'));
            $selceted_salary = $request->input('salary');
        }

        if ($request->has('experience')) {

            $ex_array = [];
            if(in_array( 1, $request->input('experience'))){
                foreach ([0,1,2] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 2, $request->input('experience'))){
                foreach ([3,4,5] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 3, $request->input('experience'))){
                foreach ([6,7,8] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 4, $request->input('experience'))){
                array_push($ex_array, 9);
            }

            $workers->whereIn('experience', $ex_array);
            $selceted_experience = $request->input('experience');
        }

        if ($request->has('education')) {
            $educational_level = \Helper::usersByEducationalLevel($request->input('education'));
            $selceted_education = $request->input('education');
            
        }

        /*if ($request->has('skill')) {
            $skills_workers = \Helper::usersBySkill($request->input('skill'));
            $selceted_skill = $request->input('skill');
        }*/
        $workers_id = [];
        $workers_sorting = [];
        $workers = $workers->get();
        
        $workers_ = json_decode($workers, true);
        
        foreach($workers_ as $worker){
            if(count($educational_level) > 0){
                $educational_level = \Helper::usersByEducationalLevel($request->input('education'));
                $educational_level = json_decode($educational_level, true);
                
                
                foreach($educational_level as $level_worker){
                    
                    if($worker['id'] == $level_worker['id']){
                        array_push($workers_id, $worker['id']);
                    }
                    
                }
                /*dd($workers_id['id']);*/
                

            }else{
                array_push($workers_id, $worker['id']);
                
            }
        }

        // work here
        
        if ($request->has('sorting') ) {
            if($request->input('sorting') != 0 || null){
                if($request->input('sorting') == 1){
                    $workers = User::orderBy('name')->whereIn('id', $workers_id)->paginate(15);
                }
                if($request->input('sorting') == 2){
                    $workers = User::orderBy('experience','DESC' )->whereIn('id', $workers_id)->paginate(15);
                }
                if($request->input('sorting') == 3){
                    $workers = User::orderBy('average_salary', 'ASC')->whereIn('id', $workers_id)->paginate(15);
                }
                if($request->input('sorting') == 4){
                    $workers = User::orderBy('average_salary', 'DESC')->whereIn('id', $workers_id)->paginate(15);
                }
                $selceted_sorting = $request->input('sorting');
            }else{
                $workers = User::whereIn('id', $workers_id)->paginate(15);
            }
            
        }else{
            $workers = User::whereIn('id', $workers_id)->paginate(15);
        }
        
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        
        
    }
}
