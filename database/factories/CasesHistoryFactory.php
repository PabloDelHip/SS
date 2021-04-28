<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CasesHistory;
use Faker\Generator as Faker;

$factory->define(CasesHistory::class, function (Faker $faker) {
    return [
        'information' => $faker->text($maxNbChars = 800),
        'case_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
