<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

  protected $fillable = ['exam_id', 'user_id', 'answer', 'is_correct'];

  public function exam()
  {
      return $this->belongsTo('App\Exam');
  }
}
