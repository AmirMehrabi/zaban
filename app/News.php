<?php

namespace App;

use Baum\Node;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Node
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
              'source' => 'title'
          ]
      ];
  }

  public function author(){
    return $this->belongsTo(User::class);
  }

  protected $fillable = ['title', 'slug', 'author_id', 'category_id', 'picture', 'excerpt', 'body', 'viewers_counter', 'is_special'];

}
