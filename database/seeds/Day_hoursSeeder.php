<?php

use Illuminate\Database\Seeder;
use App\Day_hour;

class Day_hoursSeeder extends Seeder
{
    /**
     * Llenar las horas de los horarios que usaran los profesores
     *
     * @return void
     */
    public function run()
    {
        Day_hour::create([
            'start_hour' => '07:00:00',
            'end_hour' => '07:54:59'
        ]);
        Day_hour::create([
            'start_hour' => '07:55:00',
            'end_hour' => '08:49:59'
        ]);
        Day_hour::create([
            'start_hour' => '08:50:00',
            'end_hour' => '09:44:59'
        ]);
        Day_hour::create([
            'start_hour' => '09:45:00',
            'end_hour' => '10:39:59'
        ]);
        Day_hour::create([
            'start_hour' => '11:10:00',
            'end_hour' => '12:04:59'
        ]);
        Day_hour::create([
            'start_hour' => '12:05:00',
            'end_hour' => '12:59:59'
        ]);
        Day_hour::create([
            'start_hour' => '13:00:00',
            'end_hour' => '13:54:59'
        ]);
        Day_hour::create([
            'start_hour' => '14:00:00',
            'end_hour' => '14:54:59'
        ]);
        Day_hour::create([
            'start_hour' => '14:55:00',
            'end_hour' => '15:49:59'
        ]);
        Day_hour::create([
            'start_hour' => '15:50:00',
            'end_hour' => '16:44:59'
        ]);
        Day_hour::create([
            'start_hour' => '16:45:00',
            'end_hour' => '17:39:59'
        ]);
        Day_hour::create([
            'start_hour' => '18:00:00',
            'end_hour' => '18:54:59'
        ]);
        Day_hour::create([
            'start_hour' => '18:55:00',
            'end_hour' => '19:49:59'
        ]);
        Day_hour::create([
            'start_hour' => '19:50:00',
            'end_hour' => '20:44:59'
        ]);
    }
}
