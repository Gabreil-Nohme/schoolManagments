<?php


namespace App\Repository;

use App\Models\Attendance;
use App\Models\Attendances;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }

    public function store($request)
    {
        try {
            $date=date('Y-m-d');

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }
                    Attendance::UpdateOrCreate(
                        [ //update  اذا تحقق الشرطين بيعمل
                            'student_id' => $studentid,
                         'attendence_date'=>$date,

                        ],
                         [
                        'student_id' => $studentid,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'teacher_id' => 1,
                        'attendence_date' => $date,
                        'attendence_status' => $attendence_status,
                    ]);

            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function ReportAttendance(){

        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('id');
        $students=Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.Dashboard.attendace.attendance_report',compact('students'));
    }
    public function SeachAttendance($request){

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.Teachers.Dashboard.attendace.attendance_report', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.Teachers.Dashboard.attendace.attendance_report', compact('Students', 'students'));


        }
    }
}
