<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\OrderedItem;
use Faker\Generator as Faker;

$factory->define(OrderedItem::class, function (Faker $faker) {
    return [
        'cart_id' => App\Cart::pluck('id')->random(),
    ];
});
