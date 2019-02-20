<?php

use Faker\Generator as Faker;

$factory->define(App\Career::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber($nbDigits = 4),
        'name' => $faker->jobTitle,
    ];
});
