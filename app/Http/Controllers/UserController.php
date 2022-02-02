<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $admins = User::where('role', 1)->get();
        $companies = User::where('role', 0)->get();
        $data = array(
            'users' => $users, 
            'admins' => $admins, 
            'companies' => $companies
        );
        return view('profiles.index')->with($data);
    }

    public function admins()
    {
        $admins = User::where('role', 1)->get();
        $data = array(
            'admins' => $admins, 
        );
        return view('admins.index')->with($data);
    }

    public function companies()
    {
        $companies = User::where('role', 0)->get();
        $data = array(
            'companies' => $companies, 
        );
        return view('companies.index')->with($data);
    }

    public function create_admins()
    {
        return view('admins.create');
    }

    public function create_companies()
    {
        return view('companies.create');
    }

    public function edit_admins($id)
    {
        $admin = User::find($id);
        $data = array(
            'admin' => $admin, 
        );
        return view('admins.edit')->with($data);
    }

    public function edit_companies($id)
    {
        $company = User::find($id);
        $data = array(
            'company' => $company, 
        );
        return view('companies.edit')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
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
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation', 
            'password_confirmation' => 'min:6'
        ]);

        // Handle File Upload
        if($request->hasFile('profile_image')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename To Store
            $profile_image = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
            $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
        }

        // Edit Post
        $user = new User;
        $user->company_name = $request->input('company_name');
        $user->name = $request->input('name');
        if($request->hasFile('profile_image')){
            $user->profile_image = $profile_image;
        }else{
            $user->profile_image = '';
        }
        
        $user->company_name = '';
        $user->email = $request->input('email');
        $user->password = Hash::make('password');
        $user->password = Hash::make('password_confirmation');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->address = $request->input('address');
        $user->website = $request->input('website');
        $user->save();
        return Redirect::back()->with('success', 'Profile Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
        if(!auth()->check()){
            return view('auth.login');
        }else{
            $user = User::find($id);
            $data = array(
                'user' => $user
            );
            return view('profiles.show')->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = array(
            'user' => $user
        );
        return view('profiles.show')->with($data);
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
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation', 
            'password_confirmation' => 'min:6'
        ]);

        // Handle File Upload
        if($request->hasFile('profile_image')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename To Store
            $profile_image = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
            $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
        }

        // Edit User
        $user = User::find($id);
        $user->company_name = $request->input('company_name');
        $user->name = $request->input('name');
        $user->password = Hash::make('password_confirmation');
        if($request->hasFile('profile_image')){
            $user->profile_image = $profile_image;
        }
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->website = $request->input('website');
        $user->save();
        return Redirect::back()->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Post
        $user = User::find($id);

        $user->delete();

        return Redirect::back()->with('success', 'User Deleted');
    }
}
