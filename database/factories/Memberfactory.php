<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Member;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'member_id' => rand(1,1000),
        'phone_number' => rand(22222222,99999999),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
