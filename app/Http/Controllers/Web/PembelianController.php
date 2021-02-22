<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\kulakan;
use App\Model\Pembelian;
use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function index()
    {
        $Kulakan = kulakan::all();
        $Product = Product::all();
        return view('pages.pembelian.index', compact('Kulakan', 'Product'));
    }
    public function form()
    {
        $Kulakan = kulakan::all();
        $Product = Product::all();
        return view('pages.pembelian.pembelian', compact('Kulakan', 'Product'));
    }
    public function getData()
    {
        $arr['data'] = Pembelian::where('status', 0)->orderBy('id', 'asc')->get();
        echo json_encode($arr);
        exit;
    }
    public function getdataku()
    {
        $arr['data'] = Kulakan::where('status', 0)->get();
        echo json_encode($arr);
        exit;
    }
    public function see()
    {
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 1)->letest()->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 1)->get();
        if ($Pembelian == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Pembelian bos', $Pembelian, 200);
    }
    public function store(Request $request)
    {
        $Product = Product::where('barcode', $request->barcode)->first();
        if (!$Product) {
            return $this->sendResponse('failed', 'barang kosong. pastikan anda mencari berdasarkan barcode', null, 200);
        }
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
        // $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->where('barcode', $Product->barcode)->first();
        // if (!($Pembelian == [])) {
        //     return $this->sendResponse('Success', 'penambahan barang gagal', $Pembelian, 200);
        // }
        $Pembelian = Pembelian::create([
            'name' => $Product->name,
            'merek' => $Product->merek,
            'jumlah_product' => 1,
            'supplier_id' => $Product->supplier_id,
            'barcode' => $Product->barcode,
            'category_id' => $Product->category_id,
            'kulakan_id' => $Kulakan->id,
            'status' => 0
        ]);
        $Pembelian->save();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Product->harga_beli);
        $Kulakan->update();
        return $this->sendResponse('Success', 'penambahan barang sukses', $Pembelian, 200);
    }
    public function stire(Request $request)
    {
        $Product = Product::where('barcode', $request->kode)->first();
        if (!$Product) {
            return $this->sendResponse('failed', 'barang kosong. pastikan anda mencari berdasarkan barcode', null, 200);
        }
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
        // $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->where('barcode', $Product->barcode)->first();
        // if (!($Pembelian == [])) {
        //     return $this->sendResponse('Success', 'penambahan barang gagal', $Pembelian, 200);
        // }
        $Pembelian = Pembelian::create([
            'name' => $Product->name,
            'merek' => $Product->merek,
            'jumlah_product' => 1,
            'supplier_id' => $Product->supplier_id,
            'barcode' => $Product->barcode,
            'category_id' => $Product->category_id,
            'kulakan_id' => $Kulakan->id,
            'status' => 0
        ]);
        $Pembelian->save();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Product->harga_beli);
        $Kulakan->update();
        return $this->sendResponse('Success', 'penambahan barang sukses', $Pembelian, 200);
    }
    public function update(Request $request)
    {
        $Pembelian = Pembelian::where('id', $request->id)->first();
        $Kulakan = kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) - ($Pembelian->jumlah_harga);
        $Kulakan->update();

        $Pembelian->jumlah_product = $request->jumlah_product;
        $Pembelian->harga = $request->harga;
        $Pembelian->harga_jual = $request->harga_jual;
        $Pembelian->jumlah_harga = ($request->jumlah_product) * ($request->harga);
        $Pembelian->update();

        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) + ($Pembelian->jumlah_harga);
        $Kulakan->update();
        return $this->sendResponse('Success', 'berhasil mengupdate jumlah barang', compact('Pembelian', 'Kulakan'), 200);
    }
    public function confirm()
    {

        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 0)->get();
        foreach ($Pembelian as $Data) {
            $Pembelians = Pembelian::find($Data->id);
            $Pembelians->status = 1;
            $Pembelians->update();
            $Product = Product::where('barcode', $Data->barcode)->first();
            $Product->stock = ($Product->stock) + ($Data->jumlah_product);
            $Product->harga_jual = $Data->harga_jual;
            $Product->harga_beli = $Data->harga;
            $Product->update();
        }

        $Kulakan->status = 1;
        $Kulakan->update();
        $Kulakan = kulakan::where('user_id', Auth::user()->id)->where('status', 1)->first();
        $Pembelian = Pembelian::where('kulakan_id', $Kulakan->id)->where('status', 1)->get();

        $Keuangan = Keuangan::latest()->first();
        Keuangan::create([
            'keterangan' => 'pembelian',
            'debit' => $Kulakan->jumlah_harga,
            'saldo' => ($Keuangan->saldo) - ($Kulakan->jumlah_harga)
        ]);

        alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
        return back();
    }
    public function destroy($id)
    {
        $Pembelian = Pembelian::where('id', $id)->first();
        if (!$Pembelian) {
            return $this->sendResponse('error', 'data tidak ada', null, 200);
        }
        $Kulakan = kulakan::where('id', $Pembelian->kulakan_id)->first();
        $Kulakan->jumlah_harga = ($Kulakan->jumlah_harga) - ($Pembelian->jumlah_harga);
        $Kulakan->update();
        $Pembelian->delete();
        return $this->sendResponse('Success', 'berhasil menghapus barang', $Kulakan, 200);
    }
}
