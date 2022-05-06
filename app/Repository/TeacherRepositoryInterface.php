<?php
namespace App\Repository;

use App\Models\Teacher;

interface TeacherRepositoryInterface{
    //get all teachers
    public function getAllTeachers();

    //get specialazion
    public function  getSpecialization();

    //get grade
    public function  getGender();

     //Store teacher
     public function  StoreTeachers($request);

      //   UpdateTeacher
      public function EditTeacher($id);

     //   UpdateTeacher
     public function UpdateTeacher($request);

      //   DeleteTeacher
      public function DeleteTeacher($request);



}
