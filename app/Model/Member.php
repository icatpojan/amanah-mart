<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'User_id', 'id');
    }
}
