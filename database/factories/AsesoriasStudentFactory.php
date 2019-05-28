<?php

use Faker\Generator as Faker;

$factory->define(App\AsesoriasStudent::class, function (Faker $faker) {
    $helper = new App\Helpers\MultipleRelationsFactoryHelper;

    //Ejecucion del helper para asegurar la validez de las llaves foraneas.
    $new_asesorias_student = $helper->validate_random_element(
        App\AsesoriasStudent::all(),
        new App\AsesoriasStudent(),[
            App\Asesoria::all(),
            App\Student::all(),
        ],[
            'id',
            'user_id',
        ],[
            'id_asesoria',
            'student_user_id',
        ]
    );

    //Retorna nuevo registro que no existe en la base de datos
    return [
       'id_asesoria' => $new_asesorias_student->id_asesoria,
       'student_user_id' => $new_asesorias_student->student_user_id,
    ];
});
