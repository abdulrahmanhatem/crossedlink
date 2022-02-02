<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Contact;
use App\User;
use App\Job;
class VisitorController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contact(Request $request)
    {
    
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'messege' => 'required',
        ]);

        $contact = new Contact;
        
        
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->messege = $request->input('messege');
        $contact->save();
        
        
        return Redirect::back()->with('success', trans('main.Messege Sent'));
    }
	//VERIFY EMAIL FOR NOTIFICATION   
	public function verifyEmail($token)
    {
	
		$result = User::where('email_verify_token', '=' ,$token)->get();
		
		if(count($result)>0){
			$userUpdate = User::where('email',$result[0]->email);
			$data['email_verify_token'] =NULL;										
			$data['email_verified_at'] =date('Y-m-d H:i:s');										
			$userUpdate->update($data);	
			
		if(auth()->user()){
		    if(auth()->user()->role == 2 || auth()->user()->role == 1){
		        return redirect('us')->with('success', trans('main.Your Email has been verified'));
		    }elseif(auth()->user()->role == 0){
		        return redirect('me')->with('success', trans('main.Your Email has been verified'));
		    }
		
		}
        else{
			return redirect('login')
					->with('success', trans('main.Your Email has been verified'));
		}
        			
		}else{
		    
			if(auth()->user()){
			   if(auth()->user()->role == 2 || auth()->user()->role == 1){
    			    return redirect('us')->with('error', trans('main.Verification Link is incorrect'));
    			}elseif(auth()->user()->role == 0){
    		        return redirect('me')->with('error', trans('main.Verification Link is incorrect'));
    			} 
			}else{
				
			  return redirect('login')->with('error', trans('main.Verification Link is incorrect'));  
			}
			
		}	
	}

	public function known()
    {
		if (app()->getLocale() == 'ar') {
			return view('known');
		}else{
			abort(404);
		}
    }
    
    public function candidate($id)
    {
        $user = User::find($id);
        if($user){
            if (!auth()->check()) {
			return view('visitors.cannot_view', compact('user'));
    		}else{
    			abort(404);
    		}
        }else{
			abort(404);
		}
		
    }
    
    public function job($id)
    {
		$job = Job::find($id);
        if($job){
            if (!auth()->check()) {
			return view('visitors.job_show', compact('job'));
    		}else{
    			abort(404);
    		}
        }else{
			abort(404);
		}
    }
}
