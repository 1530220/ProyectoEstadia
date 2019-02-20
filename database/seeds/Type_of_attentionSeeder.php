<?php

use Illuminate\Database\Seeder;
use App\Type_of_attention;

class Type_of_attentionSeeder extends Seeder
{
    /**
     * Se generan los tipos de atencion
     *
     * @return void
     */
    public function run()
    {
        Type_of_attention::create([
            'name'=>'Orientación'
        ]);

        Type_of_attention::create([
            'name'=>'Unidad Académica Escolar(USE)'
        ]);

        factory(Type_of_attention::class, 0)->create();
    }
}
