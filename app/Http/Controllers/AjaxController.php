<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\User;
use Illuminate\Http\Request;
use Redirect,Response;

class AjaxController extends Controller{

  public function index(){
    return view('get-ajax-data');
  }

  public function getData($id = 0){
    // get records from database

    if($id==0){
      $arr['data'] = Cart::orderBy('id', 'asc')->get();
    }else{
      $arr['data'] = Cart::where('id', $id)->first();
    }
    echo json_encode($arr);
    exit;
  }
}
