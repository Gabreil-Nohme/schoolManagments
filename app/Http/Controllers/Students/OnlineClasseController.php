<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\OnlineClasses;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClasseController extends Controller
{

    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = OnlineClasses::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }
    ///
    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }

    public function store(Request $request)
    {
        try {

            $meeting = $this->createMeeting($request);

            OnlineClasses::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,//عنوان الحصة
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,//مدى الحصة
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function storeIndirect(Request $request)
    {
        try {
            OnlineClasses::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        try {

            $info = OnlineClasses::find($request->id);

            if($info->integration == true){
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
               // online_classe::where('meeting_id', $request->id)->delete();
                OnlineClasses::destroy($request->id);
            }
            else{
               // online_classe::where('meeting_id', $request->id)->delete();
               OnlineClasses::destroy($request->id);
            }

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
