<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\SavedJob;
use App\UnlockWorker;
use Hash;

class SavedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saveds = SavedJob::all();
        $data = array(
            'saveds' => $saveds, 
        );
        return view('dashboard.saved.jobs.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.saved.jobs.create');
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
            'user_id' => 'required',
            'job_id' => 'required',
        ]);
       

        // Create saved
        $saved = new SavedJob;
        
        $saved->user_id = $request->input('user_id');
        $saved->job_id = $request->input('job_id');
        $saved->save();

        return Redirect::back()->with('success', 'Saved Item Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saved = SavedJob::find($id);
        $data = array(
            'saved' => $saved
        );
        return view('dashboard.saved.jobs.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saved = SavedJob::find($id);
        $data = array(
            'saved' => $saved
        );
        return view('dashboard.saved.jobs.edit')->with($data);
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
            'user_id' => 'required',
            'job_id' => 'required',
        ]);
       

        // Create saved
        $saved = SavedJob::find($id);
        $saved->user_id = $request->input('user_id');
        $saved->job_id = $request->input('job_id');
        $saved->save();

        return Redirect::back()->with('success', 'Saved Item Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete saved
        $saved = SavedJob::find($id);

        $saved->delete();

        return Redirect::back()->with('success', 'Saved Item Deleted');
    }
}
