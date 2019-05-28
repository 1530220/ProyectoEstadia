<?php

use Faker\Generator as Faker;

$factory->define(App\Asesoria::class, function (Faker $faker) {
    //Se obtienen todos los id de las clases
    $class_id = App\Student_class::all()->pluck('id')->toArray();
    //Se obtienen los numero de empleado de los tutores
    $teacher_user_id = App\Teacher::all()->pluck('user_id')->toArray();

    //Se obtiene una fecha aleatoria de 1 año antes a 30 dias a futuro
    $date_attention= $faker->dateTimeBetween('-360 days','+30 days');
    //Se obtiene un valor aleatorio de confirmacion
    $state= $faker->numberBetween($min=0,$max=2);

    //En caso de que la fecha sea despues del dia actual se pone por defecto
    //que no se ha confirmado la asesoria
    if($date_attention->format('Y-m-d H:i:s')>date("Y-m-d H:i:s") && $state!=0)
        $state=0;

    return [
        'observations' => $faker->text($maxNbChars=500),
        'state' => $state,
        'date_attention' => $date_attention,
        'class_id' => $faker->randomElement($class_id),
        'teacher_user_id' => $faker->randomElement($teacher_user_id)
    ];
});
