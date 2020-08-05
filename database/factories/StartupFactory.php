<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Startup;
use Faker\Generator as Faker;

$factory->define(Startup::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sector' =>$faker->unique()->name,
        'founded' => $faker->year,
        'headquarters' => $faker->city,
        'bio' => $faker->sentence
    ];
});
