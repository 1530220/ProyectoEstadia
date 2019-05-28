<?php

use Faker\Generator as Faker;

$factory->define(App\Type_of_attention::class, function (Faker $faker) {
    return [
        'name'=>$faker->jobTitle
    ];
});
