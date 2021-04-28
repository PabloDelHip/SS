<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categorie_Vendor;
use Faker\Generator as Faker;

$factory->define(Categorie_Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
