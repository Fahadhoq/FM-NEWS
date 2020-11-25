<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    
     $category = $faker->name;

    return [
        'name' => $category,
        'slug' => str_slug($category),
    ];
});
