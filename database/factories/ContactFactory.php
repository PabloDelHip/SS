<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'type' => $faker->numberBetween($min = 1, $max = 2),
        'rfc' => Str::random(10),
        'type_person' => $faker->numberBetween($min = 1, $max = 2),
        'emails' => $faker->email,
        'address_id' => $faker->numberBetween($min = 1, $max = 16)
    ];
});
