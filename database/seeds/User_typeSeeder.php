<?php

use Illuminate\Database\Seeder;
use App\User_type;

class User_typeSeeder extends Seeder
{
    /**
     * Seeder de los tipos de usuario del sistema
     *
     * IMPORTANTE:
     * Usar los id definidos por este seeder para correr la aplicacion,
     * estos id sean usados en todo el sistema como tales, por lo tanto no hay
     * que modificarlos.
     *
     * @return void
     */
    public function run()
    {
        //Id = 1    Tipo Administrador
        User_type::create([
            'id' => 1,
            'name' => 'Administrator',
        ]);

        //Id = 2    Tipo Usuario del depto. de tutorias
        User_type::create([
            'id' => 2,
            'name' => 'User',
        ]);

        //Id = 3    Tipo Estudiante
        User_type::create([
            'id' => 3,
            'name' => 'Student',
        ]);

        //Id = 4    Tipo Profesor
        User_type::create([
            'id' => 4,
            'name' => 'Teacher',
        ]);

        //Id = 5    Tipo Tutor
        User_type::create([
            'id' => 5,
            'name' => 'Tutor',
        ]);

        //Id = 6    Tipo Departamento de Salud
        User_type::create([
            'id' => 6,
            'name' => 'Dpto. Salud',
        ]);

        //Id = 7    Tipo Departamento de Psicologia
        User_type::create([
            'id' => 7,
            'name' => 'Dpto. Psicologia',
        ]);

        //Id = 99   Tipo System
        User_type::create([
            'id' => 99,
            'name' => 'System',
        ]);
    }
}
