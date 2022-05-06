<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
   protected $fillable=['name','notes','created_at','updated_at'];
   protected $table='grades';

   public function class()
   {
       return $this->hasMany(ClassRooms::class);
   }
   public function sections()
   {
       return $this->hasMany(Section::class,'grade_id');
   }
}
