<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\OrderedItem;
use Faker\Generator as Faker;

$factory->define(OrderedItem::class, function (Faker $faker) {
    return [
        'user_id' => App\User::pluck('id')->random(),
        'item_id' => App\Item::pluck('id')->random(),
        'qty' => $faker->numberBetween(1, 5)
    ];
});
