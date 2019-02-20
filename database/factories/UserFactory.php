<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    //Se obtiene el nivel del usuario de manera aleatoria
    $level = $faker->numberBetween($min = 2, $max = 5);

    //Se agrega probabilidad de que un usuario sea estudiante, volviendo a
    //ejecutar el random en caso de que el resultado no sea usuario
    if($level!=3)
        $level = $faker->numberBetween($min = 2, $max = 5);

    //Se obtiene el sexo de manera aleatoria
    $gender=$faker->numberBetween($min = 0, $max = 1);

    //Si el sexo del usuario es 1 es femenino y 0 es masculino, esto para
    //tener un nombre de persona correspondiente al sexo obtenido
    if($gender==1)
        $first_name = $faker->firstNameFemale;
    else
        $first_name = $faker->firstNamemale;

    //Se obtienen apellidos
    $last_name = $faker->lastName;
    $second_last_name = $faker->lastName;

    //Se genera el university_id dependiendo del nivel de usuario que se este
    //creando
    if($level!=3)
    {
        //** Caso de que no es alumno **//
        //Se determina el titulo dependiendo del genero
        if($gender==1)
            $title=$faker->titleFemale;
        else {
            $title=$faker->titleMale;
        }
        //Se genera el nombre de usuario que es una cadena conformada por
        //primera letra del nombre+apellido_paterno+primera letra del apellido paterno
        $username = str_replace(' ', '',strtolower(toASCII($first_name[0].$last_name.$second_last_name[0])));
        //Se asigna un numero de usuario conformado por 3 digitos
        $university_id = $faker->unique()->randomNumber($nbDigits = 3);
    }else {
        //** Caso de que es alumno **//
        $title="";

        //Se genera la matricula con un 1 al principio de la misma
        $username = $faker->numerify('1######');

        //El nombre de usuario se asigna la misma matricula
        $university_id = $username;
    };

    //Se verifica que no exista un repetido en el registro generado
    if(DB::SELECT("select count(*) as c from users where university_id='".
        $university_id."' or username = '".$username."'")[0]->{'c'}>0){

        if($level!=3)
        {
            //En caso de que no sea alumno
            //Al nombre de usuario se agregan dos letras para que sea unico
            $username = $username.$faker->lexify('??');
            //Al id de la universidad se genra un numero aleatorio de 4 digitos
            $university_id = $faker->unique()->numerify('####');
        }
        else{
            //En caso de que sea alumno
            //Se genera la matricula agregando un digito
            $username =  $faker->numerify('#######');
            //Se asigna el id de la universidad al mismo nombre de usuario
            $university_id = $username;
        }
    }

    return [
        'id' => $faker->unique()->randomNumber($nbDigits = 4),
        'university_id' => $university_id,
        'title' => $title,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'second_last_name' => $second_last_name,
        'type' => $level,
        'email' => $username.'@upv.edu.mx',
        'username' => $username,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // "secret" bcrypt
        'email_verified_at' => now(),
        'remember_token' => str_random(10),
    ];
});
