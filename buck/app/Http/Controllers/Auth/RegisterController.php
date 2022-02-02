<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    /*protected $redirectTo = RouteServiceProvider::HOME;*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (array_key_exists("worker",$data)){
            if (in_array ($data['worker'], $data)) {
                return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'middle_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'/*, 'confirmed'*/],
                    /*'category_id' => ['required'],
                    'nationality' => ['required'],*/
                ]);
            }
        }
        if (array_key_exists("personal",$data)){
            if (in_array ($data['personal'], $data)) {
                return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'middle_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'/*, 'confirmed'*/],
                    /*'country' => ['required'],*/
                ]);
            }
        }
        if (array_key_exists("company",$data)){
            if (in_array ($data['company'], $data)) {
                return Validator::make($data, [
                    /*'first_name' => ['required', 'string', 'max:255'],
                    'middle_name' => ['required', 'string', 'max:255'],*/
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'/*, 'confirmed'*/],
                    /*'country' => ['required'],*/
                    'company_name' => ['required'],
                    /*'phone' => ['required'],*/
                ]);
            }
        }
     

        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        if (array_key_exists("worker",$data)){
            if (in_array ($data['worker'], $data)) {
                return User::create([
                    'name' => $data['first_name'] .' '. $data['middle_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'role' => 0,
                    /*'nationality' => $data['nationality'],
                    'category_id' => $data['category_id'],*/
                ]);
    
            }

        }

        if (array_key_exists("personal",$data)){
            if (in_array ($data['personal'], $data)) {
                return User::create([
                    'name' => $data['first_name'] .' '. $data['middle_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    /*'country' => $data['country'],*/
                    'role' => 1,
                ]);
    
            }
            
        }
        
        if (array_key_exists("company",$data)){
            if (in_array ($data['company'], $data)) {
                return User::create([
                    /*'name' => $data['first_name'] .' '. $data['middle_name'],*/
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    /*'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'country' => $data['country'],*/
                    'company_name' => $data['company_name'],
                    /*'website' => $data['website'],
                    'phone' => $data['phone'],*/
                    'role' => 2,
                ]);
    
            }
            /*return dd($data);*/

        }
    }

    public function employer(){
        return view('auth.employer-register');
    }

    protected function redirectTo()
    {
        $user = User::find(auth()->user()->id);
        app('App\Http\Controllers\ProfileController')->SendVerifyEmailLink();
        /*\App\Helpers\AppHelper::send_email($user->email ,$subject='Welcome You In Crossed Link!',$message='Verification EMail!',$from='notifications@crossedlink.com',$fromname='CrossedLink!');*/
        if ($user->role == 0) {
            $data= array(
                'user' => $user
            );
            return 'interests';
        }
        
        return '/';
    }
}
