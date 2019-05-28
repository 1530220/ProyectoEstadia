<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Migracion para la tabla teachers.
     *
     * Almacena a los empleados(usuarios) que son profesores(type=4 o type=5)
     *
     * @return void
     */
    public function up()
    {
        /*
            Tabla 'teachers'

            ### Estructura ###
            (FK)(PK)user_id:        Referencia al numero de usuario del profesor
            (FK)career_id:          Id de la carrera a la que pertenece el
                                    profesor

        */
        Schema::create('teachers', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('career_id')->unsigned();

            $table->primary('user_id');

            $table->foreign('career_id')->references('id')->on('careers')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
