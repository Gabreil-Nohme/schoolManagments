<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\My_Parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $parent =My_Parent::find(auth()->user()->id);
        return view('pages.parent.profile',compact('parent'));
    }

    public function profile(Request $request){
        if(!empty($request->password) && $request->password == $request->conferm_password){
            $parent = My_Parent::find(auth()->user()->id);
            $parent->password = Hash::make($request->password);
            $parent->save();

        toastr()->success('تم تغيير كلمة المرور بنجاح');
        return redirect()->back();
        }else{
            toastr()->error('كلمة السر غير متطابقة');
            return redirect()->back();
        }
    }
}
