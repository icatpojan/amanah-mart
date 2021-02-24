<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Pengeluaran;
use App\Model\Penjualan;
use App\Model\Product;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // $penjualan = Keuangan::where('keterangan', 'Penjualan')->get();
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereMonth('created_at', date('m'))->sum('debit');

        // $pembelian = Keuangan::where('keterangan', 'Pembelian')->get();
        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereMonth('created_at', date('m'))->sum('debit');

        // $pengeluaran = Pengeluaran::all();
        $jumlah_pengeluaran = Pengeluaran::whereMonth('created_at', date('m'))->sum('kredit');

        $saldo = Keuangan::latest()->first('saldo');

        return $this->sendResponse('Success', 'ini dia semua laporan bos', compact( 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'saldo'), 200);
    }
    public function indexharian()
    {
        $Product = Product::all('name','stock');

        // $penjualan = Keuangan::where('keterangan', 'Penjualan')->get();
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereDay('created_at', date('d'))->sum('debit');

        // $pembelian = Keuangan::where('keterangan', 'Pembelian')->get();
        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereDay('created_at', date('d'))->sum('debit');

        // $pengeluaran = Pengeluaran::all();
        $jumlah_pengeluaran = Pengeluaran::whereDay('created_at', date('d'))->sum('kredit');

        $saldo = Keuangan::latest()->first('saldo');

        return $this->sendResponse('Success', 'ini dia semua laporan bos', compact( 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'saldo','Product'), 200);
    }
}
