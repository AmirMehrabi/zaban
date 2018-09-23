<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = ['user_id', 'duration', 'ref_id', 'payment_date', 'activated'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $dates = [
    'created_at',
    'updated_at',
    'expiration_date'
    ];
}
