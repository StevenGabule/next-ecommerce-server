<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    $foodname = [
        $faker->foodName(),
        $faker->beverageName(),
        $faker->dairyName(),
        $faker->vegetableName(),
        $faker->fruitName(),
        $faker->meatName(),
        $faker->sauceName()
    ];
    return [
        'name' => $foodname[random_int(0, 6)],
        'description' => $faker->text,
        'short_description' => $faker->text,
        'price' => $faker->randomFloat(2, 0, 999999.99),
        'avatar' => $faker->imageUrl(250, 200, 'cats', true, 'Faker', false),
        'published_at' => $faker->dateTime(),
    ];
});
