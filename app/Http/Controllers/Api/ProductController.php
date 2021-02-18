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
            'barcode' => 'integer|required',
            'category_id' => 'integer|required',
            'supplier_id' => 'integer|required',
            'merek' => 'string|required',
        ]);
        $Product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'barcode' => $request->barcode,
            'supplier_id' => $request->supplier_id,
            'merek' => $request->merek,
            'diskon' => $request->diskon,
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
            'name' => $request->name == null ? $Product->name : $request->name,
            'merek' => $request->merek == null ? $Product->merek : $request->merek,
            'stock' => $request->stock == null ? $Product->stock : $request->stock,
            'harga_beli' => $request->harga_beli == null ? $Product->harga_beli : $request->harga_beli,
            'harga_jual' => $request->harga_jual == null ? $Product->harga_jual : $request->harga_jual,
            'diskon' => $request->diskon == null ? $Product->diskon : $request->diskon,
        ]);
        try {
            $Product->save();
            return $this->sendResponse('Success', 'berhasil mengupdate barang', $Product, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal mengupdate barang', null, 500);
        }
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        return $this->sendResponse('Success', 'product berhasil anda hapus bos', null, 200);
    }
}
