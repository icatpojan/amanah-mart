<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $guarded = [];

    public function user()
    {
       return $this->hasMany('App\User', 'id' , 'role_id');
    }

}
