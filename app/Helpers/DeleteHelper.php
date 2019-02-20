<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
/*
 * DeleteHelper.php
 *
 * Funcion que permite la eliminacion logica de un registro en la base de datos, busca
 * en todos los registros de la base de datos, los que esten relacionados con un registro
 * en cuestion, que se quiera eliminar, posteriormente estos registros son actualizados
 * con el valor de su borrado logico para respetar las llaves foraneas.
 *
 * Parametros:
 *      $table_name     Nombre de la tabla en la que se encuentra el registro a eliminar logicamente
 *      $column_name    Nombre de la columna del registro que se estara eliminando logicamente
 *      $column_value   Valor de la columna que se estara eliminando logicamente
 *
 * Ejemplo de uso:
 *
 *      DeleteHelper::instance()->onCascadeLogicalDelete('users','id',11);
 *
 *      Donde en este registro se estara eliminado el usuario con el id(con el nombre id) de la tabla users.
 */
class DeleteHelper
{
    public function onCascadeLogicalDelete($table_name, $column_name, $column_value)
    {
        //Se obtienen las tablas que estan relacionadas con el borrado logicto
        $careers = DB::select("SELECT TABLE_NAME, COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE
            CONSTRAINT_SCHEMA = 'bolsa_trabajo' AND REFERENCED_TABLE_NAME = '".$table_name."' AND REFERENCED_COLUMN_NAME = '".$column_name."'");

        //Se realiza el borrado logico de la tabla que se esta borrando
        DB::table($table_name)
            ->where($column_name, $column_value)
            ->update(['deleted' => '1']);

        //Se realiza el borrado logico de todos los registros de todas las tablas que
        //esten relacionadas con el registro eliminado
        for($x=0;$x<sizeof($careers);$x++)
        {
            //Se realiza una excepcion con la tabla log, que no sera eliminada
            if($careers[$x]->TABLE_NAME!='log'){
                DB::table($careers[$x]->TABLE_NAME)
                    ->where($careers[$x]->COLUMN_NAME, $column_value)
                    ->update(['deleted' => '1']);
            }
        }

        return true;

    }

    //Funcion que permite restaurar el borrado, desactivando el borrado logico
    public function restoreLogicalDelete($table_name, $column_name, $column_value)
    {
        //Se obtienen las tablas que estan relacionadas con recuperado logico
        $careers = DB::select("SELECT TABLE_NAME, COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE
            CONSTRAINT_SCHEMA = 'bolsa_trabajo' AND REFERENCED_TABLE_NAME = '".$table_name."' AND REFERENCED_COLUMN_NAME = '".$column_name."'");

        //Se realiza el restaurado logico de la tabla que se esta borrando
        DB::table($table_name)
            ->where($column_name, $column_value)
            ->update(['deleted' => '0']);

        //Se realiza el restaurado logico de todos los registros de todas las tablas que
        //esten relacionadas con el registro eliminado
        for($x=0;$x<sizeof($careers);$x++)
        {
            //Se realiza una excepcion con la tabla log, que no sera tomada en cuenta
            if($careers[$x]->TABLE_NAME!='log'){
                DB::table($careers[$x]->TABLE_NAME)
                    ->where($careers[$x]->COLUMN_NAME, $column_value)
                    ->update(['deleted' => '0']);
            }
        }

        if($x==0)
            return false;
        else
            return true;
    }

    //Inicializacion de la clase
    public static function instance()
    {
        return new DeleteHelper();
    }
}
