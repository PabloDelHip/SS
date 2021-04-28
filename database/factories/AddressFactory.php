<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'postal_code' => $faker->postcode,
        'street' => $faker->streetName,
        'interior_num' => $faker->buildingNumber,
        'exterior_num' => $faker->buildingNumber,
        'country_id' => 1,
        'state_id' => 1,
        'city_id' => 1,
    ];
});
