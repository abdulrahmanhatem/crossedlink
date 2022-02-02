<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\SocialFacebookAccount;
use App\SocialGoogleAccount;
use App\SocialTwitterAccount;
use Hash;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = User::where('role', 1)->get();
        $data = array(
            'persons' => $persons, 
            'search' => '',
            
        );
        return view('dashboard.persons.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $persons = User::where([['role','=',1],['name','LIKE', "%".$name."%"]])->orWhere([['role','=',1],['first_name','LIKE', "%".$name."%"]])->orWhere([['role','=',1],['middle_name','LIKE', "%".$name."%"]])->orWhere([['role','=',1],['email','LIKE', "%".$name."%"]])->orWhere([['role','=',1],['phone','LIKE', "%".$name."%"]])->orWhere([['role','=',1],['website','LIKE', "%".$name."%"]])->paginate(100);
        $data = array(
            'persons' => $persons, 
            'search' => $name,
        );
        return view('dashboard.persons.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.persons.create');
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
            'password' => 'min:6',
            'country' => 'required',
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

        // Create person
        $person = new User;
        $person->role = 1;
        // person Indormations
        $person->email = $request->input('email');
        $person->phone = $request->input('phone');
        $person->address = $request->input('address');

        // Contact Informations
        $person->first_name = $request->input('first_name');
        $person->middle_name = $request->input('middle_name');
        $person->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $person->password = bcrypt($request->input('password'));
        $person->country = $request->input('country');

        // Overview & Services
        $person->overview = $request->input('overview');
        $person->services = $request->input('services');

        // Work Houres
        $person->sa_from = $request->input('sa_from');
        $person->su_from  = $request->input('su_from');
        $person->mo_from  = $request->input('mo_from');
        $person->tu_from  = $request->input('tu_from');
        $person->we_from  = $request->input('we_from');
        $person->th_from  = $request->input('th_from');
        $person->fr_from  = $request->input('fr_from');
        $person->sa_to= $request->input('sa_to');
        $person->su_to  = $request->input('su_to');
        $person->mo_to = $request->input('mo_to');
        $person->tu_to  = $request->input('tu_to');
        $person->we_to  = $request->input('we_to');
        $person->th_to  = $request->input('th_to');
        $person->fr_to = $request->input('fr_to');


        
        if($request->hasFile('profile_image')){
            $person->profile_image = $profile_image;
        }else{
            $person->profile_image = '';
        }

        
        
        $person->save();
        return Redirect::back()->with('success', 'Personal Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = User::find($id);
        $data = array(
            'person' => $person
        );
        return view('dashboard.persons.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = User::find($id);
        $data = array(
            'person' => $person
        );
        return view('dashboard.persons.edit')->with($data);
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
            'country' => 'required',
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

        // Create person
        $person = User::find($id);
        $person->role = 1;
        // person Indormations
        $person->email = $request->input('email');
        $person->phone = $request->input('phone');
        $person->address = $request->input('address');

        // Contact Informations
        $person->first_name = $request->input('first_name');
        $person->middle_name = $request->input('middle_name');
        $person->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $person->country = $request->input('country');

        // Overview & Services
        $person->overview = $request->input('overview');
        $person->services = $request->input('services');

        // Work Houres
        $person->sa_from = $request->input('sa_from');
        $person->su_from  = $request->input('su_from');
        $person->mo_from  = $request->input('mo_from');
        $person->tu_from  = $request->input('tu_from');
        $person->we_from  = $request->input('we_from');
        $person->th_from  = $request->input('th_from');
        $person->fr_from  = $request->input('fr_from');
        $person->sa_to= $request->input('sa_to');
        $person->su_to  = $request->input('su_to');
        $person->mo_to = $request->input('mo_to');
        $person->tu_to  = $request->input('tu_to');
        $person->we_to  = $request->input('we_to');
        $person->th_to  = $request->input('th_to');
        $person->fr_to = $request->input('fr_to');

        if(!empty($request->input('password'))){
            $this->validate($request, [
                'password' => 'min:6'
            ]);
            $person->password = bcrypt($request->input('password'));
            $person->save();
        }
        
        if($request->hasFile('profile_image')){
            $person->profile_image = $profile_image;
        }

        $person->save();
        return Redirect::back()->with('success', 'Personal Created');


      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete person
        $person = User::find($id);
        /*dd($id);*/
        
         $SocialFacebookAccountCount = SocialFacebookAccount::where('user_id',$id)->count();
		if($SocialFacebookAccountCount>0){
			$SocialFacebookAccount = SocialFacebookAccount::where('user_id',$id);
			$SocialFacebookAccount->delete();
		}
        $SocialGoogleAccountCount = SocialGoogleAccount::where('user_id',$id)->count();
		if($SocialGoogleAccountCount>0){
			$SocialGoogleAccount = SocialGoogleAccount::where('user_id',$id);
			$SocialGoogleAccount->delete();
		}
        $SocialTwitterAccountCount = SocialTwitterAccount::where('user_id',$id)->count();
		if($SocialTwitterAccountCount>0){
			$SocialTwitterAccount = SocialTwitterAccount::where('user_id',$id);
			$SocialTwitterAccount->delete();
		}
        
        $person->delete();

        return Redirect::to('dashboard/personal')->with('success', 'Personal Deleted');
    }
}
