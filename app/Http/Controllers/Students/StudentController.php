<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }

    public function index()
    {

        return $this->Student->Index_student();
    }

    public function create()
    {

        return $this->Student->Create_Student();
    }

    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }


    public function Get_sections($id)
    {
        return $this->Student->Get_sections($id);
    }

    public function edit($id)
    {
        return $this->Student->Edit_student($id);
    }

    public function store(StoreStudentsRequest $request)
    {

        return $this->Student->Store_Student($request);
    }

    public function update(StoreStudentsRequest $request)
    {

        return $this->Student->Update_Student($request);
    }

    public function show($id){

        return $this->Student->Show_Student($id);
    }

    public function destroy(Request $request)
    {

        return $this->Student->Delete_Student($request);
    }

    public function Upload_attachment(Request $request){

        return $this->Student->Upload_attachment($request);
    }

    public function Delete_attachment(Request $request){

        return $this->Student->Delete_attachment($request);

    }

    public function Download_attachment($studentsname,$filename){

        return $this->Student->Download_attachment($studentsname,$filename);

    }
}
