<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
