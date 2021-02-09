<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $Pengeluaran = Pengeluaran::all();
        if ($Pengeluaran == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Pengeluaran  bos', $Pengeluaran, 200);
    }
    public function store(Request $request)
    {
        request()->validate([
            'keterangan' => 'string|required',
            'kredit' => 'integer|required',
        ]);
        $Pengeluaran = Pengeluaran::create([
            'keterangan' => $request->keterangan,
            'kredit' => $request->kredit,
        ]);
        try {
            $Pengeluaran->save();
            return $this->sendResponse('Success', 'berhasil menambahkan Pengeluaran bos', $Pengeluaran, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menambahkan Pengeluaran bos', null, 500);
        }
    }
}
