<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id', 'question_id', 'lesson_id', 'question', 'opt_1', 'opt_2', 'opt_3', 'opt_4', 'is_correct'];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
