<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Penjualan;
use Illuminate\Http\Request;
use PDF;

class PenjualanController extends Controller
{
    public function index()
    {
        $Total_penjualan = Penjualan::where('created_at', date('Y-m-d'))->sum('jumlah_harga');
        $Total_bulanan = Penjualan::whereMonth('created_at', date('m'))->sum('jumlah_harga');
        $Cart = Cart::where('created_at', date('Y-m-d'))->sum('jumlah_product');
        $Penjualan = Penjualan::all();
        return view('pages.penjualan', compact('Penjualan','Total_penjualan','Total_bulanan','Cart'));
    }
    public function cetak_pdf()
    {
    	$Penjualan = Penjualan::all();

    	$pdf = PDF::loadview('report.penjualan_pdf',compact('Penjualan'));
    	// return $pdf->download('laporan-penjualan-pdf');
        return $pdf->stream('laporan-penjualan-pdf');
    }
}
