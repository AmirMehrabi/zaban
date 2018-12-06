<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $fillable = ['name', 'description'];
    public function posts()
  {
    return $this->belongsToMany('App\Post', 'category_post');
  }
}
