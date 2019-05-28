<?php

use Illuminate\Database\Seeder;
use App\Helpers\MultipleRelationsSeederHelper;

class Student_classes_teacherSeeder extends Seeder
{
    /**
     * Se ejecuta el seeder de lar elacion entre student_classes y teachers,
     * definiendo asi que clase le toca a cada teacher.
     *
     * @return void
     */
    public function run()
    {
        //Nota: se deja a disposicion seeder de clases
        
        /******************************************************
        $helper = new MultipleRelationsSeederHelper();

        //Variable que determina la cantidad de veces que se ingresaran
        //nuevos registros
        //0 = Maxima cantidad de registros
        $ammount            = 5;

        //Se valida que la cantidad ingresada sea valida
        $ammount=$helper->validateAmmount($ammount, [
            App\Teacher::all(),
            App\Student_class::all()
        ]);

        //Se crean los nuevos registros
        for($x=0;$x<$ammount;$x++)
            factory(\App\Student_classes_teacher::class)->create();
        ******************************************************/
    }
}
