<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PricingRequest;
use Carbon\Carbon;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /*protected $redirectTo = RouteServiceProvider::HOME;*/

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        if (auth()->check()) {
            app('App\Http\Controllers\ProfileController')->last_seen(auth()->user()->id);
        }
        $package = PricingRequest::whereBetween('expired_date',  [Carbon::now()->subYears(2), Carbon::now()])->update(['state' => 2]);
    }

    

    protected function client(Request $request, $user)
    {
        dd(auth()->user());
        
        $package = PricingRequest::whereBetween('expired_date',  [Carbon::now()->subYears(2), Carbon::now()])->update(['state' => 2]);
        return redirect('/');
    }

    public function logout(){
        if (auth()->check()) {
            app('App\Http\Controllers\ProfileController')->last_seen(auth()->user()->id);
        }
        Auth::logout();
        return redirect('/');
        $package = PricingRequest::whereBetween('expired_date',  [Carbon::now()->subYears(2), Carbon::now()])->update(['state' => 2]);
    }
    
}
