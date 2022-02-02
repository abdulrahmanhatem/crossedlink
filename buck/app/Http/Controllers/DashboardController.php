<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$admins = User::where('role', 3)->get();
        $data = array(
            'admins' => $admins, 
        );*/
        return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*return view('dashboard.admins.create');*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
      /*  $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            /*'password' => 'min:6|required_with:password_confirmation|same:password_confirmation', 
            'password_confirmation' => 'min:6'*/
       /* ]);

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

        // Create Admin
        $admin = new User;
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make('password');
        if($request->hasFile('profile_image')){
            $admin->profile_image = $profile_image;
        }else{
            $admin->profile_image = '';
        }
        $admin->phone = $request->input('phone');
        $admin->role = 3;
        $admin->address = $request->input('address');
        $admin->experience = $request->input('experience');
        $admin->followers = $request->input('followers');
        $admin->overview = $request->input('overview');
        $admin->services = $request->input('services');
        $admin->sa = $request->input('sa');
        $admin->su = $request->input('su');
        $admin->mo = $request->input('mo');
        $admin->tu = $request->input('tu');
        $admin->we = $request->input('we');
        $admin->th = $request->input('th');
        $admin->fr = $request->input('fr');
        $admin->package_id = $request->input('package_id');
        $admin->verified = $request->input('verified');
        $admin->credit = $request->input('credit');
        $admin->first_name = $request->input('first_name');
        $admin->middle_name = $request->input('middle_name');
        $admin->sur_name = $request->input('sur_name');
        $admin->birth = $request->input('birth');
        $admin->gender = $request->input('gender');
        $admin->married = $request->input('married');
        $admin->country = $request->input('country');
        $admin->state = $request->input('state');
        $admin->city = $request->input('city');
        $admin->school = $request->input('school');
        $admin->about = $request->input('about');
        $admin->rating = $request->input('rating');
        $admin->category_id = $request->input('category_id');
        $admin->save();
        
        /*$admin->password = '$2y$10$m0K4JjjKqNDu4cZF76wFTel0zhI0HE5usYKoXD39ab6VZ52wfETMa';*/
        
        
       /* return Redirect::back()->with('success', 'Admin Created');
    */}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       /* $admin = User::find($id);
        $data = array(
            'admin' => $admin
        );
        return view('dashboard.admins.show')->with($data);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $admin = User::find($id);
        $data = array(
            'admin' => $admin
        );
        return view('dashboard.admins.edit')->with($data);*/
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
       /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            /*'password' => 'min:6|required_with:password_confirmation|same:password_confirmation', 
            'password_confirmation' => 'min:6'*/
       /* ]);

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

        // Edit Admin
        $admin = User::find($id);
        $admin->company_name = $request->input('company_name');
        $admin->name = $request->input('name');
        /*$admin->password = Hash::make('password');*/
       /* $admin->password = '$2y$10$m0K4JjjKqNDu4cZF76wFTel0zhI0HE5usYKoXD39ab6VZ52wfETMa';
        if($request->hasFile('profile_image')){
            $admin->profile_image = $profile_image;
        }
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $user->address = $request->input('address');
        $admin->website = $request->input('website');
        $admin->save();
        return Redirect::back()->with('success', 'Admin Edited');*/
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
        /*$admin = User::find($id);

        $admin->delete();

        return Redirect::back()->with('success', 'Admin Deleted');*/
    }
}
