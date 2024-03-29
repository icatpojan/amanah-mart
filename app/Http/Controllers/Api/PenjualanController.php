<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Keuangan;
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
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->latest()->first();
        if ($Penjualan == null) {
            return $this->sendResponse('Failed', 'keranjang masih kosong boss', null, 400);
        }
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        if ($Cart == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Cart bos', compact('Cart', 'Penjualan'), 200);
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
            $Cart->diskon = $Product->diskon;
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
            'diskon' => $Product->diskon,
            'harga_diskon' => ($Product->harga_jual) - round(($Product->harga_jual) * ($Product->diskon / 100)),
            'jumlah_harga' => ($Product->harga_jual) - round(($Product->harga_jual) * ($Product->diskon / 100)),
            'penjualan_id' => $Penjualan->id,
            'status' => 0
        ]);
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) + ($Cart->jumlah_harga);
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
        $Cart = Cart::where('id', $id)->first();
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
            $uang_kurang = ($Penjualan->jumlah_harga)-($request->dibayar);
            return $this->sendResponse('failed', 'duit anda kurang bos', $uang_kurang, 200);
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
            // 'diskon' => 'integer',
        ]);
        $diskon = rand(1, 20);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        $Member = Member::where('member_id', $request->member_id)->first();
        if ($Member == []) {
            return $this->sendResponse('Failed', 'member tidak ada', null, 400);
        }
        if (!($Penjualan->diskon == 0)) {
            return $this->sendResponse('failed', 'gacha teros ampek gratis bos', $Penjualan, 400);
        }
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - round(($Penjualan->jumlah_harga) * ($diskon / 100));
        $Penjualan->diskon = $diskon;
        $Penjualan->member_id = $request->member_id;
        $Penjualan->update();
        return $this->sendResponse('success', 'berhasil menambahkan member id', $Penjualan, 400);
    }
    public function confirm()
    {

        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();

        if ($Penjualan == null || $Penjualan->jumlah_harga == 0 || $Penjualan == []) {
            return $this->sendResponse('failed', 'anda belom memasukan apapun', null, 400);
        }
        if ($Penjualan->dibayar = 0) {
            return $this->sendResponse('failed', 'bayar dulu baru konfirmasi', null, 400);
        }
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        foreach ($Cart as $Data) {
            $Product = Product::where('barcode', $Data->barcode)->first();
            if ($Product->stock < $Data->jumlah_product) {
                return $this->sendResponse('failed', 'stok barang kurang', $Data->name, 400);
            }
        }
        foreach ($Cart as $Data) {
            $Carts = Cart::find($Data->id);
            $Product = Product::where('barcode', $Data->barcode)->first();

            $Carts->status = 1;
            $Carts->update();
            $Product->stock = ($Product->stock) - ($Data->jumlah_product);
            $Product->update();
        }

        $Penjualan->status = 1;
        $Penjualan->update();
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 1)->latest()->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 1)->get();
        $Keuangan = Keuangan::latest()->first();
        Keuangan::create([
            'keterangan' => 'Penjualan',
            'debit' => $Penjualan->jumlah_harga,
            'saldo' => ($Keuangan->saldo) + ($Penjualan->jumlah_harga)
        ]);
        return $this->sendResponse('Success', 'oke', $Penjualan, 200);
    }
    public function confirm_saldo()
    {
        // cek penjualan
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 0)->first();
        if ($Penjualan == null || $Penjualan->jumlah_harga == 0 || $Penjualan == []) {
            return $this->sendResponse('failed', 'anda belom memasukan apapun', null, 400);
        }
        //cek kode member dan saldonya
        $Member = Member::where('member_id', $Penjualan->member_id)->first();
        if ($Member == null) {
            return $this->sendResponse('Failed', 'anda belom memasukan kode member', null, 200);
        }
        if ($Penjualan->jumlah_harga > $Member->saldo) {
            return $this->sendResponse('Failed', 'saldo member kurang', null, 200);
        }
        $Member->saldo = $Member->saldo - $Penjualan->jumlah_harga;
        $Member->update();

        // masukin ke keranjang
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 0)->get();
        foreach ($Cart as $Data) {
            $Carts = Cart::find($Data->id);
            $Carts->status = 1;
            $Carts->update();
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Product->stock = ($Product->stock) - ($Data->jumlah_product);
            $Product->update();
        }

        $Penjualan->status = 1;
        $Penjualan->update();
        $Penjualan = Penjualan::where('id_kasir', Auth::user()->id)->where('status', 1)->latest()->first();
        $Cart = Cart::where('penjualan_id', $Penjualan->id)->where('status', 1)->get();
        $Keuangan = Keuangan::latest()->first();
        Keuangan::create([
            'keterangan' => 'Penjualan',
            'debit' => $Penjualan->jumlah_harga,
            'saldo' => ($Keuangan->saldo) + ($Penjualan->jumlah_harga)
        ]);
        return $this->sendResponse('Success', 'oke', $Cart, 200);
    }
    public function destroy($id)
    {
        $Cart = Cart::where('id', $id)->first();
        if (!$Cart) {
            return $this->sendResponse('error', 'data tidak ada', null, 200);
        }
        $Penjualan = Penjualan::where('id', $Cart->penjualan_id)->first();
        $Penjualan->jumlah_harga = ($Penjualan->jumlah_harga) - ($Cart->jumlah_harga);
        $Penjualan->update();
        $Cart->delete();
        return $this->sendResponse('Success', 'berhasil menghapus barang', $Penjualan, 200);
    }
}
