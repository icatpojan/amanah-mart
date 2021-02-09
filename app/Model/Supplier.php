<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];
    public function order()
    {
        return $this->hasMany('App\Model\Pembelian', 'supplier_id', 'id');
    }
}
