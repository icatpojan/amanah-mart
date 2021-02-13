<?php

use App\Http\Middleware\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'category_id' => 1,
            'name' => 'tombak moskov',
            'merek' => 'senjata ml',
            'stock' => 1,
            'harga_beli' => 2000000,
            'harga_jual' => 5000000,
        ]);
    }
}
