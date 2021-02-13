<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $Pengeluaran = Pengeluaran::all();
        return view('pages.pengeluaran', compact('Pengeluaran'));
    }
    public function store(Request $request)
    {
        $saldo = Keuangan::latest()->first();
        request()->validate([
            'keterangan' => 'string|required',
            'kredit' => 'integer|required',
        ]);
        $Pengeluaran = Pengeluaran::create([
            'keterangan' => $request->keterangan,
            'kredit' => $request->kredit,
        ]);
        $Keuangan = Keuangan::create([
            'keterangan' => $request->keterangan,
            'kredit' => $request->kredit,
            'saldo' => $saldo == null ? $request->kredit : $saldo->saldo - ($request->kredit)
        ]);

        try {
            $Pengeluaran->save();
            alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
            return back();
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menambahkan Pengeluaran bos', null, 500);
        }
    }
}
