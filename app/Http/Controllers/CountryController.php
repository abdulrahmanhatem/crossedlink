<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Country;
use Hash;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(50);
        $data = array(
            'countries' => $countries, 
            'search' => '', 
        );
        return view('dashboard.countries.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $countries = Country::where('name', 'LIKE', "%".$name."%")->paginate(100);
        $data = array(
            'countries' => $countries, 
            'search' => $name, 
        );
        return view('dashboard.countries.index')->with($data);
    }

    

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.countries.create');
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
            'code' => 'required',
        ]);

        // Create country
        $country = new Country;
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        $country->save();
        return Redirect::back()->with('success', 'Country Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        $data = array(
            'country' => $country
        );
        return view('dashboard.countries.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        $data = array(
            'country' => $country
        );
        return view('dashboard.countries.edit')->with($data);
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
            'code' => 'required',
        ]);

        // Create country
        $country = Country::find($id);
        $country->name = $request->input('name');
        $country->code = $request->input('code');

        $country->save();
        return Redirect::back()->with('success', 'Country Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete country
        $country = Country::find($id);

        $country->delete();

        return Redirect::to('dashboard/countries')->with('success', 'Country Deleted');
    }
}
