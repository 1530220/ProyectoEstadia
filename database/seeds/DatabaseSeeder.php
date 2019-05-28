<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Vaciar y llenar la base de datos de la aplicacion
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
                'user_types',
                'careers',
                'student_classes',
                'users',
                'teachers',
                'student_classes_teachers',
                'day_hours',
                'available_hours',
                'students',
                'type_of_attentions',
                'attention_problems',
                'tutorias',
                'tutorias_students',
                'asesorias',
                'asesorias_students',
              ]);

        //Se llaman los seeder, IMPORTANTE seguir orden por restricciones de
        //llaves foraneas.
        $this->call(User_typeSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(Student_classSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(Student_classes_teacherSeeder::class);
        $this->call(Day_hoursSeeder::class);
        $this->call(Available_hourSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(Type_of_attentionSeeder::class);
        $this->call(Attention_problemSeeder::class);
        $this->call(TutoriaSeeder::class);
        $this->call(Tutorias_studentsSeeder::class);
        $this->call(AsesoriaSeeder::class);
        $this->call(Asesorias_studentsSeeder::class);

    }

    /*
        Permite el eliminado de todos los registros de una tabla, independientemente
        de sus llaves foraneas.
    */
    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
