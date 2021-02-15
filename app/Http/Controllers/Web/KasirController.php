<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use App\Model\Product;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;


class KasirController extends Controller
{


    public function index()
    {
        $Cart = Cart::all();
        return view('pages.kasir', compact('Cart'));
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
