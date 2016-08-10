<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(),
        'image' => '/images/pizza.jpg',
        'price' => $faker->numberBetween(10, 100),
        'status' => $faker->randomElement([1, 2, 3]), 
        'quantity' => $faker->numberBetween(10, 999),
        'rating' => $faker->numberBetween(1, 5),   
        'category_id' => $faker->randomElement([3, 4, 5, 6]),  
    ];
});
