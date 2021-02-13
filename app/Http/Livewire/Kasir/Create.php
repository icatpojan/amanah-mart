<?php

namespace App\Http\Livewire\Kasir;

use App\Model\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $image;

    public function render()
    {
        return view('livewire.kasir.create');
    }

    public function store()
    {

        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:180',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->emit('productStored');
    }
}
