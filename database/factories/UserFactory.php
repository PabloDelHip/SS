<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$dipQtQ.aSJeBgDcSDtdCRe0n1sQNS4V6FMeI.9FUqjLR.qRXYYxru', // password
        'remember_token' => Str::random(10),
        'status' => 1,
        'level' => 1,
        'profile_id' => $faker->numberBetween($min = 1, $max = 2),
        'contact_id' => $faker->numberBetween($min = 1, $max = 5),
        'vendor_id' => $faker->numberBetween($min = 1, $max = 26)
    ];
});
