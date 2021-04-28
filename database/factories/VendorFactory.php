<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        'code' => $faker->postcode,
        'name' => $faker->company,
        'business_name' => $faker->companySuffix,
        'description' => $faker->text($maxNbChars = 200),
        'web' => $faker->safeEmailDomain,
        'email' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
        'address_id' => $faker->numberBetween($min = 1, $max = 16),
    ];
});
