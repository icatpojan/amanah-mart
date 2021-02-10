<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $Penjualan = Penjualan::all();
        if ($Penjualan == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar Penjualan bos', $Penjualan, 200);
    }
}
