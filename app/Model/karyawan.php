<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->hasOne('App\User', 'id' , 'user_id');
    }
}
