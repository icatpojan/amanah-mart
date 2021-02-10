<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $Supplier = Supplier::all();
        return view('pages.supplier', compact('Supplier'));
    }
}
