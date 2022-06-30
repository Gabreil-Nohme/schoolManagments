<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];


    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function grade()
    {
        return $this->belongsTo(grade::class, 'Grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(ClassRooms::class, 'Classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationalitie', 'nationalitie_id');
    }

    public function myparent()
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id');
    }
    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount');
    }

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance');
    }


}
