<?php

use Faker\Generator as Faker;

$factory->define(App\Student_class::class, function (Faker $faker) {
    $careers_id = App\Career::all()->pluck('id')->toArray();

    return [
        'id' => $faker->unique()->randomNumber($nbDigits = 4),
        'name' => $faker->jobTitle,
        'career_id' => $faker->randomElement($careers_id),
    ];
});
