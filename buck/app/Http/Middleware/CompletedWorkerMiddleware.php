<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CompletedWorkerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if (Auth::user()->role == 0) {

                if(empty(Auth::user()->category_id)){
                    return redirect('/interests')->with('error', trans('main.Job Role is Required'));
                }
                if(Auth::user()->experience < 0 ){
                    return redirect('/interests')->with('error', trans('main.Experience is Required'));
                }
                if(empty(Auth::user()->average_salary)){
                    return redirect('/interests')->with('error', trans('main.Minimal Salary is Required'));
                }
                if(empty(Auth::user()->first_name)){
                    return redirect('/general')->with('error', trans('main.Your First Name is Required'));
                }
                if(empty(Auth::user()->middle_name)){
                    return redirect('/general')->with('error', trans('main.Your Last Nameis Required'));
                }
                if(empty(Auth::user()->nationality)){
                    return redirect('/general')->with('error', trans('main.Nationality is Required'));
                }
                if(Auth::user()->religion < 0){
                    return redirect('/general')->with('error', trans('main.Religion is Required'));
                }
                if(empty(Auth::user()->birth)){
                    return redirect('/general')->with('error', trans('main.Birthday is Required'));
                }
                if(empty(Auth::user()->gender)){
                    return redirect('/general')->with('error', trans('main.Gender is Required'));
                }
                if(empty(Auth::user()->country)){
                    return redirect('/general')->with('error', trans('main.country is Required'));
                }
                if(empty(Auth::user()->city)){
                    return redirect('/general')->with('error', trans('main.City is Required'));
                }
                if(empty(Auth::user()->phone)){
                    return redirect('/general')->with('error', trans('main.Phone is Required'));
                }
                return $next($request);
                
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
