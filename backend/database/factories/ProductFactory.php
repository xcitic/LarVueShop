<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph(1),
        'description' => $faker->paragraph(4),
        'slug' => $faker->slug,
        'price' => $faker->numberBetween(100,1000),
        'likes' => $faker->numberBetween(0,200),
        'image' => $faker->slug,

    ];
});
