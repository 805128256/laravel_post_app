<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'poster' => $faker->firstName(),
        'content' => $faker->realText(100),
        'time'=> $faker->dateTime('now'),
        'view_times' => $faker->numberBetween(1, 1000),
    ];
});
