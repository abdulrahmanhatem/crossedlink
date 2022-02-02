<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Job;
use App\Country;
use App\City;
use Hash;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        $data = array(
            'jobs' => $jobs, 
            'search' => '',
        );
        return view('dashboard.jobs.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $jobs = Job::where('title', 'LIKE', "%".$name."%")->orWhere('address', 'LIKE', "%".$name."%")->orWhere('qual', 'LIKE', "%".$name."%")->orWhere('overview', 'LIKE', "%".$name."%")->orWhere('resp', 'LIKE', "%".$name."%")->orWhere('desc', 'LIKE', "%".$name."%")->paginate(100);
        $data = array(
            'jobs' => $jobs, 
            'search' => $name,
        );
        return view('dashboard.jobs.index')->with($data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::pluck('name','id');
                
        $user_country = Country::where('code',auth()->user()->country)->first();
        if($user_country != null){
            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
        }else{
            $user_city =[];
            $user_country = 0;
        }
        return view('dashboard.jobs.create',compact('country','user_city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'city' => 'required',
            'address' => 'required',
            'country' => 'required',
            'salary' => 'required',
            'docs' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:9999'
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
        return Redirect::back()->with('success', 'Job Created');
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
        return view('dashboard.jobs.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        $user_country = Country::where('code',$job->country)->first();
        if($user_country != null){
            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
        }else{
            $user_city =[];
        }
        $data = array(
            'job' => $job,
            'user_city' => $user_city,
            'user_country' => $user_country
        );
        return view('dashboard.jobs.edit')->with($data);
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
        $this->validate($request, [
            'title' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'salary' => 'required',
            'docs' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:9999'
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
        $job->sponsored = $request->input('sponsored');
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
        return Redirect::back()->with('success', 'Job Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete job
        $job = Job::find($id);

        $job->delete();

        return Redirect::to('dashboard/jobs')->with('success', 'Job Deleted');
    }

    


}
