<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineClasses extends Model
{
    public $fillable= ['integration','Grade_id','Classroom_id','section_id','created_by','meeting_id','topic','start_at','duration','password','start_url','join_url'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\ClassRooms', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
