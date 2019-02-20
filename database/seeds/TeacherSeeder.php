<?php

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Se crean todos los tutores, para esto es necesario correr el Seeder
     * EmployeeSeeder que genera teacher con niveles(type=random) aleatorios
     * aqui se toman los que sean profesores(type=4 o type=5) obteniendo todos los registros
     * con eloquent para posteriormente almacenar su num_empleado como llave foranea.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Se deja a disposicion seeder para generar profesores(usuarios que fueron
        //guardados como profesores por el seeder usuarios)
        
        /******************************************************
        //Se obtienen los teacher que tengan tipo de usuario 4(profesor) o
        //5(tutor) para asignarlos posteriormente a la tabla teacher
        $teachers = DB::table('users')
          ->select('users.*')
          ->where('users.type',"=","4")
            ->orWhere('users.type',"=","5")
          ->get();

        //Se busca en todos los teachers
        foreach($teachers as $teacher)
        {
            //Caso de que sean teacher o tutores se almacenan
            if($teacher->type==4 || $teacher->type==5)
            {
                factory(App\Teacher::class)->create([
                    'user_id'=>$teacher->id,
                ]);
            }
        }
        *****************************************************/
    }
}
