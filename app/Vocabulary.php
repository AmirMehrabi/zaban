<?php

namespace App;

use Baum\Node;

class Vocabulary extends Node
{

    protected $fillable = ['faName', 'engName', 'vocabcat_id', 'picture'];

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

    public function category(){
      return $this->belongsTo('App\VocabCat', 'vocabcat_id');
    }
}
