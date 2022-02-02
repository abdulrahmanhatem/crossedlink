<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\SocialFacebookAccount;
use App\SocialGoogleAccount;
use App\SocialTwitterAccount;
use Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = User::where('role', 2)->get();
        $data = array(
            'companies' => $companies, 
            'search' => '', 
        );
        return view('dashboard.companies.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $companies = User::where([['role','=',2],['name','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['first_name','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['middle_name','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['company_name','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['email','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['phone','LIKE', "%".$name."%"]])->orWhere([['role','=',2],['website','LIKE', "%".$name."%"]])->paginate(100);
        $data = array(
            'companies' => $companies, 
            'search' => $name, 
        );
        return view('dashboard.companies.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.companies.create');
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
            'company_name' => 'required',
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

        // Create company
        $company = new User;
        $company->role = 2;
        // Company Indormations
        $company->company_name = $request->input('company_name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->website = $request->input('website');
        $company->address = $request->input('address');
        $company->experience = $request->input('experience');
        $company->employers = $request->input('employers');

        // Contact Informations
        $company->first_name = $request->input('first_name');
        $company->middle_name = $request->input('middle_name');
        $company->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $company->password = bcrypt($request->input('password'));
        $company->country = $request->input('country');

        // Overview & Services
        $company->overview = $request->input('overview');
        $company->services = $request->input('services');

        // Work Houres
        $company->sa_from = $request->input('sa_from');
        $company->su_from  = $request->input('su_from');
        $company->mo_from  = $request->input('mo_from');
        $company->tu_from  = $request->input('tu_from');
        $company->we_from  = $request->input('we_from');
        $company->th_from  = $request->input('th_from');
        $company->fr_from  = $request->input('fr_from');
        $company->sa_to= $request->input('sa_to');
        $company->su_to  = $request->input('su_to');
        $company->mo_to = $request->input('mo_to');
        $company->tu_to  = $request->input('tu_to');
        $company->we_to  = $request->input('we_to');
        $company->th_to  = $request->input('th_to');
        $company->fr_to = $request->input('fr_to');


        
        if($request->hasFile('profile_image')){
            $company->profile_image = $profile_image;
        }else{
            $company->profile_image = '';
        }
        
        
        $company->save();
        return Redirect::back()->with('success', 'company Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = User::find($id);
        $data = array(
            'company' => $company
        );
        return view('dashboard.companies.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = User::find($id);
        $data = array(
            'company' => $company
        );
        return view('dashboard.companies.edit')->with($data);
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
            'company_name' => 'required',
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

        // Create company
        $company = User::find($id);
        $company->role = 2;
        // Company Indormations
        $company->company_name = $request->input('company_name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->website = $request->input('website');
        $company->address = $request->input('address');
        $company->experience = $request->input('experience');
        $company->employers = $request->input('employers');

        // Contact Informations
        $company->first_name = $request->input('first_name');
        $company->middle_name = $request->input('middle_name');
        $company->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $company->country = $request->input('country');

        // Overview & Services
        $company->overview = $request->input('overview');
        $company->services = $request->input('services');

        // Work Houres
        $company->sa_from = $request->input('sa_from');
        $company->su_from  = $request->input('su_from');
        $company->mo_from  = $request->input('mo_from');
        $company->tu_from  = $request->input('tu_from');
        $company->we_from  = $request->input('we_from');
        $company->th_from  = $request->input('th_from');
        $company->fr_from  = $request->input('fr_from');
        $company->sa_to= $request->input('sa_to');
        $company->su_to  = $request->input('su_to');
        $company->mo_to = $request->input('mo_to');
        $company->tu_to  = $request->input('tu_to');
        $company->we_to  = $request->input('we_to');
        $company->th_to  = $request->input('th_to');
        $company->fr_to = $request->input('fr_to');

        
        


        
        if($request->hasFile('profile_image')){
            $company->profile_image = $profile_image;
        }
        if(!empty($request->input('password'))){
            $this->validate($request, [
                'password' => 'min:6'
            ]);
            $company->password = bcrypt($request->input('password'));
            $company->save();
        }

        $company->save();
        return Redirect::back()->with('success', 'company Edited');


      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Company
        $company = User::find($id);
        
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

        $company->delete();

        return Redirect::to('dashboard/companies')->with('success', 'Company Deleted');
    }
}
