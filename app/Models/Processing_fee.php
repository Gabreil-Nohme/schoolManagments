<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processing_fee extends Model
{
    protected $guareded=[];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
