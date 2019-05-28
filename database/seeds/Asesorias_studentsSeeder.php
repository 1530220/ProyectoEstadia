<?php

use Illuminate\Database\Seeder;
use App\Helpers\MultipleRelationsSeederHelper;

class Asesorias_studentsSeeder extends Seeder
{
    /**
     * Seeder de la relacion de la tabla Asesorias con la tabla Students,
     * almacenando asi el registro de las asesorias asi son individuales o
     * grupales
     *
     * @return void
     */
    public function run()
    {
        //Nota: Se deja a dispoiscion seeder de asesorias
        
        /******************************************************
        $helper = new MultipleRelationsSeederHelper();

        //Variable que determina la cantidad de veces que se ingresaran
        //nuevos registros
        //0 = Maxima cantidad de registros
        $ammount            = 5;

        //Se valida que la cantidad ingresada sea valida
        $ammount=$helper->validateAmmount($ammount, [
            App\Asesoria::all(),
            App\Student::all()
        ]);

        //Se crean los nuevos registros
        for($x=0;$x<$ammount;$x++)
            factory(\App\AsesoriasStudent::class)->create();
        ******************************************************/
    }
}
