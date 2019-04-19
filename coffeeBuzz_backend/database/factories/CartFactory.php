<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'user_id' => App\User::pluck('id')->random(),
    ];
});
