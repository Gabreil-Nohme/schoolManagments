<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrade;
use App\Models\ClassRooms;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=Grade::all();
        return view('pages.grades.grade',compact('grades'));
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
    public function store(StoreGrade $request)
    {
        if(Grade::where('name->ar',$request->name_ar)->Orwhere('name->en',$request->name_en)->exists()){
            return redirect()->back()->withErrors(['error'=>__('grade_trans.feild_already')]);
        }
        try{
         $grade=new Grade();
         $grade->name=['en'=>$request->name_en,'ar'=>$request->name_ar];
         $grade->notes=$request->notes;
         $grade->save();
        /* $grade
                ->setTranslation('name', 'en',$request->name_en)
                ->setTranslation('name', 'ar',$request->name_ar);
        $grade->notes=$request->notes;
        $grade->save();*/
         toastr()->success(__('grade_trans.success'));
            return redirect()->route('grades.index');
        }catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(StoreGrade $request)
    {
        try {

            $grades = Grade::findOrFail($request->id);
            $grades->update([
              $grades->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
              $grades->notes = $request->notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        }
        catch
        (\Exception $e) {
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
        $my_class_id=ClassRooms::where('grades_id',$request->id)->pluck('grades_id');
        if($my_class_id->count()==0){
        $grade=Grade::findOrFail($request->id)->delete();

        toastr()->success(trans('messages.update_success'));
            return redirect()->route('grades.index');
        }else{
            toastr()->error(trans('grade_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');
        }
}
public function delete_all_grade(Request $request)
    {
        $delete_all_id=explode(",",$request->delete_all_id);//تحويل قيم لمصفوفة
        //التاكد اذا هناك صفوف تابعة لها
        $my_class_id=ClassRooms::where('grades_id',$request->id)->pluck('grades_id');

        if($my_class_id->count()==0){
            Grade::whereIn('id',$delete_all_id)->delete();

        toastr()->success(trans('messages.update_success'));
            return redirect()->route('grades.index');
        }else{
            toastr()->error(trans('grade_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');
        }
}
}
