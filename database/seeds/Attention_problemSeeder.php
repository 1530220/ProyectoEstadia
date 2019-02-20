<?php

use Illuminate\Database\Seeder;
use App\AttentionProblem;

class Attention_problemSeeder extends Seeder
{
    /**
     * Se ejecuta el seeder de tipos de atencion
     *
     * @return void
     */
    public function run()
    {
        AttentionProblem::create([
            'name'=>'Económico',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Personal',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Inseguridad',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Sexualidad',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Transporte',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Otro',
            'type_of_attention_id'=>1,
        ]);

        AttentionProblem::create([
            'name'=>'Salud',
            'type_of_attention_id'=>2,
        ]);

        AttentionProblem::create([
            'name'=>'Psicología',
            'type_of_attention_id'=>2,
        ]);
    }
}
