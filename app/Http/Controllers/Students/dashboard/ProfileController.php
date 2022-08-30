<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information=Student::findOrFail(auth()->user()->id);
        return view('pages.students.dashboard.profile',compact('information'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $student = Student::findOrFail(auth()->user()->id);
        if($student->getTranslation('name', 'ar') != $request->Name_ar  ||
            $student->getTranslation('name', 'en') != $request->Name_en ){

                $student->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                if (!empty($request->password))
                    $student->password = Hash::make($request->password);
            }

        $student->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
