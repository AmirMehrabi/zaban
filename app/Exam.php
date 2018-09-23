<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

  public function course()
  {
      return $this->belongsTo('App\Course');
  }

  
  public function responses()
  {
      return $this->hasMany('App\Response');
  }
}
