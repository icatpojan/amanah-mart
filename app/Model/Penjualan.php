<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User', 'id_kasir', 'id');
    }
}
