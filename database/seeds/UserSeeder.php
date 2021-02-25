<?php

use App\Model\karyawan;
use App\Model\Member;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'  => Hash::make('123123'),
            'email_verified_at' => now(),
            'role_id'   => 1
        ]);
        User::create([
            'name' => 'pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password'  => Hash::make('123123'),
            'email_verified_at' => now(),
            'role_id'   => 2
        ]);
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password'  => Hash::make('123123'),
            'email_verified_at' => now(),
            'role_id'   => 3
        ]);
        User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password'  => Hash::make('123123'),
            'email_verified_at' => now(),
            'role_id'   => 4
        ]);
        User::create([
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password'  => Hash::make('123123'),
            'email_verified_at' => now(),
            'role_id'   => 5
        ]);
        Member::create([
            'member_id' => 123123,
            'user_id' => 5,
            'umur'  => 17,
            'address' => 'bandung barat',
            'phone_number'   => 12345
        ]);
        karyawan::create([
            'user_id' => 2,
            'umur'  => 17,
            'address' => 'bandung barat',
            'phone_number'   => 12345
        ]);
        karyawan::create([
            'user_id' => 3,
            'umur'  => 17,
            'address' => 'bandung barat',
            'phone_number'   => 12345
        ]);
        karyawan::create([
            'user_id' => 4,
            'umur'  => 17,
            'address' => 'bandung barat',
            'phone_number'   => 12345
        ]);

    }
}
