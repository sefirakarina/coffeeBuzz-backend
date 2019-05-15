<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\OrderList;
use Faker\Generator as Faker;

$factory->define(OrderList::class, function (Faker $faker) {
    return [
        'user_id' => App\User::pluck('id')->random(),
        'item_id' => App\Item::pluck('id')->random(),
        'qty' => $faker->numberBetween(1, 5)
    ];
});
