<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    $careers_id = App\Career::all()->pluck('id')->toArray();

    return [
        'career_id' => $faker->randomElement($careers_id),
    ];
});
