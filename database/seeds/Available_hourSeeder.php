<?php

use Illuminate\Database\Seeder;
use App\Helpers\MultipleRelationsSeederHelper;
use App\Available_hour;

class Available_hourSeeder extends Seeder
{
    /**
     * Se ejecuta el seeder de Available_hour para el almacenado del registro
     * de la hora libre y a la hora correspondiente, ademas almacenando su profesor,
     * que en esta caso la relacion es asegurada por el helper.
     *
     * @return void
     */
    public function run()
    {
        //Nota: se deja a dispocion seeder de horas
        
        /******************************************************
        Available_hour::create([
            'id_hour' => 1,
            'week_day_num' =>1,
            'teacher_user_id' => 8,
            'type' => 1,
        ]);
        Available_hour::create([
            'id_hour' => 5,
            'week_day_num' =>2,
            'teacher_user_id' => 8,
            'type' => 2,
        ]);
        Available_hour::create([
            'id_hour' => 6,
            'week_day_num' =>3,
            'teacher_user_id' => 8,
            'type' => 2,
        ]);
        Available_hour::create([
            'id_hour' => 8,
            'week_day_num' =>3,
            'teacher_user_id' => 8,
            'type' => 1,
        ]);
        Available_hour::create([
            'id_hour' => 8,
            'week_day_num' =>3,
            'teacher_user_id' => 8,
            'type' => 2,
        ]);
        ******************************************************/
    }
}
