<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\kasir;
use App\Model\Cart;
use App\Model\Penjualan;
use Illuminate\Http\Request;
use PDF;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $Total_penjualan = Penjualan::where('created_at', date('Y-m-d'))->sum('jumlah_harga');
        $Total_bulanan = Penjualan::whereMonth('created_at', date('m'))->sum('jumlah_harga');
        $Cart = Cart::where('created_at', date('Y-m-d'))->sum('jumlah_product');
        $Penjualan = Penjualan::all();
        if ($request->awal == null) {
            $row = kasir::create([
                'tanggal' => "tidak ada data",
                'penjualan' =>  0,
                'pembelian' => 0,
            ]);
            $row = kasir::all();
            foreach ($row as $Data) {
                $del = kasir::find($Data->id);
                $del->delete();
            }

            return view('pages.penjualan.penjualan', compact('Penjualan','Total_penjualan','Total_bulanan','Cart','row'));
        }else
        $no = 0;
        $data = [];
        $pendapatan = 0;
        $total_pendapatan = 0;
        $row = [];
        $row = array();
        while (strtotime($request->awal) <= strtotime($request->akhir)) {
            $tanggal = $request->awal;
            $request->awal = date('Y-m-d', strtotime("+1 day", strtotime($request->awal)));

            $total_penjualan = Cart::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_product');
            $total_pembelian = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('jumlah_harga');


            $row = kasir::create([
                'tanggal' => $tanggal,
                'penjualan' => $total_penjualan,
                'pembelian' => $total_pembelian,
            ]);
            $row = kasir::all();
        }

        foreach ($row as $Data) {
            $del = kasir::find($Data->id);
            $del->delete();
        }

        return view('pages.penjualan.penjualan', compact('Penjualan','Total_penjualan','Total_bulanan','Cart','row'));
    }
    public function cetak_pdf()
    {
    	$Penjualan = Penjualan::all();

    	$pdf = PDF::loadview('report.penjualan_pdf',compact('Penjualan'))->setPaper('a4', 'landscape');
    	// return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-penjualan-pdf');
    }
    public function show($id)
    {
        $Cart = Cart::where('penjualan_id', $id)->get();
        return view('pages.penjualan.show', compact('Cart'));
    }

}
