<?php

use Faker\Generator as Faker;
use App\Day_hour;

$factory->define(App\Available_hour::class, function (Faker $faker) {

    $day_hours = App\Day_hour::all()->pluck('id')->toArray();
    $teachers = App\Teacher::all()->pluck('user_id')->toArray();

    //Retorna nuevo registro valido
    return [
        'id_hour' => $faker->randomElement($day_hours),
        'week_day_num' => $faker->numberBetween($min = 0, $max = 6),
        'teacher_user_id' => $faker->randomElement($teachers),
        'type' => $faker->numberBetween($min = 1, $max = 2),
        'available_ammount' => 3,
    ];
});
