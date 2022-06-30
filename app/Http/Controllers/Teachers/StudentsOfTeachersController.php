<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsOfTeachersController extends Controller
{
    public function getStudents(){
        //اسرع DB عن طريق
        $ids=Teacher::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
        $students=Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.Dashboard.studentsOfTeachers',compact('students'));
    }
    public function getSections(){

        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('id');
        $sections=Section::whereIn('id',$ids)->get();
        return view('pages.Teachers.Dashboard.sections',compact('sections'));
    }
    public function attendance(){

        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('id');
        $students=Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.Dashboard.attendace.attendance',compact('students'));
    // return $students;
    }


}
