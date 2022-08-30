<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilerController extends Controller
{
     public function index()
     {
        $information=Teacher::where('id',auth()->user()->id)->first();
        return view('pages.Teachers.profile',compact('information'));
     }
     public function update(Request $request)
     {
         $teacher=Teacher::findOrFail(auth()->user()->id);
        if (
            $teacher->getTranslation('Name', 'ar') != $request->Name_ar  ||
            $teacher->getTranslation('Name', 'en') != $request->Name_en
        ) {

        $teacher->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        }
        if(!empty($request->password))
            $teacher->password=Hash::make($request->password);

        $teacher->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back();

     }

}
