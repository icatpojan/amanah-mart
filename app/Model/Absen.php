<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    
    public $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
