<?php

namespace App\Helpers;
use Faker as Faker;

/* MultipleRelationsFactoryHelper.php
 *
 * Helper que se encarga la creacion de registros en la base de datos donde su
 * llave primaria (PK) esta conformada por una o mas llaves foraneas(PK) donde
 * en esta clase se buscan que la llave primaria del nuevo modelo(current_model)
 * mantenga su integridad asegurando que el nuevo registro generado por Faker
 * esta disponible para ser agregado.
 *
 * Para este proceso Faker toma los id random que son ingresados, comparando el
 * id generado con todos los registros actuales de la base de datos.
 *
 * Recive:
 *
 * $current_model           =   (model) Modelo actual ej. App\User::all()
 * $sample_current_model    =   (model) Una instancia nueva del modelo actual
 *                              ej. new App\User()
 * $comparation_models      =   (array) Son los modelos que se usaran para la
 *                              generacion de la llave primaria, mandados en un
 *                              array ej.
 *                              [
 *                                  App\Profession:all(),
 *                                  App\Country:all
 *                              ]
 * $id_names                =   (array) Contiene en un array los nombres de los
 *                              id almacenados en la bd correspondientes a los
 *                              modelos mandados ej.
 *                              [
 *                                  'id',
 *                                  'number'
 *                              ]
 * $curr_model_id_names     =   (array) Contiene los nombres de los id de las
 *                              llaves foraneas del modelo actual. ej.
 *                              [
 *                                  'profession_id',
 *                                  'state_number'
 *                              ]
*/

class MultipleRelationsFactoryHelper
{
    public function validate_random_element($current_model, $sample_current_model,
        $comparation_models, $id_names, $curr_model_id_names){

        //Instanciando faker para la seleccion de elementos aleatorios
        $faker = Faker\Factory::create();

        //Contendra los id de los modelos mandados
        $ids=array();

        //Poblando los id con los ids mandados en la variable $comparation_models
        for($i=0;$i<sizeof($comparation_models);$i++){
            for($j=0;$j<sizeof($comparation_models[$i]);$j++)
                $ids[$i][$j]=$comparation_models[$i][$j][$id_names[$i]];
        }

        //Este ciclo se realizara hasta que se encuentre un registro que no exista
        //en la base de datos
        do{
            //Definiendo que la prueba pasa actualmente
            $pass=true;

            //Se toman valores aleatorios de los modelos mandados
            for($i=0;$i<sizeof($comparation_models);$i++){
                $sample_current_model[$curr_model_id_names[$i]] =
                    $faker->randomElement($ids[$i]);
            }

            //Se recorren todos los registros de la bd del modelo actual y se
            //comparan con el nuevo registro creado por faker
            foreach($current_model as $instance)
            {
                //Cantidad de veces que se encontro que el registro de Faker
                //coincide con uno de la base de datos
                $cant_fails=0;
                for($i=0;$i<sizeof($comparation_models);$i++){
                    if($instance[$curr_model_id_names[$i]] ==
                        $sample_current_model[$curr_model_id_names[$i]]){
                        //Columna con el registro en la bd encontrado
                        $cant_fails=$cant_fails+1;
                    }
                }

                //Si la cantidad de veces que se encontro que el valor generado
                //por faker es el mismo a la cantidad de columnas de llaves
                //foraneas entonces, este registro ya existe.
                if($cant_fails==sizeof($comparation_models)){
                    $pass=false;
                    break;
                }
            }

        }while(!$pass);

        return $sample_current_model;
    }
}
