<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{

    public function redirectpage($request){
        //first route in [routes.student]
        if($request->type=='student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);
        }
        elseif($request->type=='teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
        }
        elseif($request->type=='parent'){
            return redirect()->intended(RouteServiceProvider::PARENTS);
        }
        elseif($request->type=='web'){
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            return redirect()->view('auth.selection');

        }

    }
}
