<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class kulakan extends Model
{
    public $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
