<?php

namespace App;

use Baum\Node;
use Cviebrock\EloquentSluggable\Sluggable;

class Lesson extends Node
{

    use Sluggable;

    protected $fillable = ['title', 'excerpt', 'body', 'min_grade', 'prerequisite_lesson', 'video', 'attachment'];


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


    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

}
