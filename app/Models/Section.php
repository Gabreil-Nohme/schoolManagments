<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
   protected $fillable=['name_section','status','grade_id','class_id','created_at','updated_at'];
   protected $table='sections';

    public function grades(){
       return $this->belongsTo(Grade::class,'grade_id');
    }
    public function My_classs()
    {
        return $this->belongsTo(ClassRooms::class, 'class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
}
