<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $Product = Product::all();
        if ($Product == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Product bos', $Product, 200);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'merek' => 'string|required',
            'harga_beli' => 'integer|required',
            'harga_jual' => 'integer|required',
        ]);
        $Product = Product::create([
            'name' => $request->name,
            'merek' => $request->merekt,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);
        try {
            $Product->save();
            return $this->sendResponse('Success', 'berhasil menambahkan barang', $Product, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menambahkan barang', null, 500);
        }
    }
}
