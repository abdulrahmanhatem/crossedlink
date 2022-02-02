<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Experience;
use Hash;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::all();
        $data = array(
            'experiences' => $experiences, 
        );
        return view('dashboard.experiences.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.experiences.create');
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
            'job_title' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'user_id' => 'required',
            'ref' => 'required',
            'from' => 'required',
            'to' => 'required',
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
        $experience = new experience;
        $experience->job_title = $request->input('job_title');
        $experience->company_name = $request->input('company_name');
        $experience->ref = $request->input('ref');
        $experience->company_website = $request->input('company_website');
        $experience->company_address = $request->input('company_address');
        $experience->from = $request->input('from');
        $experience->to = $request->input('to');

        if($request->hasFile('company_logo')){
            $experience->company_logo = $company_logo;
        }else{
            $experience->company_logo = '';
        }

        $experience->user_id = $request->input('user_id');
        $experience->save();

        return Redirect::back()->with('success', 'Experience Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $experience = Experience::find($id);
        $data = array(
            'experience' => $experience
        );
        return view('dashboard.experiences.show')->with($data);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $experience = Experience::find($id);
        $data = array(
            'experience' => $experience
        );
        return view('dashboard.experiences.edit')->with($data);
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
            'job_title' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'user_id' => 'required',
            'ref' => 'required',
            'from' => 'required',
            'to' => 'required',
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
        $experience = Experience::find($id);
        $experience->job_title = $request->input('job_title');
        $experience->company_name = $request->input('company_name');
        $experience->ref = $request->input('ref');
        $experience->company_website = $request->input('company_website');
        $experience->company_address = $request->input('company_address');
        $experience->from = $request->input('from');
        $experience->to = $request->input('to');

        if($request->hasFile('company_logo')){
            $experience->company_logo = $company_logo;
        }

        $experience->user_id = $request->input('user_id');
        $experience->save();
        
        return Redirect::back()->with('success', 'Experience Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete experience
        $experience = Experience::find($id);

        $experience->delete();

        return Redirect::back()->with('success', 'Experience Deleted');
    }
}
