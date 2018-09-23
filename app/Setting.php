<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['shortName', 'fullName', 'direction', 'intro1_title', 'intro1_description', 'intro1_picture', 'intro2_title', 'intro2_description', 'intro2_picture', 'intro3_title', 'intro3_description', 'intro3_picture', 'intro4_title', 'intro4_description', 'intro4_picture'];
}
