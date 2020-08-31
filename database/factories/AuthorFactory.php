<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        //
    ];
});


$factory->afterCreating(App\Author::class, function($author, $faker){
    $author->profile()->save(factory(App\Profile::class)->make());
});
