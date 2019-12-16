<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'comment' => $faker->realText(20),
        'post_id'=> App\Post::inRandomOrder()->first()->id,
    ];
});
