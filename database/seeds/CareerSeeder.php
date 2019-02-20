<?php

use Illuminate\Database\Seeder;
use App\Career;

class CareerSeeder extends Seeder
{
    /**
    * Se crean 4 carreras por defecto de la Universidad Politecnica de Victoria
    * y se proporciona una factory que creeara n carreras aleatorias.
    *
    * @return void
    */
    public function run()
    {
        //Carrera del sistema(indica que no se tiene una carrera registrada)
        Career::create([
          'id' => 4294967295,
          'abbreviation' => 'Sin Asignar',
          'name' => 'Sin Asignar'
        ]);

        //Nota se deja a disposicion seeder de carreras
        
        /******************************************************
        Career::create([
          'id' => 5001,
          'abbreviation' => 'ITI(P)',
          'name' => 'Ingeniería en Tecnologías de la Información PRUEBA'
        ]);

        Career::create([
          'id' => 5002,
          'abbreviation' => 'ITM(P)',
          'name' => 'Ingeniería en Tecnologías de la Manufactura PRUEBA'
        ]);

        Career::create([
          'id' => 5003,
          'abbreviation' => 'LGyPYMES(P)',
          'name' => 'Licenciatura PRUEBA'
        ]);

        //Se deja a disposicion factory
        factory(Career::class, 0)->create();
        ******************************************************/
    }
}
