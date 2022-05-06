<?php

namespace App\Repository;

interface StudentRepositoryInterface
{

    public function Index_student();

    public function  Create_Student();

    public function Edit_student($id);

    public function Update_Student($request);

    public function  Get_classrooms($id);

    public function  Get_sections($id);

    public function Store_Student($request);

    public function Delete_Student($request);

    public function Show_Student($id);

    //upload images in disc and database
    public function Upload_attachment($request);

    // delete images in in disc and database
    public function Delete_attachment($request);

    //dounload attachment
    public function Download_attachment($studentsname, $filename);
}
