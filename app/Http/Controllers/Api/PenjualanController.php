<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Member;
use App\Model\Penjualan;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        $Penjualan = Penjualan::where('user_id', Auth::user()->id)->where('status', 0)->letest()->first();
        $Cart = Cart::where('Penjualan_id', $Penjualan->id)->where('status', 0)->get();
        if ($Cart == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Cart bos', $Cart, 200);
    }
    public function see()
    {
        $Penjualan = Penjualan::where('user_id', Auth::user()->id)->where('status', 1)->letest()->first();
        $Cart = Cart::where('Penjualan_id', $Penjualan->id)->where('status', 1)->get();
        if ($Cart == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Cart bos', $Cart, 200);
    }
    public function store($barcode)
    {
        $Product = Product::where('barcode', $barcode)->first();
        if (!$Product) {
            return $this->sendResponse('Failed', 'barang kosong. pastikan anda mencari berdasarkan barcode', null, 200);
        }
        $cek_penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_penjualan)) {
            $Penjualan = Penjualan::create([
                'id_kasir' => Auth::user()->id,
                'status' => 0,
                'jumlah_harga' => 0,
                'status' => 0,
            ]);
            $Penjualan->save();
        }
        // ambil data penjualan lagi
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->where('barcode', $barcode)->first();
        if (!($Cart == [])) {
            $Cart->jumlah_product = ($Cart->jumlah_product) + 1;
            // $Cart->harga_diskon = ($Product->harga_jual)-(($Product->harga_jual) * ($Product->diskon/100));
            $Cart->jumlah_harga = ($Cart->jumlah_harga) + ($Cart->harga_diskon);
            $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->harga_diskon);
            $Cart->update();
            $Penjualan->update();
            return $this->sendResponse('Success', 'penambahan barang sukses', $Cart, 200);
        }
        $Cart = Cart::create([
            'name' => $Product->name,
            'jumlah_product' => 1,
            'barcode' => $Product->barcode,
            'harga' => $Product->harga_jual,
            'harga_diskon' => ($Product->harga_jual) - (($Product->harga_jual) * ($Product->diskon / 100)),
            'jumlah_harga' => ($Product->harga_jual) - (($Product->harga_jual) * ($Product->diskon / 100)),
            'penjualan_id' => $Penjualan->id,
            'status' => 0
        ]);
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart  ->jumlah_harga);
        $Cart->save();
        $Penjualan->update();
        return $this->sendResponse('Success', 'penambahan barang sukses', $Cart, 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_product' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // refresh dulu harga penjualan
        $Cart = Cart::find($id)->first();
        $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - ($Cart->jumlah_harga);
        $Penjualan->update();

        // update cartnya
        $Cart->jumlah_product = $request->jumlah_product;
        $Cart->jumlah_harga = ($request->jumlah_product) * ($Cart->harga_diskon);
        $Cart->update();

        // masukin lagi ke penjualan
        // $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->jumlah_harga);
        $Penjualan->update();
        return $this->sendResponse('Success', 'berhasil mengupdate jumlah barang', compact('Cart', 'Penjualan'), 200);
    }
    public function bayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dibayar' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if ($Penjualan->jumlah_harga > $request->dibayar) {
            return $this->sendResponse('failed', 'duit anda kurang bos', null, 200);
        } else {
        $Penjualan->dibayar = $request->dibayar;
        $Penjualan->kembalian = $request->dibayar - $Penjualan->jumlah_harga;
        $Penjualan->update();
        return $this->sendResponse('Success', 'ini dia kembalian anda', $Penjualan->kembalian, 200);
        }
    }
    public function diskon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'integer',
            'diskon' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Member = Member::where('member_id', $request->member_id)->first();
        if ($Member == []) {
            return $this->sendResponse('Failed', 'member tidak ada', null, 400);
        }
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - (($Penjualan->jumlah_harga) * ($request->diskon / 100));
        $Penjualan->member_id = $request->member_id;
        $Penjualan->update();
        return $this->sendResponse('success', 'berhasil menambahkan member id', $Penjualan, 400);
    }
    public function confirm()
    {

        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        foreach ($Cart as $Data) {
            $Penjualans = Penjualan::find($Data->id);
            $Penjualans->status = 1;
            $Penjualans->update();
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Product->stock = ($Product->stock) - ($Data->jumlah_product);
            $Product->update();
        }

        $Penjualan->status = 1;
        $Penjualan->update();
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 1)->first();
        $Cart = Cart::where('kulakan_id', $Penjualan->id)->where('status', 1)->get();

        return $this->sendResponse('Success', 'oke', null, 200);
    }
    public function destroy($id)
    {
        $Cart = Cart::where('id', $id)->first();
        if (!$Cart) {
            return $this->sendResponse('error', 'data tidak ada', null, 200);
        }
        $Penjualan = Penjualan::where('id', $Cart->Penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - ($Cart->jumlah_harga);
        $Penjualan->update();
        $Cart->delete();
        return $this->sendResponse('Success', 'berhasil menghapus barang', $Penjualan, 200);
    }
}
