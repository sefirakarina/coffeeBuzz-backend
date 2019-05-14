<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Drink;
use Faker\Generator as Faker;

$factory->define(Drink::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name_id' => 1,
        'size_id' => 1,
        'price' => 5
    ];
});
