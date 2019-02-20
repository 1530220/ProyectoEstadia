<?php

namespace App\Helpers;

/*  MultipleRelationsSeederHelper.php
 *
 *  Apoya la generacion de Seeders con multiples llaves foraneas verificando
 *  que el numero que se mande no excede la cantidad posible donde:
 *
 *  $ammount        =   Cantidad a verificar
 *  $models_array   =   Modelos que se usaran en las llaves foraneas ej.
 *                      [
 *                          App\User::all(),
 *                          App\profession_id::all()
 *                      ]
 *
 *  Donde se cumple la regla que cantidad de registros en el modelo(cm) multiplicados
 *  determinan el limite de registros posibles para la nueva tabla con las llaves foraneas
 *  (nt).
 *  cm1*cm2*...cmN = nt
 *
 *  Para fines de seguridad se elimina un registro restando una unidad al total.
 */
class MultipleRelationsSeederHelper
{
    public function validateAmmount($ammount, $models_array){
        //Multiplo para la cantidad maxima de registros
        $maximum_ammount=1;

        //Se multiplican todos los modelos
        foreach ($models_array as $actual_model) {
            $maximum_ammount=$maximum_ammount*sizeof($actual_model);
        }

        //Si la cantidad obtenida es menor a la cantidad posible el valor no cambia
        //en caso contrario se toma la cantidad maxima y se le resta uno, en caso
        //que el valor mandado sea 0 se toma la cantidad maxima por defecto.
        if($ammount>$maximum_ammount || $ammount==0)
            $ammount=$maximum_ammount-1;

        return $ammount;
    }
}
