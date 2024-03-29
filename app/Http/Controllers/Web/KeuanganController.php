<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\data;
use App\Model\Keuangan;
use App\Model\Pembelian;
use App\Model\Pengeluaran;
use App\Model\Penjualan;
use App\Model\Product;
use Illuminate\Http\Request;
use PDF;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $Keuangan = Keuangan::all();
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereMonth('created_at', date('m'))->sum('debit');

        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereMonth('created_at', date('m'))->sum('debit');

        $jumlah_pengeluaran = Pengeluaran::whereMonth('created_at', date('m'))->sum('kredit');

        $saldo = Keuangan::sum('debit') - Keuangan::sum('kredit');

        $Product = Product::all('name', 'stock');

        $harian_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereDay('created_at', date('d'))->sum('debit');

        $harian_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereDay('created_at', date('d'))->sum('debit');

        $harian_pengeluaran = Pengeluaran::whereDay('created_at', date('d'))->sum('kredit');
        if ($request->awal == null) {
            $row = data::create([
                'tanggal' => "tidak ada  data",
                'penjualan' =>  0,
                'pembelian' => 0,
                'pengeluaran' => 0,
                'pendapatan' => 0
            ]);
            $row = data::all();
            foreach ($row as $Data) {
                $del = data::find($Data->id);
                $del->delete();
            }
            return view('pages.keuangan', compact('Keuangan', 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'harian_penjualan',  'harian_pembelian',  'harian_pengeluaran', 'saldo', 'row'));
        } else {
            $no = 0;
            $data = [];
            $pendapatan = 0;
            $total_pendapatan = 0;
            $row = [];
            $row = array();
            while (strtotime($request->awal) <= strtotime($request->akhir)) {
                $tanggal = $request->awal;
                $request->awal = date('Y-m-d', strtotime("+1 day", strtotime($request->awal)));

                $total_penjualan = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
                $total_pembelian = Pembelian::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
                $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "$tanggal%")->sum('kredit');

                $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
                $total_pendapatan += $pendapatan;

                $row = data::create([
                    'tanggal' => $tanggal,
                    'penjualan' => $total_penjualan,
                    'pembelian' => $total_pembelian,
                    'pengeluaran' => $total_pengeluaran,
                    'pendapatan' => $pendapatan
                ]);
                $row = data::all();
            }
            foreach ($row as $Data) {
                $del = data::find($Data->id);
                $del->delete();
            }
            return view('pages.keuangan', compact('Keuangan', 'jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'harian_penjualan',  'harian_pembelian',  'harian_pengeluaran', 'saldo', 'row'));
        }
    }

    public function cetak_pdf()
    {
        $Keuangan = Keuangan::all();

        $pdf = PDF::loadview('report.keuangan_pdf', compact('Keuangan'));
        // return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-keuangan-pdf');
    }




}
