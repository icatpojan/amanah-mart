<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject , MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'password', 'remember_token','remember_token', 'provider_name', 'provider_id'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    // public function member()
    // {
    //     $this->hasOne('App\Model\Member', 'user_id', 'id');
    // }
    public function role()
    {
       return $this->belongsTo('App\Model\Role', 'role_id', 'id');
    }
    public function karyawan()
    {
        return $this->hasOne('App\Model\karyawan', 'id' ,'user_id');
    }
    public function member()
    {
        return $this->hasOne('App\Model\Member',  'user_id', 'id');
    }
    public function absen()
    {
        return $this->hasMany('App\Api\Absen');
    }
    public function kulakan()
    {
        return $this->hasMany('App\Api\Kulakan');
    }
    public function penjualan()
    {
        return $this->hasMany('App\Model\Penjualan', 'id_kasir','id');
    }
}
