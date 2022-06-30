<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //use AuthenticatesUsers;             <========= <<====== <<<<<=======
    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginform($type){

        return view('auth.login',compact('type'));
    }
    public function login(Request $request){
        $guardname=$request->type;
        //attempt searsh in database
        //take email and password for searsh
        //[guardname] يتم البحث حسب

        if(Auth::guard($guardname)->attempt(['email'=>$request->email,'password'=>$request->password])){

            return $this->redirectpage($request);

        }else{
            //if email or password are wrong
            return  redirect()->back()->withErrors(['errors'=>'الحساب او كلمة المرور غير صحيحين']);
        }

    }
    public function logout(Request $request,$type){

        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
