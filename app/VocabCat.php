<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VocabCat extends Model
{
    public function vocabs(){
      return $this->hasMany('App\Vocabulary', 'vocabcat_id');
    }
}
