<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\PricingRequest;
use App\Package;
use Hash;
use Carbon\Carbon;


class PricingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricings = PricingRequest::orderByRaw("FIELD(state , 0, 1, 2,3) ASC")->get();
        $data = array(
            'pricings' => $pricings, 
        );
        return view('dashboard.pricings.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pricings.create');
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
            'package_id' => 'required',
            'user_id' => 'required',
            'role' => 'required',
            /*'profiles' => 'required',
            'ads' => 'required',*/
        ]);

        // Create pricing
        
        $pricing = new PricingRequest;
        $pricing->package_id = $request->input('package_id');
        /*$pricing->profiles = $request->input('profiles');*/
        /*$pricing->ads = $request->input('ads');*/
        $pricing->user_id = $request->input('user_id');
        $pricing->role = $request->input('role');
        $pricing->state = 0;
        $pricing->start_date = Carbon::now();

        $package = Package::find($request->input('package_id'))->first();
        $pricing->expired_date = Carbon::now()->addDays($package->period);
        $pricing->save();
        return Redirect::back()->with('success', 'Request Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pricing = PricingRequest::find($id);
        $data = array(
            'pricing' => $pricing
        );
        return view('dashboard.pricings.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pricing = PricingRequest::find($id);
        $data = array(
            'pricing' => $pricing
        );
        return view('dashboard.pricings.edit')->with($data);
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
        if($request->has('approve')){
            $this->validate($request, []);
            $pricing = PricingRequest::find($request->input('pricing_id'));
            $package = PricingRequest::where('user_id', $request->input('user_id'))->whereIn('role', [1,2])->first();
            $package = PricingRequest::find($package->id);
            if($pricing->role == 3 || $pricing->role == 4){
                $pricing->state = 1;
                $pricing->save();

                /*$package->profiles = $package->profiles + $request->input('profiles');
                $package->ads = $package->ads + $request->input('ads');
                $package->save();*/
                return Redirect::back()->with('success', 'Extention Added');
            }else{
                // Create pricing
                
                $pricing->state = 1;
                $pricing->save();
                return Redirect::back()->with('success', 'Pricing Request Approved');
            }
        }elseif($request->has('deactivate')){
            $this->validate($request, []);
            $pricing = PricingRequest::find($request->input('pricing_id'));
            $pricing->expired_date = Carbon::now();
            $pricing->state = 3;
            $pricing->save();
            return Redirect::back()->with('success', 'Request Canceled');
        }else{
            $this->validate($request, [
                'package_id' => 'required',
                'user_id' => 'required',
                'role' => 'required',
                /*'profiles' => 'required',
                'ads' => 'required',*/
            ]);
    
            // Create pricing
            $pricing = PricingRequest::find($id);
            $pricing->package_id = $request->input('package_id');
            $pricing->profiles = $request->input('profiles');
            $pricing->ads = $request->input('ads');
            $pricing->user_id = $request->input('user_id');
            $pricing->role = $request->input('role');
            $pricing->start_date = Carbon::now();

            $package = Package::find($request->input('package_id'))->first();
            $pricing->expired_date = Carbon::now()->addDays($package->period);
            $pricing->save();
            return Redirect::back()->with('success', 'Pricing Request Edited');
        }
        

        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete pricing
        $pricing = PricingRequest::find($id);

        $pricing->delete();

        return Redirect::back()->with('success', 'Request Deleted');
    }

    
}
