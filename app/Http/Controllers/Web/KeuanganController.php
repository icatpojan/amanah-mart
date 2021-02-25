<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Pengeluaran;
use App\Model\Product;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $Keuangan = Keuangan::all();
        // $penjualan = Keuangan::where('keterangan', 'Penjualan')->get();
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereMonth('created_at', date('m'))->sum('debit');

        // $pembelian = Keuangan::where('keterangan', 'Pembelian')->get();
        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereMonth('created_at', date('m'))->sum('debit');

        // $pengeluaran = Pengeluaran::all();
        $jumlah_pengeluaran = Pengeluaran::whereMonth('created_at', date('m'))->sum('kredit');

        $saldo = Keuangan::latest()->first('saldo');

        $Product = Product::all('name','stock');

        // $penjualan = Keuangan::where('keterangan', 'Penjualan')->get();
        $harian_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereDay('created_at', date('d'))->sum('debit');

        // $pembelian = Keuangan::where('keterangan', 'Pembelian')->get();
        $harian_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereDay('created_at', date('d'))->sum('debit');

        // $pengeluaran = Pengeluaran::all();
        $harian_pengeluaran = Pengeluaran::whereDay('created_at', date('d'))->sum('kredit');


        return view('pages.keuangan', compact('Keuangan', 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'harian_penjualan',  'harian_pembelian',  'harian_pengeluaran', 'saldo'));
    }
}
