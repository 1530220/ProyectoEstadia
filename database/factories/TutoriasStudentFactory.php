<?php

use Faker\Generator as Faker;
use App\Tutorias_students;

$factory->define(App\Tutorias_students::class, function (Faker $faker) {
    //Matriculas de los estudiantes
    $student_users_id = App\Student::all()->pluck('user_id')->toArray();

    //Id del usuario
    $student_user_id = $faker->randomElement($student_users_id);

    //Usuario actual
    $actual_user = App\Student::whereUserId($student_user_id)->first();

    //Confirmacion
    $confirmation= $faker->numberBetween($min=0,$max=1);

    return [
        'student_user_id' => $student_user_id,
        'academic_situation' => $actual_user->academic_situation,
        'confirmation' => $confirmation,
    ];
});
