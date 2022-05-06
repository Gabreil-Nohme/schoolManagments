<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Repository\TeacherRepository;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
class TeacherController extends Controller
{
    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher=$Teacher;
    }
    public function index(){
       $Teachers= $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }
    public function create(){
        $specializations=$this->Teacher->getSpecialization();
        $genders=$this->Teacher->getGender();
        return view('pages.Teachers.create',compact('genders','specializations'));
    }
    public function store(Request $request){

        return $this->Teacher->StoreTeachers($request);
    }
    public function edit($id){
       $Teachers=$this->Teacher->EditTeacher($id);
        $specializations=$this->Teacher->getSpecialization();
        $genders=$this->Teacher->getGender();
        return view('pages.Teachers.Edit',compact('genders','specializations','Teachers'));
    }
    public function update(Request $request){

        return $this->Teacher->UpdateTeacher($request);
    }
    public function destroy(Request $request){

        return $this->Teacher->DeleteTeacher($request);
    }
}
