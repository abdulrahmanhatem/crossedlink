<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\City;
use Hash;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::paginate(20);
        $data = array(
            'cities' => $cities, 
            'search' => '', 
        );
        return view('dashboard.cities.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $cities = City::where('name', 'LIKE', "%".$name."%")->paginate(100);
        $data = array(
            'cities' => $cities, 
            'search' => $name, 
        );
        return view('dashboard.cities.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cities.create');
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
            'name' => 'required',
            'country_id' => 'required',
        ]);

        // Create city
        $city = new City;
        $city->name = $request->input('name');
        $city->country_id = $request->input('country_id');
        $city->save();
        return Redirect::back()->with('success', 'City Created');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        $data = array(
            'city' => $city
        );
        return view('dashboard.cities.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $data = array(
            'city' => $city
        );
        return view('dashboard.cities.edit')->with($data);
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
            'country_id' => 'required',
        ]);

        // Create city
        $city = City::find($id);
        $city->name = $request->input('name');
        $city->country_id = $request->input('country_id');
        $city->save();
        return Redirect::back()->with('success', 'City Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete city
        $city = City::find($id);

        $city->delete();

        return Redirect::to('dashboard/cities')->with('success', 'City Deleted');
    }
}
