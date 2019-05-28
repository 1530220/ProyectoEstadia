<?php

use Illuminate\Database\Seeder;
use App\Tutorias_students;

class Tutorias_studentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Se deja a disposicion seeder de tutorias(Aqui se llenan los alumnos participantes)
        
        /******************************************************
        $tutorias = App\Tutoria::all();

        //Se busca en todos los teachers
        foreach($tutorias as $tutoria)
        {
            $cant_alumnos = rand(1, 10);
            for($i=0;$i<$cant_alumnos;$i++){
                factory(App\Tutorias_students::class)->create([
                    'tutoria_id'=>$tutoria->id,
                ]);
            }
        }
        ******************************************************/
    }
}
