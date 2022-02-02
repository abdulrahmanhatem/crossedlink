<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function lang($lang){
        if(in_array($lang, ['ar', 'en', 'hi', 'tg'])){
            if(auth()->user()){
                $user = auth()->user();
                $user->lang = $lang;
                $user->save();
            }else{
                if(session()->has('lang')){
                    session()->forget('lang');
                }
            }
            session()->put('lang', $lang);
        }else{
            if(auth()->user()){
                $user = auth()->user();
                $user->lang = 'en';
                $user->save();
            }else{
                if(session()->has('lang')){
                    session()->forget('lang');
                }
            }
            session()->put('lang', 'en');
        }
        return back();
    }
}
