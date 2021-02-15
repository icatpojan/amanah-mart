<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;

class CartController extends Controller
{

    public function create()
    {

        return view('cart_form');
    }

    public function store(Request $request)
    {
        $Cart = new Cart;

        $Cart->name = $request->name;
        $Cart->jumlah = $request->jumlah;
        $Cart->harga = $request->harga;
        $Cart->jumlah_harga = $request->jumlah_harga;

        $Cart->save();

        return response()->json(['success' => 'Form is successfully submitted!']);
    }
}
