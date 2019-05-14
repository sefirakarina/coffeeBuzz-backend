<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DrinkName;
use Faker\Generator as Faker;

$factory->define(DrinkName::class, function (Faker $faker) {
    return [
        'id'=> '1',
        'name'=> 'cappucino',
    ];
});
