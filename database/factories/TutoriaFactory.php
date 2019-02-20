<?php

use Faker\Generator as Faker;
use App\AttentionProblem;

$factory->define(App\Tutoria::class, function (Faker $faker) {

    //Numero de empleado de los tutores
    $tutors_users_id = App\Teacher::all()->pluck('user_id')->toArray();
    //Id de los tipos de atencion de la tutoria
    //$ids_type_of_attention = App\Type_of_attention::all()->pluck('id')->toArray();

    //Se obtiene una fecha aleatoria de 1 año antes a 30 dias a futuro
    $date_attention= $faker->dateTimeBetween('-360 days','+30 days');
    //Se obtiene un valor aleatorio de confirmacion
    $state= $faker->numberBetween($min=0,$max=2);

    //En caso de que la fecha sea despues del dia actual se pone por defecto
    //que no se ha confirmado la asesoria
    if($date_attention->format('Y-m-d H:i:s')>date("Y-m-d H:i:s") && $state!=0)
        $state=0;

    $type_of_problems= App\AttentionProblem::all();

    $type_of_problem = $faker->randomElement($type_of_problems);

    return [
        'date_attention' => $date_attention,
        'observations' => $faker->text($maxNbChars = 500),
        'state' => $state,
        'id_type_of_attention' => $type_of_problem->type_of_attention_id,
        'id_attention_problems' => $type_of_problem->id,
        'tutor_user_id' => $faker->randomElement($tutors_users_id),
        'type_of_tutoria' => $faker->numberBetween($min=1,$max=2),
    ];
});
