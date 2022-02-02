<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Education;
use Hash;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::all();
        $data = array(
            'educations' => $educations, 
        );
        return view('dashboard.educations.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.educations.create');
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
            'school' => 'required',
            'degree' => 'required',
            'level' => 'required',
            'ref' => 'required',
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'required',
            'brief' => 'string|min:10|max:90',
        ]);

        // Create education
        $education = new Education;
        $education->title = $request->input('title');
        $education->level = $request->input('level');
        $education->school = $request->input('school');
        $education->degree = $request->input('degree');
        $education->from = $request->input('from');
        $education->ref = $request->input('ref');
        $education->to = $request->input('to');
        $education->brief = $request->input('brief');
        $education->user_id = $request->input('user_id');
        $education->save();

        return Redirect::back()->with('success', 'Education Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $education = Education::find($id);
        $data = array(
            'education' => $education
        );
        return view('dashboard.educations.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $education = Education::find($id);
        $data = array(
            'education' => $education
        );
        return view('dashboard.educations.edit')->with($data);
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
            'level' => 'required',
            'school' => 'required',
            'degree' => 'required',
            'ref' => 'required',
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'required',
            'brief' => 'string|min:10|max:90',
        ]);

        // Create education
        $education = Education::find($id);
        $education->title = $request->input('title');
        $education->level = $request->input('level');
        $education->school = $request->input('school');
        $education->degree = $request->input('degree');
        $education->ref = $request->input('ref');
        $education->from = $request->input('from');
        $education->to = $request->input('to');
        $education->brief = $request->input('brief');
        $education->user_id = $request->input('user_id');
        $education->save();
        
        return Redirect::back()->with('success', 'Education Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete education
        $education = Education::find($id);

        $education->delete();

        return Redirect::back()->with('success', 'Education Deleted');
    }
}
