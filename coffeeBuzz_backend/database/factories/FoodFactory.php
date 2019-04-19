<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Food;
use Faker\Generator as Faker;

$factory->define(Food::class, function (Faker $faker) {
    $food = ["Nachos", "Burrito", "Steak", "Fish and Chips", "Banana Split", "Spaghetti", "Bacon and Egg"];

    return [
        'name' =>  $food[rand(0,6)],
        'qty' =>  $faker->numberBetween(0, 100),
    ];
});
