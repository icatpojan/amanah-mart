<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $Penjualan = Penjualan::all();
        return view('pages.penjualan', compact('Penjualan'));
    }
}
