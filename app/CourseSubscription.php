<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubscription extends Model
{


  public function user()
  {
      return $this->belongsTo('App\User');
  }

}
