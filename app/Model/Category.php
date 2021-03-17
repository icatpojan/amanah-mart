<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function sukses($message)
    {
        alert()->success('SuccessAlert', $message);
    }
    public function gagal($message)
    {
        alert()->error('ErrorAlert', $message);
    }

}
