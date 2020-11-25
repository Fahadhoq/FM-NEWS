<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
            'user_id' => random_int(1, 5),
            'category_id' => random_int(1, 5),
            'tittle' => $faker->realText(32),
            'content' => $faker->realText(),
            'thumbnail_path' => $faker->imageUrl(),
            
    ];
});
