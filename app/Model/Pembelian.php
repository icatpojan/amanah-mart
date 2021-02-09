<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $guarded = [];
    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier', 'supplier_id', 'id');
    }
}
