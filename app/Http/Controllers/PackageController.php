<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Package;
use App\Cobone;
use Hash;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::whereIn('role', [1,2])->get();
        $extentions = Package::whereIn('role', [3,4])->get();
        $data = array(
            'packages' => $packages, 
            'extentions' => $extentions, 
        );
        return view('dashboard.packages.index')->with($data);
    }

    public function companies()
    {
        $packages = package::where('role', 1)->get();
        $data = array(
            'packages' => $packages, 
        );
        return view('dashboard.packages.companies')->with($data);
    }

    public function personal()
    {
        $packages = package::where('role', 2)->get();
        $data = array(
            'packages' => $packages, 
        );
        return view('dashboard.packages.personal')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.packages.create');
    }

    public function createExtention()
    {
        return view('dashboard.packages.create_extention');
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
            'role' => 'required',
            'price' => 'required',
            'profiles' => 'required',
            'sponsored' => 'required',
            'period' => 'required',
            'ads' => 'required',
        ]);

        // Create package
        $package = new package;
        $package->role = $request->input('role');
        $package->name = $request->input('name');
        $package->price = $request->input('price');
        $package->profiles = $request->input('profiles');
        $package->sponsored = $request->input('sponsored');
        $package->period = $request->input('period');
        $package->ads = $request->input('ads');
        $package->details = $request->input('details');
        $package->tax = $request->input('tax');
        $package->old_price = $request->input('old_price');
        $package->save();
        return Redirect::back()->with('success', 'package Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = package::find($id);
        $data = array(
            'package' => $package
        );
        return view('dashboard.packages.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = package::find($id);
        $data = array(
            'package' => $package
        );
        return view('dashboard.packages.edit')->with($data);
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
            'role' => 'required',
            'price' => 'required',
            'profiles' => 'required',
            'sponsored' => 'required',
            'period' => 'required',
            'ads' => 'required',
        ]);

        // Create package
        $package = package::find($id);
        $package->role = $request->input('role');
        $package->name = $request->input('name');
        $package->price = $request->input('price');
        $package->profiles = $request->input('profiles');
        $package->sponsored = $request->input('sponsored');
        $package->period = $request->input('period');
        $package->ads = $request->input('ads');
        $package->details = $request->input('details');
        $package->tax = $request->input('tax');
        $package->old_price = $request->input('old_price');

        $package->save();
        return Redirect::back()->with('success', 'Package Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete package
        $package = package::find($id);

        $package->delete();

        return Redirect::back()->with('success', 'Package Deleted');
    }
    
    public function rec( $id)
    {
        
        $package = package::find($id);
        if($package->role == 1){
            $old = Package::where('role', 1)->where('rec', 1)->first();
            $package->rec = 1;
            $package->save();
        }
        if($package->role == 2){
            $old = Package::where('role', 2)->where('rec', 1)->first();
            $package->rec = 1;
            $package->save();
        }
        if($old){
            $old->rec = 0;
            $old->save(); 
        }
        
        
        return Redirect::back()->with('success', 'Updated as recommended Package');
    }
}
