<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use Validator;
use App\Career;
use App\Student;
use App\Teacher;
use App\Student_class;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

ini_set('max_execution_time',11000);

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $is_uploaded="false";
        return view('imports.list', compact('is_uploaded'));
    }
    public function create()
    {
        return view('imports.create');
    }

    /**
     * Se almacena la carrera en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actual_importation=$request->actual_importation;
        $importation_type=$request->importation_type;
        $table=$request->table;
        $second_table=$request->second_table;

        //[0]=estado(error/update/insert) [1]=Lista de errores [2]valores
        $row_result=[];

        $validator = Validator::make($request->all(), [
            'csv_input' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('csv_input');
        $csvData = file_get_contents($file);

        $rows = array_map('str_getcsv', explode("\n", $csvData));

        $headers = array_shift($rows);

        if (sizeof($rows[sizeof($rows)-1])==1) {
            array_pop($rows);
        }
        $original_headers=$headers;
        $correct_count=0;
        for ($i=0;$i<sizeof($headers);$i++) {
            $headers[$i]=strtolower($headers[$i]);

            switch ($importation_type) {
                case 'import_students':
                    switch ($headers[$i]) {
                        case 'id_alumno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='id';
                            break;
                        case 'matricula':
                            $correct_count=$correct_count+1;
                            $headers[$i]='university_id';
                            break;
                        case 'nombre':
                            $correct_count=$correct_count+1;
                            $headers[$i]='first_name';
                            break;
                        case 'ap_paterno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='last_name';
                            break;
                        case 'ap_materno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='second_last_name';
                            break;
                        case 'username':
                            $correct_count=$correct_count+1;
                            $headers[$i]='username';
                            break;
                        case 'password':
                            $correct_count=$correct_count+1;
                            $headers[$i]='password';
                            break;
                        case 'id_carrera':
                            $correct_count=$correct_count+1;
                            $headers[$i]='career_id';
                            break;
                        case 'id_tutor':
                            $correct_count=$correct_count+1;
                            $headers[$i]='tutor_user_id';
                            break;
                    }
                    break;
                case 'import_careers':
                    switch ($headers[$i]) {
                        case 'id_carrera':
                            $correct_count=$correct_count+1;
                            $headers[$i]='id';
                            break;
                        case 'nombre':
                            $correct_count=$correct_count+1;
                            $headers[$i]='name';
                            break;
                        case 'abreviacion':
                            $correct_count=$correct_count+1;
                            $headers[$i]='abbreviation';
                            break;
                    }
                    break;
                case 'import_teachers':
                    switch ($headers[$i]) {
                        case 'id_profesor':
                            $correct_count=$correct_count+1;
                            $headers[$i]='id';
                            break;
                        case 'num_empleado':
                            $correct_count=$correct_count+1;
                            $headers[$i]='university_id';
                            break;
                        case 'nombre':
                            $correct_count=$correct_count+1;
                            $headers[$i]='first_name';
                            break;
                        case 'ap_paterno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='last_name';
                            break;
                        case 'ap_materno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='second_last_name';
                            break;
                        case 'username':
                            $correct_count=$correct_count+1;
                            $headers[$i]='username';
                            break;
                        case 'password':
                            $correct_count=$correct_count+1;
                            $headers[$i]='password';
                            break;
                        case 'id_carrera':
                            $correct_count=$correct_count+1;
                            $headers[$i]='career_id';
                            break;
                        case 'tutor':
                            $correct_count=$correct_count+1;
                            $headers[$i]='type';
                            break;
                    }
                    break;
                case "import_classes":
                    switch ($headers[$i]) {
                        case 'id_materia':
                            $correct_count=$correct_count+1;
                            $headers[$i]='id';
                            break;
                        case 'nombre':
                            $correct_count=$correct_count+1;
                            $headers[$i]='name';
                            break;
                    }
                    break;
                case "assignation":
                    switch ($headers[$i]) {
                        case 'id_alumno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='user_id';
                            break;
                        case 'id_tutor':
                            $correct_count=$correct_count+1;
                            $headers[$i]='tutor_user_id';
                            break;
                    }
                    break;
                case "import_users":
                    switch ($headers[$i]) {
                        case 'id_usuario':
                            $correct_count=$correct_count+1;
                            $headers[$i]='id';
                            break;
                        case 'num_empleado':
                            $correct_count=$correct_count+1;
                            $headers[$i]='university_id';
                            break;
                        case 'nombre':
                            $correct_count=$correct_count+1;
                            $headers[$i]='first_name';
                            break;
                        case 'ap_paterno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='last_name';
                            break;
                        case 'ap_materno':
                            $correct_count=$correct_count+1;
                            $headers[$i]='second_last_name';
                            break;
                        case 'username':
                            $correct_count=$correct_count+1;
                            $headers[$i]='username';
                            break;
                        case 'password':
                            $correct_count=$correct_count+1;
                            $headers[$i]='password';
                            break;
                        case 'tipo_usuario':
                            $correct_count=$correct_count+1;
                            $headers[$i]='type';
                            break;
                    }
                    break;
            }
        }
        $csv_has_correct_format=false;
        switch ($importation_type) {
            case 'import_students':
                if($correct_count==9)
                    $csv_has_correct_format=true;
                break;
            case 'import_careers':
                if($correct_count==3)
                    $csv_has_correct_format=true;
                break;
            case 'import_teachers':
                if($correct_count==9)
                    $csv_has_correct_format=true;
                break;
            case 'import_classes':
                if($correct_count==2)
                    $csv_has_correct_format=true;
                break;
            case 'assignation':
                if($correct_count==2)
                    $csv_has_correct_format=true;
                break;
            case 'import_users':
                if($correct_count==8)
                    $csv_has_correct_format=true;
                break;
        }
        if($csv_has_correct_format){
            foreach ($rows as $row) {
                $is_valid_row=true;
                $is_update_row=false;
                $error="";

                for ($i=0;$i<sizeof($headers);$i++) {
                    if(!checkIfIsExcludedHeader($headers[$i],$importation_type)){

                        $nullable_col = DB::select("SELECT 1 as response FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'SIITA_db' AND TABLE_NAME='".$table."' AND COLUMN_NAME= '".$headers[$i]."' AND IS_NULLABLE = 'YES'");

                        //Si tiene valor la columan es unica y se debe verificar su validez como unica
                        if ($nullable_col==null && $row[$i]=="") {
                            $is_valid_row=false;
                            $error=$error."* [VALOR REQUERIDO] El valor {$row[$i]} de la columna {$original_headers[$i]} necesita insertarse previamente.<br />";
                        }


                        if ($row[$i]!="") {
                            $primary_key = DB::select("SELECT 1 as response FROM information_schema.key_column_usage WHERE table_schema = 'SIITA_db' AND constraint_name = 'PRIMARY' AND table_name = '".$table."' AND column_name='".$headers[$i]."'");

                            //La columna es unica y se debe verificar
                            if ($primary_key!=null) {
                                $is_valid_primary = DB::select("SELECT 1 as response FROM ".$table." WHERE ".$headers[$i]." = '".$row[$i]."'");

                                //Se encontro un registro con valor de columna unica, por lo tanto no se realiza el registro
                                if ($is_valid_primary!=null) {
                                    $is_update_row=true;
                                }
                            }

                            //Se obtiene si una columna es de tipo unica(1=SI/NULL=NO)
                            $unique_col = DB::select("SELECT 1 as response FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'SIITA_db' AND TABLE_NAME='".$table."' AND COLUMN_NAME = '".$headers[$i]."' AND COLUMN_KEY = 'UNI'");

                            //Si tiene valor la columan es unica y se debe verificar su validez como unica
                            if ($unique_col!=null) {

                                if($is_update_row){
                                    //Se obtiene un registro en la tabla donde se quiera insertar
                                    $registered_elements = sizeof(DB::select("SELECT 1 as response FROM ".$table." WHERE ".$headers[$i]." = '".$row[$i]."'"));
                                    if($registered_elements==1)
                                        $is_unique=null;
                                }else{
                                    //Se obtiene un registro en la tabla donde se quiera insertar
                                    $is_unique = DB::select("SELECT 1 as response FROM ".$table." WHERE ".$headers[$i]." = '".$row[$i]."'");
                                }
                                //Se encontro un registro con valor de columna unica, por lo tanto no se realiza el registro
                                if ($is_unique!=null) {
                                    $is_valid_row=false;
                                    $error=$error."* [VALOR UNICO] El valor {$row[$i]} de la columna {$original_headers[$i]} no puede repetirse en los registros.<br />";
                                }
                            }

                            $foreign_key_ref = DB::select("SELECT REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME FROM information_schema.key_column_usage WHERE referenced_table_name is not null AND TABLE_SCHEMA='SIITA_db' AND TABLE_NAME='".$table."' AND COLUMN_NAME='".$headers[$i]."'");


                            if ($foreign_key_ref!=null) {

                                $foreign_key_exists = DB::select("SELECT 1 AS response FROM ".$foreign_key_ref[0]->REFERENCED_TABLE_NAME." WHERE ".$foreign_key_ref[0]->REFERENCED_COLUMN_NAME." = '".$row[$i]."'");

                                if ($foreign_key_exists==null) {
                                    $is_valid_row=false;
                                    $error=$error."* [FALTA REGISTRO PREVIO] El valor {$row[$i]} de la columna {$original_headers[$i]} requiere que el registro de la columna {$foreign_key_ref[0]->REFERENCED_COLUMN_NAME} de la tabla {$foreign_key_ref[0]->REFERENCED_TABLE_NAME} sea ingresado previamente.<br />";
                                }
                            }
                        }
                    }else{
                        if($row[$i]==""){
                            $is_valid_row=false;
                            $error=$error."* [VALOR REQUERIDO] El valor {$row[$i]} de la columna {$original_headers[$i]} necesita insertarse previamente.<br />";
                        }
                    }
                }

                if ($second_table!="") {
                    switch ($second_table) {
                            case "students":
                                $type="3";
                                break;
                    }
                }

                //$row_result_values=array_combine($original_headers, $row);
                for($x=0;$x<sizeof($original_headers);$x++){
                    $row_result_values[$i][$x]=[$row[$x],$original_headers[$x]];
                }

                switch ($importation_type) {
                    case 'import_students':
                        if ($second_table=="students") {
                            for ($i=0;$i<sizeof($headers);$i++) {
                                $result = second_table_validation($is_valid_row, $is_update_row, $second_table, $headers[$i], $row[$i], $original_headers[$i], $error, $importation_type);

                                $is_valid_row=$result[0];
                                $error=$result[1];
                            }

                            if ($is_update_row && $is_valid_row) {

                                $table_1 = DB::select("SELECT 1 as response FROM users WHERE university_id = ? AND first_name = ? AND last_name = ? AND second_last_name = ? AND username = ? AND email = ? AND id = ?",
                                        [ $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", $row[0]] );
                                $table_2 = DB::select("SELECT 1 as response FROM students WHERE career_id = ? AND tutor_user_id = ? AND user_id = ?",
                                        [ $row[7], $row[8], $row[0]] );
                                if($table_1==null || $table_2==null){
                                    DB::update('UPDATE users SET university_id = ?, first_name = ?, last_name = ?, second_last_name = ?, username = ?, email = ?, password = ? WHERE id = ?', [
                                                $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", bcrypt($row[6]), $row[0]
                                            ]);
                                    DB::update('UPDATE students SET career_id = ?, tutor_user_id = ? WHERE user_id = ?', [
                                                 $row[7], $row[8], $row[0]
                                            ]);
                                    array_push($row_result,["Update","El estudiante con el id {$row[0]} fue actualizado.",$row_result_values]);
                                }else{
                                    array_push($row_result,["Stays","El estudiante con el id {$row[0]} no fue modificado.",$row_result_values]);
                                }
                            } elseif ($is_valid_row) {
                                User::create([
                                    'id' => $row[0],
                                    'university_id' =>  $row[1],
                                    'title' => "",
                                    'first_name' => $row[2],
                                    'last_name' => $row[3],
                                    'second_last_name' => $row[4],
                                    'username' => $row[5],
                                    'email' =>  $row[5]."@upv.edu.mx",
                                    'password' => bcrypt($row[6]),
                                    'type' => $type,
                                ]);

                                Student::create([
                                    'user_id' => $row[0],
                                    'academic_situation' =>  0,
                                    'career_id' => $row[7],
                                    'tutor_user_id' => $row[8],
                                ]);
                                array_push($row_result,["Correct","Un estudiante con el id {$row[0]} fue registrado correctamente",$row_result_values]);
                            } else{
                                array_push($row_result,["Error","El estudiante con id {$row[0]} no pudo ser registrado por: <br /> {$error}",$row_result_values]);
                            }
                        }
                        break;
                    case 'import_careers':

                        if ($is_update_row && $is_valid_row) {
                            $table_update = DB::select("SELECT 1 as response FROM careers WHERE id = ? AND name = ? AND abbreviation = ?",[
                                        $row[0], $row[1], $row[2]
                                    ]);
                            if($table_update==null){
                                DB::update('UPDATE careers SET name = ?, abbreviation = ? WHERE id = ?', [
                                            $row[1], $row[2], $row[0]
                                        ]);
                                array_push($row_result,["Update","La carrera con el id {$row[0]} fue actualizada.",$row_result_values]);
                            }else{
                                array_push($row_result,["Stays","La carrera con el id {$row[0]} no fue modificada.",$row_result_values]);
                            }
                        } elseif ($is_valid_row) {
                            Career::create([
                                'id' => $row[0],
                                'name' =>  $row[1],
                                'abbreviation' => $row[2],
                            ]);

                            array_push($row_result,["Correct","Una carrera con el id {$row[0]} fue registrada correctamente",$row_result_values]);
                        }else{
                            array_push($row_result,["Error","La carrera con id {$row[0]} no pudo ser registrada por: <br /> {$error}",$row_result_values]);
                        }
                        break;
                    case 'import_teachers':
                        if ($second_table=="teachers") {
                            for ($i=0;$i<sizeof($headers);$i++) {
                                $result = second_table_validation($is_valid_row, $is_update_row, $second_table, $headers[$i], $row[$i], $original_headers[$i], $error, $importation_type);
                                $is_valid_row=$result[0];
                                $error=$result[1];
                            }

                            if ($row[8]=="si") {
                                $type=5;
                            } else {
                                $type=4;
                            }

                            if ($is_update_row && $is_valid_row) {

                                $table_1 = DB::select("SELECT 1 as response FROM users WHERE university_id = ? AND first_name = ? AND last_name = ? AND second_last_name = ? AND username = ? AND email = ? AND id = ?",
                                        [ $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", $row[0]] );
                                $table_2 = DB::select("SELECT 1 as response FROM teachers WHERE career_id = ? AND user_id = ?",
                                        [ $row[7], $row[0]] );


                                if($table_1==null || $table_2==null){
                                    DB::update('UPDATE users SET university_id = ?, first_name = ?, last_name = ?, second_last_name = ?, username = ?, email = ?, password = ? WHERE id = ?', [
                                                $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", bcrypt($row[6]), $row[0]
                                            ]);
                                    DB::update('UPDATE teachers SET career_id = ? WHERE user_id = ?', [
                                                 $row[7], $row[0]
                                            ]);
                                    array_push($row_result,["Update","El tutor con el id {$row[0]} fue actualizado.",$row_result_values]);

                                }else{
                                    array_push($row_result,["Stays","El tutor con el id {$row[0]} no fue modificado.",$row_result_values]);
                                }
                            } elseif ($is_valid_row) {
                                User::create([
                                    'id' => $row[0],
                                    'university_id' =>  $row[1],
                                    'title' => "",
                                    'first_name' => $row[2],
                                    'last_name' => $row[3],
                                    'second_last_name' => $row[4],
                                    'username' => $row[5],
                                    'email' =>  $row[5]."@upv.edu.mx",
                                    'password' => bcrypt($row[6]),
                                    'type' => $type,
                                ]);

                                Teacher::create([
                                    'user_id' => $row[0],
                                    'career_id' =>  $row[7],
                                ]);

                                array_push($row_result,["Correct","Un tutor con el id {$row[0]} fue registrado correctamente",$row_result_values]);
                            }else{
                                array_push($row_result,["Error","El tutor con id {$row[0]} no pudo ser registrado por: <br /> {$error}",$row_result_values]);
                            }
                        }
                        break;
                    case 'import_classes':
                        if ($is_update_row && $is_valid_row) {
                            $table_update = DB::select("SELECT 1 as response FROM student_classes WHERE id = ? AND name = ?",[
                                        $row[0], $row[1]
                                    ]);
                            if($table_update==null){
                                DB::update('UPDATE student_classes SET name = ? WHERE id = ?', [
                                            $row[1], $row[0]
                                        ]);
                                array_push($row_result,["Update","La materia con el id {$row[0]} fue actualizada.",$row_result_values]);
                            }else{
                                array_push($row_result,["Stays","La materia con el id {$row[0]} no fue modificada.",$row_result_values]);
                            }
                        } elseif ($is_valid_row) {
                            Student_class::create([
                                'id' => $row[0],
                                'name' =>  $row[1],
                                'career_id' => 	4294967295,
                            ]);

                            array_push($row_result,["Correct","Una materia con el id {$row[0]} fue registrada correctamente",$row_result_values]);
                        }else{
                            array_push($row_result,["Error","La materia con id {$row[0]} no pudo ser registrada por: <br /> {$error}",$row_result_values]);
                        }
                        break;
                    case 'assignation':
                        if ($is_update_row && $is_valid_row) {
                            $table_update = DB::select("SELECT 1 as response FROM students WHERE user_id = ? AND tutor_user_id = ?",[
                                        $row[0], $row[1]
                                    ]);
                            if($table_update==null){
                                DB::update('UPDATE students SET tutor_user_id = ? WHERE user_id = ?', [
                                            $row[1], $row[0]
                                        ]);
                                array_push($row_result,["Update","El tutorado con el id {$row[0]} fue actualizado.",$row_result_values]);
                            }else{
                                array_push($row_result,["Stays","El tutorado con el id {$row[0]} no fue modificado.",$row_result_values]);
                            }
                        } elseif ($is_valid_row) {
                            Student::create([
                                'user_id' => $row[0],
                                'academic_situation' =>  0,
                                'career_id' => 4294967295,
                                'tutor_user_id' => $row[1]
                            ]);
                            array_push($row_result,["Correct","El tutorado con el id {$row[0]} fue registrado correctamente",$row_result_values]);
                        } else{
                            array_push($row_result,["Error","El tutorado con id {$row[0]} no pudo ser registrado por: <br /> {$error}",$row_result_values]);
                        }
                        break;
                    case 'import_users':

                        switch($row[7]){
                            case 'Salud':
                                $type=6;
                                break;
                            case 'Tutorias';
                                $type=2;
                                break;
                            case 'Psicologia':
                                $type=7;
                                break;
                        }

                        if ($is_update_row && $is_valid_row) {
                            $table_update = DB::select("SELECT 1 as response FROM users WHERE university_id = ? AND first_name = ? AND last_name = ? AND second_last_name = ? AND username = ? AND email = ? AND id = ? AND type = ?",
                                    [ $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", $row[0], $type] );

                            if($table_update==null){
                                DB::update('UPDATE users SET university_id = ?, first_name = ?, last_name = ?, second_last_name = ?, username = ?, email = ?, password = ?, type = ? WHERE id = ?', [
                                            $row[1], $row[2], $row[3], $row[4], $row[5], $row[5]."@upv.edu.mx", bcrypt($row[6]), $type, $row[0]
                                        ]);
                                array_push($row_result,["Update","El usuario con el id {$row[0]} fue actualizado.",$row_result_values]);
                            }else{
                                array_push($row_result,["Stays","El usuario con el id {$row[0]} no fue modificado.",$row_result_values]);
                            }
                        } elseif ($is_valid_row) {
                            User::create([
                                'id' => $row[0],
                                'university_id' =>  $row[1],
                                'title' => "",
                                'first_name' => $row[2],
                                'last_name' => $row[3],
                                'second_last_name' => $row[4],
                                'username' => $row[5],
                                'email' =>  $row[5]."@upv.edu.mx",
                                'password' => bcrypt($row[6]),
                                'type' => $type,
                            ]);

                            array_push($row_result,["Correct","El usuario con el id {$row[0]} fue registrado correctamente",$row_result_values]);
                        }else{
                            array_push($row_result,["Error","El usuario con id {$row[0]} no pudo ser registrado por: <br /> {$error}",$row_result_values]);
                        }
                        break;
                }

            }
            $is_uploaded="true";
        }else{
            $is_uploaded="wrong";
        }
        return view('imports.list', compact('is_uploaded','row_result','actual_importation'));
      // return response()->json(['response'=>$request->file('csv_file')]);
    }
}
//$result = second_table_validation($second_table, $headers[$i], $row[$i], $original_headers[$i], $error);

function second_table_validation($is_valid_row, $is_update_row, $second_table, $header, $row, $original_header, $error, $importation_type)
{
    $nullable_col = DB::select("SELECT 1 as response FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'SIITA_db' AND TABLE_NAME='".$second_table."' AND COLUMN_NAME= '".$header."' AND IS_NULLABLE = 'YES'");

    //Si tiene valor la columan es unica y se debe verificar su validez como unica
    if ($nullable_col==null && $row=="") {
        $is_valid_row=false;
        $error=$error."* [VALOR REQUERIDO] El valor {$row} de la columna {$original_header} necesita insertarse previamente.<br />";
    }

    if ($row!="") {
        if(!checkIfIsExcludedHeader($header,$importation_type)){
            $unique_col_sc = DB::select("SELECT 1 as response FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'SIITA_db' AND TABLE_NAME='".$second_table."' AND COLUMN_NAME = '".$header."' AND COLUMN_KEY = 'UNI'");

            //La columna es unica y se debe verificar
            if ($unique_col_sc!=null) {
                if($is_update_row){
                    //Se obtiene un registro en la tabla donde se quiera insertar
                    $registered_elements = sizeof(DB::select("SELECT 1 as response FROM ".$table." WHERE ".$header." = '".$row."'"));
                    if($registered_elements==1)
                        $is_unique=null;
                }else{
                    //Se obtiene un registro en la tabla donde se quiera insertar
                    $is_unique_sc = DB::select("SELECT 1 AS response FROM ".$second_table." WHERE ".$header." = '".$row."'");
                }
                //Se encontro un registro con valor de columna unica, por lo tanto no se realiza el registro
                if ($is_unique_sc!=null) {
                    $is_valid_row=false;
                    $error=$error."* [VALOR UNICO] El valor {$row} de la columna {$original_header} no puede repetirse en los registros.<br />";
                }
            }

            $primary_key = DB::select("SELECT 1 as response FROM information_schema.key_column_usage WHERE table_schema = 'SIITA_db' AND constraint_name = 'PRIMARY' AND table_name = '".$second_table."' AND column_name='".$header."'");
            //La columna es unica y se debe verificar
            if ($primary_key!=null) {
                $is_valid_primary = DB::select("SELECT 1 as response FROM ".$second_table." WHERE ".$header." = '".$row."'");

                //Se encontro un registro con valor de columna unica, por lo tanto no se realiza el registro
                if ($is_valid_primary!=null) {
                    $is_valid_row=false;
                    $error=$error."* [VALOR UNICO] El valor {$row} de la columna {$original_header} no puede repetirse en los registros.<br />";
                }
            }


            $foreign_key_ref_sc = DB::select("SELECT REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME FROM information_schema.key_column_usage WHERE referenced_table_name is not null AND TABLE_SCHEMA='SIITA_db' AND TABLE_NAME='".$second_table."' AND COLUMN_NAME='".$header."'");

            if ($foreign_key_ref_sc!=null) {
                $foreign_key_exists_sc = DB::select("SELECT 1 AS response FROM ".$foreign_key_ref_sc[0]->REFERENCED_TABLE_NAME." WHERE ".$foreign_key_ref_sc[0]->REFERENCED_COLUMN_NAME." = '".$row."'");

                if ($foreign_key_exists_sc==null) {
                    $is_valid_row=false;
                    $error=$error."* [FALTA REGISTRO PREVIO] El valor {$row} de la columna {$original_header} requiere que el registro de la columna {$foreign_key_ref_sc[0]->REFERENCED_COLUMN_NAME} de la tabla {$foreign_key_ref_sc[0]->REFERENCED_TABLE_NAME} sea ingresado previamente.<br />";
                }
            }
        }else{
            if($row==""){
                $is_valid_row=false;
                $error=$error."* [VALOR REQUERIDO] El valor {$row} de la columna {$original_headers} necesita insertarse previamente.<br />";
            }
        }
    }

    return [$is_valid_row,$error];
}

function checkIfIsExcludedHeader($header, $importation_type){
    switch($importation_type){
        case 'import_teachers':
            if($header=="type")
                return true;
            break;
        case 'import_users':
            if($header=="type")
                return true;
            break;
    }
    return false;
}
