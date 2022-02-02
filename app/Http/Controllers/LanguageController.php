<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\language;
use Hash;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        $data = array(
            'languages' => $languages, 
        );
        return view('dashboard.languages.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.languages.create');
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
            'language' => 'required',
            'proficiency' => 'required',
            'user_id' => 'required',
        ]);

        // Create language
        $language = new Language;
        $language->language = $request->input('language');
        $language->proficiency = $request->input('proficiency');
        $language->user_id = $request->input('user_id');
        $language->save();
        return Redirect::back()->with('success', 'Language Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);
        $data = array(
            'language' => $language
        );
        return view('dashboard.languages.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);
        $data = array(
            'language' => $language
        );
        return view('dashboard.languages.edit')->with($data);
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
            'language' => 'required',
            'proficiency' => 'required',
            'user_id' => 'required',
        ]);

        // Create language
        $language = Language::find($id);
        $language->language = $request->input('language');
        $language->proficiency = $request->input('proficiency');
        $language->user_id = $request->input('user_id');
        $language->save();

        return Redirect::back()->with('success', 'Language Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete language
        $language = Language::find($id);

        $language->delete();

        return Redirect::back()->with('success', 'Language Deleted');
    }
}
