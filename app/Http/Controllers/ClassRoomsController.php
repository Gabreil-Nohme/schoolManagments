<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrade;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\ClassRoomRequest;
use App\Models\ClassRooms;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=Grade::all();
        $My_Classes=ClassRooms::all();

        return view('pages.my Classes.MyClasses',compact('grades','My_Classes'));
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
    public function store(ClassRoomRequest $request)
    {

        $List_classes=$request->List_Classes;


        try{

                foreach($List_classes as $list_class){

                    $My_Classes=new ClassRooms();
                    $My_Classes->name_class=
                    ['en'=>$list_class['name_en'],
                    'ar'=>$list_class['name_ar']];

                    $My_Classes->grades_id=$list_class['grade_id'];
                    $My_Classes->save();

        }
        toastr()->success(__('grade_trans.success'));
        return redirect()->route('classes.index');

        }catch(\Exception $e){
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
    public function update(Request $request)
    {
        try {

            $classRooms = ClassRooms::findOrFail($request->id);
            $classRooms->update([
              $classRooms->name_class = ['ar' => $request->name_ar, 'en' => $request->name_en],
              $classRooms->grades_id =$request->grade_id,
            ]);
            toastr()->success(trans('messages.update_success'));
            return redirect()->route('classes.index');
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
        $classRooms=ClassRooms::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete_success'));
            return redirect()->route('classes.index');
    }

    public function delete_all(Request $request)
    {
        $delete_all_id=explode(",",$request->delete_all_id);
        ClassRooms::whereIn('id',$delete_all_id)->delete();

        toastr()->error(trans('messages.delete_success'));
        return redirect()->route('classes.index');

    }
    public function Filter_Classes(Request $request)
    {
        $grades=Grade::all();
        $details=ClassRooms::where('grades_id',$request->grade_id)->get();
        return view('pages.my Classes.MyClasses',compact('grades','details'));


    }
}
