<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Skill;
use Hash;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        $data = array(
            'skills' => $skills, 
        );
        return view('dashboard.skills.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.skills.create');
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
            'type' => 'required',
            'name' => 'required',
            'percentage' => 'required',
            'user_id' => 'required',
        ]);
       

        // Create skill
        $skill = new Skill;
        $skill->type = $request->input('type');
        $skill->name = $request->input('name');
        $skill->percentage = $request->input('percentage');
        $skill->user_id = $request->input('user_id');
        $skill->save();

        return Redirect::back()->with('success', 'Skill Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill = Skill::find($id);
        $data = array(
            'skill' => $skill
        );
        return view('dashboard.skills.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skill = skill::find($id);
        $data = array(
            'skill' => $skill
        );
        return view('dashboard.skills.edit')->with($data);
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
            'name' => 'required',
            'type' => 'required',
            'percentage' => 'required',
            'user_id' => 'required',
        ]);
       

        // Create skill
        $skill = Skill::find($id);
        $skill->type = $request->input('type');
        $skill->name = $request->input('name');
        $skill->percentage = $request->input('percentage');
        $skill->user_id = $request->input('user_id');
        $skill->save();

        return Redirect::back()->with('success', 'skill Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete skill
        $skill = Skill::find($id);

        $skill->delete();

        return Redirect::back()->with('success', 'Skill Deleted');
    }
}
