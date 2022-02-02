<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Cobone;
use Hash;

class CoboneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobones = Cobone::paginate(20);
        $data = array(
            'cobones' => $cobones, 
        );
        return view('dashboard.cobones.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cobones.create');
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
            'code' => 'required',
            'percentage' => 'required',
        ]);

        // Create cobone
        $cobone = new Cobone;
        $cobone->code = $request->input('code');
        $cobone->percentage = $request->input('percentage');
        $cobone->save();
        return Redirect::back()->with('success', 'Cobone Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cobone = Cobone::find($id);
        $data = array(
            'cobone' => $cobone
        );
        return view('dashboard.cobones.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cobone = Cobone::find($id);
        $data = array(
            'cobone' => $cobone
        );
        return view('dashboard.cobones.edit')->with($data);
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
            'code' => 'required',
            'percentage' => 'required',
        ]);

        // Create cobone
        $cobone = Cobone::find($id);
        $cobone->code = $request->input('code');
        $cobone->percentage = $request->input('percentage');
        $cobone->save();
        return Redirect::back()->with('success', 'Cobone Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete cobone
        $cobone = Cobone::find($id);

        $cobone->delete();

        return Redirect::back()->with('success', 'Cobone Deleted');
    }

    public function generate(){
        $no = 5;
        
        for ($i=0; $i < $no; $i++) { 
            $cobone = new Cobone;
            $cobone->code = mt_rand(10000000000, 99999999999);
            $range = array(50,60,70,80, 90, 100);
            $percentageRange = $range[array_rand($range, 1)];
            $cobone->percentage = $percentageRange;
            $cobone->save();
        }
        
        return Redirect::back()->with('success', $no. 'Cobones Generated');
    }
}
