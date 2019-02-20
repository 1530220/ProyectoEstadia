<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/*
 *  VerificationsController.php
 *
 *  Controlador para las verificaciones realizadas con AJAX a la base de datos.
*/
class VerificationsController extends Controller
{
    /**
     * Permite verificar si el valor de una columna existe en la base de datos,
     * por lo tanto determinando si el registro en cuestion existe o no.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function column_exists(Request $request)
    {

        $column_value = $request->column_value; //Valor de la columna
        $column_name = $request->column_name;   //Nombre de la columna
        $table_name = $request->table_name;     //Nombre de la tabla

        //Se realiza la consulta a la base de datos
        //select * from $table_name where $column_name=$column_value
        $entry = DB::select("select * from `".$table_name."` where `".$column_name."` LIKE BINARY LOWER('".$column_value."')");


        //Se verifica si existe algun valor o no en la variable entry para
        //determinar si existe el registro o no.
        if(empty($entry[0]))
            $response=false;
        else
            $response=true;

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$response]);
    }

    public function loggedIn(){
        return response()->json(['response'=>Auth::user()]);
    }
}
