<?php

use App\Model\Role;
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
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'pimpinan',
        ]);
        Role::create([
            'name' => 'staff',
        ]);
        Role::create([
            'name' => 'kasir',
        ]);
        Role::create([
            'name' => 'member',
        ]);
    }
}
