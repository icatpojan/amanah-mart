<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $Keuangan = Keuangan::all();
        return view('pages.keuangan', compact('Keuangan'));
    }
}
