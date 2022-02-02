<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\JobRequest;
use Hash;

class JobRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs  = JobRequest::all();
        $data = array(
            'jobs' => $jobs , 
        );
        return view('dashboard.job_requests.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.job_requests.create');
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
            'worker_id' => 'required',
            'job_id' => 'required',
        ]);

        // Create Job
        $job = new JobRequest;
        $job->worker_id = $request->input('worker_id');
        $job->job_id = $request->input('job_id');
        $job->state = 0;
        
        $job->save();
        return Redirect::back()->with('success', 'Job Request Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = JobRequest::find($id);
        $data = array(
            'job' => $job
        );
        return view('dashboard.job_requests.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = JobRequest::find($id);
        $data = array(
            'job' => $job
        );
        return view('dashboard.job_requests.edit')->with($data);
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
            'worker_id' => 'required',
            'job_id' => 'required',
        ]);

        // Create Job
        $job = JobRequest::find($id);
        $job->worker_id = $request->input('worker_id');
        $job->job_id = $request->input('job_id');
        $job->state = 0;
        
        $job->save();
        return Redirect::back()->with('success', 'Job Request Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Job
        $job = JobRequest::find($id);

        $job->delete();

        return Redirect::back()->with('success', 'Job Request Deleted');
    }
}
