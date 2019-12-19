<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feeling;
use Faker\Generator as Faker;

$factory->define(Feeling::class, function (Faker $faker) {
    return [
        'feeling' => $faker->realText(10),
        'post_id'=> App\Post::inRandomOrder()->first()->id,
    ];
});
