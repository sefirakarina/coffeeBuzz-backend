<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    $foodOrDrink = ['food', 'drink'];

    return [
        'item_type' => $foodOrDrink[rand(0,1)],
        'food_id' => App\Food::pluck('id')->random(),
        'drink_id' => App\Drink::pluck('id')->random(),
    ];
});
