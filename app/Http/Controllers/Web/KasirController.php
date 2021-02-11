<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;


class KasirController extends Controller
{


    public function index()
    {
        return view('pages.kasir');
    }
    public function store(Request $request)
    {
        Penjualan::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->emit('productStored');
    }
}
