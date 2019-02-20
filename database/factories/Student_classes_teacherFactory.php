<?php

use Faker\Generator as Faker;
use App\Helpers\MultipleRelationsFactoryHelper;

$factory->define(App\Student_classes_teacher::class, function (Faker $faker) {
    $helper = new App\Helpers\MultipleRelationsFactoryHelper;

    //Ejecucion del helper para asegurar la validez de las llaves foraneas.
    $new_student_classes_teacher = $helper->validate_random_element(
        App\Student_classes_teacher::all(),
        new App\Student_classes_teacher(),[
            App\Teacher::all(),
            App\Student_class::all(),
        ],[
            'user_id',
            'id',
        ],[
            't_user_id',
            'student_class_id',
        ]
    );

    //Retorna nuevo registro para la base de datos
    return [
       't_user_id' => $new_student_classes_teacher->t_user_id,
       'student_class_id' => $new_student_classes_teacher->student_class_id,
    ];
});
