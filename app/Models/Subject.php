<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;
    public $translatable =['name'];
     protected $fillable= ['name', 'grade_id', 'classroom_id', 'teacher_id'];

    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(ClassRooms::class, 'classroom_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
   
}
