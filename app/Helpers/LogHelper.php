<?php
use Illuminate\Support\Facades\DB;

/*
    Permite el registro de una actividad al log del sistema, las actividades
    registradas son, esta funcion puede ser llamada en toda la aplicacion al ser
    definida como un archivo a cargar en el archivo composer.json:

    3  =  Agregar
    4  =  Actualizar
    5  =  Eliminar
    6  =  Restaurar
    ...

    Se solicitan:
    $user_id    Id del usuario que lo realiza
    $item_id    Id del elemento registrado
    $item_name  Nombre del elemento registrado
    $cantidad   (opcional) la cantidad de elementos, en caso de superar la primera.

    Generando una cadena de mensaje que es insertada y sigue el siguiente formato
    El {usuario} {accion} un/una {nombre_del_elemento} con el id {id_del_elemento}

    Ej. de uso:

    insertToLog(Auth::user()->id, 'added', Input::get('career_id'), "carrera");
*/
function insertToLog($user_id, $action, $item_id, $item_name, $cantidad=0)
{
    //Se trae el tipo del usuario actual
    $type = DB::select("SELECT type FROM siita_db.users WHERE id = $user_id")[0]->type;

    //Se registra la fecha con hora
    $date = date("Y-m-d H:i:s");

    //Se crea variable message que contiene el mensaje a almacenar
    $message="";

    /** Se estructura el mensaje **/
    switch ($type) {
        case 1:
              $message = "El administrador ";
          break;
        case 3:
              $message = "El alumno ";
          break;
    }
    if(Auth::user()->title!="")
        $message = $message . Auth::user()->title." ";
    $message = $message . Auth::user()->first_name." ".Auth::user()->last_name." ".Auth::user()->second_last_name;

    switch ($action) {
        case 3:
        case 'added':
            $message = $message . " registro ";
            $action = 3;
            break;
        case 4:
        case 'updated':
            $message = $message . " actualizo ";
            $action = 4;
            break;
        case 5:
        case 'deleted':
            $message = $message . " elimino ";
            $action = 5;
            break;
        case 6:
        case 'recover':
            $message = $message . " restauro ";
            $action = 6;
            break;
    }
    if($cantidad==0){
        if(substr($item_name, -1)=='a' || substr($item_name, -1)=='A' || substr($item_name, -1)=='á'){
           // $message = $message . 'una ';
        }else{
          //  $message = $message . 'un ';
        }
    }
    else{
        $message = $message . $cantidad . ' ';
    }
    $message = $message . $item_name . " con el id " . $item_id;
    /** Termina estructuracion del mensaje **/

    //Se inserta el registro en la base de datos
    DB::insert('INSERT INTO log (message, date, action, user_id) values (?, ?, ?, ?)', [$message, $date, $action, $user_id]);
}
