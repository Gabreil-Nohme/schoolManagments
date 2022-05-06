<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    protected $fillable=['name'];
    protected $table='bloods';
    public $timestamps = false;
}
