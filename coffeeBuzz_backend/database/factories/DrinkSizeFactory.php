<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DrinkSize;
use Faker\Generator as Faker;

$factory->define(DrinkSize::class, function (Faker $faker) {
    return [
        'id'=> '1',
        'size'=> 's',
    ];
});
