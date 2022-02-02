<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\City;
use App\Country;
use App\Education;
use App\Experience;
use App\Social;
use Helper;
use Hash;
use Illuminate\Support\Facades\File; 
use App\SocialFacebookAccount;
use App\SocialGoogleAccount;
use App\SocialTwitterAccount;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = User::where('role', 0)->get();
        $data = array(
            'workers' => $workers, 
            'search' => '', 
        );
        return view('dashboard.workers.index')->with($data);
    }

    public function search(Request $request)
    {
        $name = $request->input('search');
        $workers = User::where([['role','=',0],['name','LIKE', "%".$name."%"]])->orWhere([['role','=',0],['first_name','LIKE', "%".$name."%"]])->orWhere([['role','=',0],['middle_name','LIKE', "%".$name."%"]])->orWhere([['role','=',0],['email','LIKE', "%".$name."%"]])->orWhere([['role','=',0],['phone','LIKE', "%".$name."%"]])->orWhere([['role','=',0],['website','LIKE', "%".$name."%"]])->paginate(100);
        $data = array(
            'workers' => $workers, 
            'search' => $name, 
        );
        return view('dashboard.workers.index')->with($data);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::pluck('name','id');
                
        $user_country = Country::where('code',auth()->user()->country)->first();
        if($user_country != null){
            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
        }else{
            $user_city =[];
            $user_country = 0;
        }
        return view('dashboard.workers.create',compact('country','user_city'));
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
            'nationality' => 'required',
            'category_id'=> 'required'
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

        // Handle File Upload
        if($request->hasFile('cv')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('cv')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('cv')->getClientOriginalExtension();
            // Filename To Store
            $cv = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
            $request->file('cv')->move(base_path('/uploads/files/cv'), $cv);
        }

        // Create worker
        $worker = new User;
        $worker->role = 0;
        

        // Account Informations
        $worker->first_name = $request->input('first_name');
        $worker->middle_name = $request->input('middle_name');
        $worker->name = $request->input('first_name') . ' '. $request->input('middle_name');
        $worker->password = bcrypt($request->input('password'));
        $worker->country = $request->input('country');
        $worker->nationality = $request->input('nationality');

        // Personal Informations
        $worker->email = $request->input('email');
        $worker->phone = $request->input('phone');
        $worker->address = $request->input('address');
        $worker->birth = $request->input('birth');
        $worker->gender = $request->input('gender');
        $worker->married = $request->input('married');
        $worker->average_salary = $request->input('average_salary');
        $worker->city = $request->input('city');
        $worker->legal = $request->input('legal');

        // Overview & About 
        $worker->about = $request->input('about');
        $worker->experience = $request->input('experience');
        $worker->category_id = $request->input('category_id');


        
        if($request->hasFile('profile_image')){
            $worker->profile_image = $profile_image;
        }else{
            $worker->profile_image = '';
        }

        if($request->hasFile('cv')){
            $worker->cv = $cv;
        }else{
            $worker->cv = '';
        }
        
        
        $worker->save();
        return Redirect::back()->with('success', 'Worker Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worker = User::find($id);
        $data = array(
            'worker' => $worker
        );
        return view('dashboard.workers.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = User::find($id);
        $user_country = Country::where('code',$worker->country)->first();
        if($user_country != null){
            $user_city = City::where('country_id',$user_country->id)->pluck('name','id');
        }else{
            $user_city =[];
        }
        $data = array(
            'worker' => $worker,
            'user_city' => $user_city,
            'user_country' => $user_country
        );
        return view('dashboard.workers.edit')->with($data);
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
        if ($request->has('verify-gov_id')) {
            $worker = User::find($id);
            File::delete(base_path('/uploads/images/gov_id/'.$worker->gov_id));
            $worker->gov_id = 'verified';
            $worker->save();
            return Redirect::back()->with('success', 'Worker Verified');

        }elseif($request->has('reject-gov_id')){
            $worker = User::find($id);
            File::delete(base_path('/uploads/images/gov_id/'.$worker->gov_id));
            $worker->gov_id = null;
            $worker->save();
            return Redirect::back()->with('success', 'Worker Rejected');
        }
        else{
            $this->validate($request, [
                'first_name' => 'required',
                'middle_name' => 'required',
                'email' => 'required',
                'profile_image' => 'image|nullable|max:1999',
                'nationality' => 'required',
                'category_id'=> 'required'
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
    
            if($request->hasFile('cv')){
    
                // Get Filename With Extension
                $filenameWithExt = $request->file('cv')->getClientOriginalName();
                // Get Just Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get Just Extension
                $extension = $request->file('cv')->getClientOriginalExtension();
                // Filename To Store
                $cv = $filename.'_'.time().'.'.$extension;
                // Upload Image
                //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
                $request->file('cv')->move(base_path('/uploads/files/cv'), $cv);
            }
    
            // Create worker
            $worker = User::find($id);
            $worker->role = 0;
            
    
            // Account Informations
            $worker->first_name = $request->input('first_name');
            $worker->middle_name = $request->input('middle_name');
            $worker->name = $request->input('first_name') . ' '. $request->input('middle_name');
            $worker->country = $request->input('country');
            $worker->nationality = $request->input('nationality');
            
            // Personal Informations
            $worker->email = $request->input('email');
            $worker->phone = $request->input('phone');
            $worker->phone_2 = $request->input('phone_2');
            $worker->address = $request->input('address');
    
            $worker->birth = $request->input('birth');
            $worker->gender = $request->input('gender');
            $worker->married = $request->input('married');
            $worker->minimum_salary = $request->input('minimum_salary');
            $worker->maximum_salary = $request->input('maximum_salary');
            
            /*$worker->state = $request->input('state');*/
            $worker->city = $request->input('city');
    
            // Overview & About 
            $worker->overview = $request->input('overview');
            $worker->about = $request->input('about');
            $worker->experience = $request->input('experience');
            $worker->school = $request->input('school');
            $worker->category_id = $request->input('category_id');
            $worker->legal = $request->input('legal');
    
    
            
            if($request->hasFile('profile_image')){
                $worker->profile_image = $profile_image;
            }
            if($request->hasFile('cv')){
                $worker->cv = $cv;
            }
            
            if(!empty($request->input('password'))){
                $this->validate($request, [
                    'password' => 'min:6'
                ]);
                $worker->password = bcrypt($request->input('password'));
                $worker->save();
            }
            $worker->save();
            return Redirect::back()->with('success', 'Worker Edited');
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
        // Delete worker
        $worker = User::find($id);
        
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

        $worker->delete();

        return Redirect::back()->with('success', 'Worker Deleted');
    }

    public function gov()
    {
        $workers = \Helper::pendingGov();
        $data = array(
            'workers' => $workers, 
        );
        return view('dashboard.workers.gov')->with($data);
    }

}
