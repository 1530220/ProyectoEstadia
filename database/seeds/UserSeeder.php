<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Se crean usuarios en la aplicacion, mostrando como ejemplos 3 administradores
     * 1 estudiante, 1 empleado(depto. tutorias), 1 profesor y un tutor.
     *
     * @return void
     */
    public function run()
    {
        //User id=4294967295                (System)
        User::create([
            'id' => 4294967295,
            'title' => "",
            'first_name' => 'Sin',
            'last_name' => 'Asignar',
            'second_last_name' => '',
            'username' => 'upv',
            'email' => 'sasignar@admin.upv.edu.mx',
            'password' => bcrypt('upv'),
            'type' => 99,
            'university_id' => "sys~siita~upv"
        ]);

        //User id=2                (Administrador Principal del Sistema)
        User::create([
            'id' => 2,
            'first_name' => 'Administrador',
            'last_name' => 'SIITA',
            'second_last_name' => '',
            'username' => 'admin_siita',
            'password' => bcrypt('admin_siita'),
            'email' => 'admin_siita@upv.edu.mx',
            'type' => 1,
            'university_id' => "a1"
        ]);

        //User id=1                 (Administrador)
        User::create([
            'id' => 3,
            'title' => "M.S.I",
            'first_name' => 'Mario Humberto',
            'last_name' => 'Rodríguez',
            'second_last_name' => 'Chavez',
            'username' => 'amrodriguezc',
            'email' => 'amrodriguezc@upv.edu.mx',
            'password' => bcrypt('amrodriguezc'),
            'type' => 1,
            'university_id' => "a2"
        ]);

        //Se crean n usuarios random, con contraseña encriptada con bcrypt 'secret'
        //y tipos de usuarios random pero se restringe a no crear mas administradores.
        for($i=0;$i<0;$i++){
            factory(User::class)->create();
        }

    }
}
