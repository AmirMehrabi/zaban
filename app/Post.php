<?php

namespace App;

use Baum\Node;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Node
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

    protected $fillable = ['title', 'slug', 'picture', 'excerpt', 'body', 'viewers_counter', 'is_special'];

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

    public function groups()
    {
    return $this->belongsToMany('App\Group', 'category_post');
    }
}
