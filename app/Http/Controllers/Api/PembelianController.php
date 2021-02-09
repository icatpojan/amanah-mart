<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $Pembelian = Pembelian::all();
        if ($Pembelian == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Pembelian bos', $Pembelian, 200);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'jumlah_product' => 'integer|required',
            'harga' => 'integer|required',
            'jumlah_harga' => 'integer|required',
        ]);
        $Pembelian = Pembelian::create([
            'name' => $request->name,
            'jumlah_product' => $request->jumlah_product,
            'harga' => $request->harga,
            'jumlah_harga' => $request->jumlah_harga,
        ]);
        try {
            $Pembelian->save();
            return $this->sendResponse('Success', 'berhasil membeli barang', $Pembelian, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal membeli barang', null, 500);
        }
    }
}
