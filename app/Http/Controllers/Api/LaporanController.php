<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Pembelian;
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

        return $this->sendResponse('Success', 'ini dia semua laporan bos', compact('jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'saldo'), 200);
    }
    public function indexharian()
    {
        $Product = Product::all('name', 'stock');

        // $penjualan = Keuangan::where('keterangan', 'Penjualan')->get();
        $jumlah_penjualan = Keuangan::where('keterangan', 'Penjualan')->whereDay('created_at', date('d'))->sum('debit');

        // $pembelian = Keuangan::where('keterangan', 'Pembelian')->get();
        $jumlah_pembelian = Keuangan::where('keterangan', 'Pembelian')->whereDay('created_at', date('d'))->sum('debit');

        // $pengeluaran = Pengeluaran::all();
        $jumlah_pengeluaran = Pengeluaran::whereDay('created_at', date('d'))->sum('kredit');

        $saldo = Keuangan::latest()->first('saldo');

        return $this->sendResponse('Success', 'ini dia semua laporan bos', compact('jumlah_penjualan',  'jumlah_pembelian',  'jumlah_pengeluaran', 'saldo', 'Product'), 200);
    }
    protected function getdata($awal, $akhir)
    {
        $no = 0;
        $data =[];
        $pendapatan = 0;
        $total_pendapatan = 0;
        $row = [];
        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "$tanggal%")->sum('kredit');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $no++;
            $row[] = [
                'no' => $no,
                'tanggal' => $tanggal,
                'penjualan' => $total_penjualan,
                'pembelian' => $total_pembelian,
                'pengeluaran' => $total_pengeluaran,
                'pendapatan' => $pendapatan
            ];
        }
        $data[] = ["Total Pendapatan" => format_uang($total_pendapatan)];

        // return $data;
        return $this->sendResponse('Success', 'berhasil mengambil laporan', compact('row','data'), 200);
    }
}
