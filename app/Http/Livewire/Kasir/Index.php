<?php

namespace App\Http\Livewire\Kasir;

use App\cart;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $Cart = cart::all();
        return view('livewire.kasir.index' ,compact('Cart'));
    }
}
