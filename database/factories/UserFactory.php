<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $first_name = $faker->name;
    $last_name = $faker->name;
    $full_name = $first_name . $last_name;  
    $b = random_int(7, 9); $c =random_int(10000000, 19999999);
    $number = '01'.$b.$c;
    
    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'full_name' => $full_name,
        'user_name' => str_slug($full_name),
        'image' => $faker->imageUrl(),
        'email' => $faker->unique()->safeEmail,
        'password' =>  bcrypt('123456'),
        'phone' => $number,
        'remember_token' => Str::random(10),
        'email_verified' => 1,
        'email_verified_at' => now(),
        'email_verification_token' => '',
        'deleted_at' => null
    ];
});
