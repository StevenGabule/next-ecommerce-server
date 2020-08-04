<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cart;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'user_id' => User::pluck('id')->random(),
        'product_id' => Product::pluck('id')->random(),
        'qty' => random_int(100,200),
    ];
});
