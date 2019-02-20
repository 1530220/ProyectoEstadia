<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Student::class, function (Faker $faker) {

    //Se obtienen todo los id de las carreras registradas en el sistema
    $careers_id=App\Career::all()->pluck('id')->toArray();

    //Se obtiene el id de la carrera al azar
    $career_id = $faker->randomElement($careers_id);

    //Se realiza una consulta para obtener solamente los numero de empleado de los
    //usuarios que tengan el type=5, o que sean tutores, para asi asignarlo de
    //manera aleatoria a los alumnos
    $tutors = DB::table('teachers')
      ->join('users', 'teachers.user_id', '=', 'users.id')
      ->where('users.type','=','5')
      ->where('teachers.career_id','=',$career_id)
      ->select('teachers.user_id')
      ->get()->pluck('user_id')->toArray();

    return [
        'academic_situation' => $faker->numberBetween($min = 0, $max = 1),
        'career_id'=> $career_id,
        'tutor_user_id'=> $faker->randomElement($tutors),
    ];
});
