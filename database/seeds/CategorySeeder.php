<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'makanan',
        ]);
        Category::create([
            'name' => 'minuman',
        ]);
        Category::create([
            'name' => 'alat dapur',
        ]);
        Category::create([
            'name' => 'alat mandi',
        ]);
        Category::create([
            'name' => 'pakaian',
        ]);
    }
}
