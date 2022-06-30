<?php

namespace App\Http\Controllers;

use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades=Grade::with('sections')->get();
        $list_Grades=Grade::all();
        $teachers=Teacher::all();
        return view('pages.Sections.sections',compact('Grades','list_Grades','teachers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $Sections = new Section();

            $Sections->name_section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
            $Sections->status=1;
            $Sections->grade_id=$request->grade_id;
            $Sections->class_id=$request->class_id;
            $Sections->save();

            $Sections->teachers()->attach($request->teacher_id);

            toastr()->success(trans('messages.update_success'));
            return redirect()->route('sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
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
    public function edit(Request $request)
    {

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
        try{

           $section= Section::findOrFail($request->id);
           $section->name_section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
           if(isset($request->Status)){
            $section->status=1;
             }else{
                $section->status=2;
               }
           $section-> grade_id=$request->grade_id;
           $section-> class_id =$request->class_id;

       // update pivot tABLE
        if (isset($request->teacher_id)) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }
           $section->save();
            toastr()->success(trans('messages.update_success'));
            return redirect()->route('sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::FindOrFail($request->id)->delete();
        toastr()->success(trans('messages.update_success'));
        return redirect()->route('sections.index');
    }
    public function getclasses($id)
    {
        if(auth('teacher')){
            $list_Classes=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('name_class','id');
        }
        $list_Classes=ClassRooms::where('grades_id',$id)->pluck('name_class','id');
        return $list_Classes;
    }

}
