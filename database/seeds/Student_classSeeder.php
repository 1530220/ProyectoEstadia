<?php

use Illuminate\Database\Seeder;
use App\Student_class;

class Student_classSeeder extends Seeder
{
    /**
     * Se crean las clases de los estudiantes, generando 4 que pertenecen a la carrera
     * con el indice[0] con valor "Ingenieria en Tecnologias de la informacion"
     * que es generada por CareerSeeder, para posteriormente crear 10 carreras de
     * manera aleatoria.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Se deja a dispoiscion seeder de estudiantes
        
        /******************************************************
        $careers_id = App\Career::all()->pluck('id')->toArray();

        Student_class::create([
            'id' => 5000,
            'name' => 'Algebra PRUEBA',
            'career_id' => $careers_id[0]
        ]);

        Student_class::create([
            'id' => 5002,
            'name' => 'Programación Web PRUEBA',
            'career_id' => $careers_id[0]
        ]);

        Student_class::create([
            'id' => 5003,
            'name' => 'Programación en Dispositivos Moviles PRUEBA',
            'career_id' => $careers_id[0]
        ]);

        Student_class::create([
            'id' => 5004,
            'name' => 'Programación Orientada a Objetos',
            'career_id' => $careers_id[0]
        ]);
        *****************************************************/

    }
}
