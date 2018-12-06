<?php

namespace App;

use Baum\Node;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Node
{

  use Sluggable;

  protected $fillable = ['title', 'required_course', 'description', 'required_score'];


  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'title'
          ]
      ];
  }

  public function scopeSearchByKeyword($query, $keyword)
      {
          if ($keyword!='') {
              $query->where(function ($query) use ($keyword) {
                  $query->where("title", "LIKE","%$keyword%")
                      ->orWhere("description", "LIKE", "%$keyword%");
              });
          }
          return $query;
      }



  public function updateOrder($order, $orderPage) {
    $orderPage = $this->findOrFail($orderPage);

    if ($order == 'before') {
      $this->moveToLeftOf($orderPage);
    }
    elseif ($order == 'after') {
      $this->moveToRightOf($orderPage);
    }
    elseif ($order == 'childOf') {
      $this->makeChildOf($orderPage);
    }
  }

  public function category()
  {
      return $this->belongsToMany('App\Category');
  }


  public function lessons()
  {
      return $this->belongsToMany('App\Lesson');
  }



  public function exams()
  {
      return $this->hasMany('App\Exam');
  }

  public function results()
  {
      return $this->hasMany('App\Result');
  }
}
