<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function create()
    {

        return view('ajax-request');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $Cart = Cart::create([
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'jumlah_harga' => $request->jumlah_harga,
        ]);
        $Cart->save();
        return $this->sendResponse('Success', 'berhasil menambahkan barang', $data, 200);
        // return response()->json(['success'=>'Ajax request submitted successfully']);
    }
}
