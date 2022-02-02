<?php
// edited
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Job;
use App\User;

class SearchJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 0){
            // dd(auth()->user()->category_id);
            $jobs = \Helper::categoriesJobsSearch(auth()->user()->category_id)->where('state', 0)->paginate(15);
            // $jobs = job::where('id', '>', 0)->paginate(15);
        }else{
            $jobs = job::where('id', '>', 0)->paginate(15);
        }
        $selceted_country = '';
        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selceted_type = '';
        $selceted_period = '';
        $data = array(
            'l'=> '',
            'jobs' => $jobs,
            'selceted_country' => $selceted_country,
            'selceted_gender' => $selceted_gender,
            'selceted_experience' => $selceted_experience,
            'selceted_salary' => $selceted_salary,
            'selceted_type' => $selceted_type,
            'selceted_period' => $selceted_period,
        );
        return view('search.jobs.index')->with($data);
    
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
        
        // Jobs By Category With No Search Changes 
        if(auth()->user()->role == 0){
            $jobs = \Helper::categoriesJobsSearch(auth()->user()->category_id)->where('state', 0); 
            /*$jobs = job::where('category_id', auth()->user()->category_id)->where('state', 0);*/
        }else{
            $jobs = job::where('id', '>', 0);
        }
        
        $selceted_country = '';
        $selceted_gender = '';
        $selceted_experience = '';
        $selceted_salary = '';
        $selected_type = '';
        $selceted_period = '';

        if ($request->has('updated_at')) {
            if($request->input('updated_at') ==  0){

                $jobs->whereBetween('updated_at', [Carbon::now()->subHour(), Carbon::now()]);
                $selceted_period = 0;
            }
            if($request->input('updated_at') ==  1){
                $jobs->whereBetween('updated_at', [Carbon::now()->subHours(24), Carbon::now()]);
                $selceted_period = 1;
            }
            if($request->input('updated_at') ==  2){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(7), Carbon::now()]);
                $selceted_period = 2;
            }
            if($request->input('updated_at') ==  3){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(14), Carbon::now()]);
                $selceted_period = 3;
            }
            if($request->input('updated_at') ==  4){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(30), Carbon::now()]);
                $selceted_period = 4;
            }
            if($request->input('updated_at') ==  5){
                $jobs->whereBetween('updated_at', [Carbon::now()->subDays(180), Carbon::now()]);
                $selceted_period = 5;
            }
        }


        if ($request->has('country')) {
            $jobs->whereIn('country', $request->input('country'));
            $selceted_country = $request->input('country');
        }

        if ($request->has('type')) {
            $jobs->whereIn('type', $request->input('type'));
            $selected_type = $request->input('type');
        }
        

        if ($request->has('gender')) {
            $jobs->whereIn('gender', $request->input('gender'));
            
            
            $selceted_gender = $request->input('gender');
        }
        
        if ($request->has('salary')) {
            $jobs->whereIn('salary', $request->input('salary'));
            $selceted_salary = $request->input('salary');
        }

        

        if ($request->has('experience')) {

            $ex_array = [];
            if(in_array( 1, $request->input('experience'))){
                foreach ([0,1,2,3] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 2, $request->input('experience'))){
                foreach ([4,5,6] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 3, $request->input('experience'))){
                foreach ([7,8,9] as $value) {
                    array_push($ex_array, $value);
                }
            }
            if(in_array( 4, $request->input('experience'))){
                array_push($ex_array, 9);
            }

            $jobs->whereIn('experience', $ex_array);
            $selceted_experience = $request->input('experience');
        }

        

        
        $data = array(
            'l'=> $request->input('experience'),
            'jobs' => $jobs->paginate(15),
            'selceted_country' => $selceted_country,
            'selceted_country' => $selceted_country,
            'selceted_gender' => $selceted_gender,
            'selceted_experience' => $selceted_experience,
            'selceted_salary' => $selceted_salary,
            'selected_type' => $selected_type,
            'selceted_period' => $selceted_period,
        );
        /*return dd($data);*/
        return view('search.jobs.index')->with($data);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        $data = array(
            'job' => $job
        );
        return view('workers.jobs.show')->with($data);
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
