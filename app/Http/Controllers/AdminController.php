<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', 3)->get();
        $data = array(
            'admins' => $admins, 
            'search' => '', 
        );
        return view('dashboard.admins.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $admins = User::where([['role','=',3],['name','LIKE', "%".$name."%"]])->orWhere([['role','=',3],['first_name','LIKE', "%".$name."%"]])->orWhere([['role','=',3],['middle_name','LIKE', "%".$name."%"]])->orWhere([['role','=',3],['email','LIKE', "%".$name."%"]])->orWhere([['role','=',3],['phone','LIKE', "%".$name."%"]])->paginate(100);
        $data = array(
            'admins' => $admins, 
            'search' => $name, 
        );
        return view('dashboard.admins.index')->with($data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            /*'password' => 'min:6|required_with:password_confirmation|same:password_confirmation', 
            'password_confirmation' => 'min:6'*/
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
        
        $admin = new User;
        
        
        $admin->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $admin->first_name = $request->input('first_name');
        $admin->middle_name =  $request->input('middle_name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->phone = $request->input('phone');
        $admin->role = 3;
        $admin->lang = 'en';
        $admin->country = '';
        $admin->company_name = '';
        if($request->hasFile('profile_image')){
            $admin->profile_image = $profile_image;
        }else{
            $admin->profile_image = '';
        }
        
        $admin->save();
        
        
        return Redirect::back()->with('success', 'Admin Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::find($id);
        $data = array(
            'admin' => $admin
        );
        return view('dashboard.admins.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        $data = array(
            'admin' => $admin
        );
        return view('dashboard.admins.edit')->with($data);
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
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

        
        $admin = User::find($id);
        $admin->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $admin->first_name = $request->input('first_name');
        $admin->middle_name =  $request->input('middle_name');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->role = 3;
        $admin->lang = 'en';
        $admin->country = '';
        $admin->company_name = '';
        if($request->hasFile('profile_image')){
            $admin->profile_image = $profile_image;
        }
        if(!empty($request->input('password'))){
            $this->validate($request, [
                'password' => 'min:6'
            ]);
            $admin->password = bcrypt($request->input('password'));
            $admin->save();
        }
        $admin->save();
        return Redirect::back()->with('success', 'Admin Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Admin
        $admin = User::find($id);

        $admin->delete();

        return Redirect::to('dashboard/admins')->with('success', 'Admin Deleted');
    }

    
}
