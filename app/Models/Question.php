<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasTranslations;
    public $translatable=['title'];
    protected $fillable = [
        'title',
        'answers',
        'right_answer',
        'score',
        'quizze_id'
    ];



    public function quizze(): BelongsTo
    {
        return $this->belongsTo(Quizze::class, 'quizze_id',);
    }
}
