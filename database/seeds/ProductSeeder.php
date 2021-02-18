<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'barcode' => 123,
            'supplier_id' => 1,
            'name' => 'tombak moskov',
            'merek' => 'senjata ml',
            'stock' => 1,
            'harga_beli' => 2000000,
            'harga_jual' => 5000000,
        ]);
    }
}
