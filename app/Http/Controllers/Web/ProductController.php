<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $Product = Product::all();
        return view('pages.product', compact('Product'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'category_id' => 'integer|required',
            'merek' => 'string|required',
            'harga_beli' => 'integer|required',
            'harga_jual' => 'integer|required',
        ]);
        $Product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'merek' => $request->merek,
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
    public function update(Request $request, $id)
    {
        $Product = Product::where('id', $id)->first();
        $Product->update([
            'name' => $request->name,
            'merek' => $request->merek,
            'stock' => $request->stock,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);
        try {
            $Product->save();
            return $this->sendResponse('Success', 'berhasil mengupdate barang', $Product, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate barang', null, 500);
        }
    }
}
