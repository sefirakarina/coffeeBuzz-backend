<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Drink;
use Faker\Generator as Faker;

$factory->define(Drink::class, function (Faker $faker) {
    $drinks = ["Cappuccino", "Coffee", "Bubble Tea", "Hot Chocolate"];
    $drink_types = ['S', 'M', 'L'];
    return [
        'name' =>  $drinks[rand(0,3)],
        'drink_type' => $drink_types[rand(0,2)],
    ];
});
