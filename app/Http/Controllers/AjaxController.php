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

  public function getData(){
    // get records from database

      $arr['data'] = Cart::orderBy('id', 'asc')->get();
    echo json_encode($arr);
    exit;
  }
}
