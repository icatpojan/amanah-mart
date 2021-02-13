<?php

use App\Model\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cart::create([
            'name' => 'pimpinan',
            'jumlah' => 1,
        ]);
    }
}
