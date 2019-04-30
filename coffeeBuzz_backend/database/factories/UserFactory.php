<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 10;
    return [
        'username' => $faker->name,
        'role' => $faker->randomElement(['Manager', 'Barista', 'Customer']),
        'email' => substr(str_shuffle(str_repeat($pool, 5)), 0, $length) . '@gmail.com',
        'password' => Hash::make("secret"),
        'remember_token' => Str::random(10),
    ];
});
