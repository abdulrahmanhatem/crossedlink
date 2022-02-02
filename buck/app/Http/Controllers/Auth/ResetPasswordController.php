<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    public function showLinkRequestForm()
    { 
        return view('auth.passwords.email');
    }
    /*use ResetsPasswords;*/

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    
    
    /*public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            [/*'token' => $token, 'email' => $request->email]
        );
    }*/
    
    public function showResetForm(Request $request)
    {
        $req = DB::table('password_resets')->where('email', $request->email)->orderBy('created_at', 'desc')->first();
        
        
        /*$token = DB::table('password_resets')->where('email', $request->email)->orderBy('created_at', 'desc')->first();*/
        return view('auth.passwords.reset');
    }
    
    public function reset(Request $request)
    {
         $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        $req = DB::table('password_resets')->where('email', $request->input('email'))->orderBy('created_at', 'desc')->first();
        if($user->email == $req->email){
           $user->password = bcrypt($request->input('password'));
           $user->save();
            return Redirect::back()->with('success' , 'New Password Changed');
        }
        
        /*$request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);*/
    }
    
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
    
    protected function validationErrorMessages()
    {
        return [];
    }
    
    public function broker()
    {
        return Password::broker();
    }
    
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }
    
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
    }
}
