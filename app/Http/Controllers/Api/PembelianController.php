<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\kulakan;
use App\Model\Pembelian;
use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store($id)
    {
        // request()->validate([
        //     'name' => 'string|required',
        //     'merek' => 'string|required',
        //     'supplier_id' => 'integer|required',
        //     'category_id' => 'integer|required',
        //     'jumlah_product' => 'integer|required',
        //     'harga' => 'integer|required',
        //     'harga_jual' => 'integer|required',
        // ]);
        $Product = Product::where('id', $id)->first();
        $cek_kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_kulakan)) {
            $Kulakan = kulakan::create([
                'user_id' => Auth::user()->id,
                'tanggal' => Carbon::now(),
                'status' => 0,
                'jumlah_harga' => 0,
            ]);
            $Kulakan->save();
        }
        // ambil data kulakan lagi
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Pembelian = Pembelian::create([
            'name' => $Product->name,
            'merek' => $Product->merek,
            'jumlah_product' => 1,
            'supplier_id' => $Product->supplier_id,
            'category_id' => $Product->category_id,
            'harga' => $Product->harga_beli,
            'harga_jual' => $Product->harga_jual,
            'jumlah_harga' => $Product->harga_beli,
            'kulakan_id' => $Kulakan->id,
            'status' => 0
        ]);
        $Pembelian->save();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Product->harga_beli);
        $Kulakan->update();
        return $this->sendResponse('Success', 'penambahan barang sukses', $Pembelian, 200);
    }
    public function create(Request $request)
    {
        request()->validate([
            'name' => 'string|required',
            'merek' => 'string|required',
            'supplier_id' => 'integer|required',
            'category_id' => 'integer|required',
            'jumlah_product' => 'integer|required',
            'harga' => 'integer|required',
            'harga_jual' => 'integer|required',
        ]);
        $cek_kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_kulakan)) {
            $Kulakan = kulakan::create([
                'user_id' => Auth::user()->id,
                'tanggal' => Carbon::now(),
                'status' => 0,
                'jumlah_harga' => 0,
            ]);
            $Kulakan->save();
        }
        // ambil data kulakan lagi
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Pembelian = Pembelian::create([
            'name' => $request->name,
            'merek' => $request->merek,
            'jumlah_product' => 1,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'harga' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'jumlah_harga' => $request->harga_beli,
            'kulakan_id' => $Kulakan->id,
            'status' => 0
        ]);
        $Pembelian->save();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($request->harga_beli);
        $Kulakan->update();
        return $this->sendResponse('Success', 'penambahan barang sukses', $Pembelian, 200);
    }
    public function confirm()
    {

        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
    
        foreach ($Pembelian as $Data) {
            $Pembelians = Pembelian::find($Data->id);
            $Pembelians->status = 1;
            $Pembelians->update();
            $Product = Product::create([
                'category_id' => $Pembelians->category_id,
                'supplier_id' => $Pembelians->supplier_id,
                'name' => $Pembelians->name,
                'merek' => $Pembelians->merek,
                'stock' => $Pembelians->jumlah_product,
                'harga_beli' => $Pembelians->harga,
                'harga_jual' => $Pembelians->harga_jual,
            ]);
        }

        $Kulakan->status = 1;
        $Kulakan->update();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 1)->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 1)->get();

        return $this->sendResponse('Success', 'oke', $Pembelian, 200);
    }
    public function destroy($id)
    {
        $Pembelian = Pembelian::where('id', $id)->first();
        if (!$Pembelian) {
            return $this->sendResponse('error', 'data tidak ada', null, 200);
        }
        $Kulakan = kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = $Kulakan->jumlah_harga - $Pembelian->jumlah_harga;
        $Kulakan->update();
        $Pembelian->delete();
        return $this->sendResponse('Success', 'berhasil menghapus barang', $Kulakan, 200);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'jumlah_product' => 'integer|required',
        ]);
        $Pembelian = Pembelian::where('id', $id)->first();
        $Kulakan = kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = $Kulakan->jumlah_harga - $Pembelian->jumlah_harga;
        $Kulakan->update();

        $Pembelian->jumlah_product = $request->jumlah_product;
        $Pembelian->jumlah_harga = $request->jumlah_product * $Pembelian->harga;
        $Pembelian->update();

        $Kulakan->jumlah_harga = $Kulakan->jumlah_harga + $Pembelian->jumlah_harga;
        $Kulakan->update();
        return $this->sendResponse('Success', 'berhasil mengupdate jumlah barang', compact('Pembelian', 'Kulakan'), 200);
    }
}
