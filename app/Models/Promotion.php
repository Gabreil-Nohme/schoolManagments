<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded=[];

    public function f_grade()
    {
        return $this->belongsTo(grade::class, 'from_grade');
    }
    public function f_classroom()
    {
        return $this->belongsTo(ClassRooms::class, 'from_Classroom');
    }
    public function f_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }
    //--------------------- to  -------------->>>
    public function t_grade()
    {
        return $this->belongsTo(grade::class, 'to_grade');
    }
    public function t_classroom()
    {
        return $this->belongsTo(ClassRooms::class, 'to_Classroom');
    }
    public function t_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
