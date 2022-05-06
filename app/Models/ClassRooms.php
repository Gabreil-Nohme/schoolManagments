<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ClassRooms extends Model
{

    use HasTranslations;
    public $translatable = ['name_class'];


    protected $table = 'classroom';
    public $timestamps = true;
    protected $fillable=['name_class','grade_id'];


    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grades_id');
    }
    
    public function sections(){
        return $this->hasMany(Section::class,'class_id');
     }


}
