<?php

namespace App;

use Baum\Node;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Node
{
  use Sluggable;

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
      return [
          'slug' => [
              'source' => 'category_name'
          ]
      ];
  }


  protected $fillable = ['category_name', 'category_id', 'description', 'picture', 'subscription_price', 'subscription_duration'];


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

  public function courses()
  {
      return $this->belongsToMany('App\Course');
  }


  public function scopeSearchByKeyword($query, $keyword)
      {
          if ($keyword!='') {
              $query->where(function ($query) use ($keyword) {
                  $query->where("category_name", "LIKE","%$keyword%")
                      ->orWhere("description", "LIKE", "%$keyword%");
              });
          }
          return $query;
      }

}
