<?php

use Illuminate\Database\Seeder;
use App\Helpers\MultipleRelationsSeederHelper;

class StudentSeeder extends Seeder
{
    /**
     * Se crean nuevos estudiantes, por lo que se verifica que la cantidad
     * ingresada sea valida.
     *
     * @return void
     */
    public function run()
    {
        /*
        //Se toman los usuarios de type=3 que son los usuarios de tipo algumno
        //del sistema
        $users = App\User::where('type', '3')->get();

        //Se crean los nuevos alumnos
        foreach($users as $user)
            factory(\App\Student::class)->create([
                'user_id'=>$user->id
            ]);
        */
    }
}
