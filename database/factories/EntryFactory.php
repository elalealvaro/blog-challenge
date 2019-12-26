<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Entry;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(2, 10)),
        'content' => $faker->realText($faker->numberBetween(200, 2000)),
        'user_id' => $faker->unique(true)->numberBetween(1, User::count()),
    ];
});
