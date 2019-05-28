<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Career;
use App\Student;
use App\Teacher;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ReportController extends Controller
{
    /**
     * Permite obtener los profesores de determinada carrera
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array                                Detalles del profesor
     */
    public function get_value_for_chart(Request $request)
    {
        $flag=false;
        if(!empty($request->start) && !empty($request->end)){
            $start=getMySQLDate($request->start);
            $end=getMySQLDate($request->end);
            $flag=true;
        }
        switch($request->type){
            case "1":
                //Se obtiene los detalles del profesor con el id mandado

                if($flag){
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                                   careers.abbreviation AS y,
                                   COUNT(tutorias.id) AS a
                                FROM
                                    tutorias
                                INNER JOIN users AS tutores
                                ON
                                    tutores.id = tutorias.tutor_user_id AND tutorias.date_attention >= '".$start."' AND tutorias.date_attention <= '".$end."' AND tutorias.deleted = 0
                                INNER JOIN teachers ON teachers.user_id = tutorias.tutor_user_id
                                RIGHT JOIN careers ON careers.id = teachers.career_id
                                GROUP BY
                                    careers.id,
                                    careers.abbreviation");
                    }else{
                        $result = DB::select("SELECT
                                   careers.abbreviation AS y,
                                   COUNT(asesorias.id) AS a
                                FROM
                                    asesorias
                                INNER JOIN users AS tutores
                                ON
                                    tutores.id = asesorias.teacher_user_id AND asesorias.date_attention >= '".$start."' AND asesorias.date_attention <= '".$end."' AND asesorias.deleted = 0
                                INNER JOIN teachers ON teachers.user_id = asesorias.teacher_user_id
                                RIGHT JOIN careers ON careers.id = teachers.career_id
                                GROUP BY
                                    careers.id,
                                    careers.abbreviation");
                    }

                    break;
                }else{
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                                   careers.abbreviation AS y,
                                   COUNT(tutorias.id) AS a
                                FROM
                                    tutorias
                                INNER JOIN users AS tutores
                                ON
                                    tutores.id = tutorias.tutor_user_id AND tutorias.deleted = 0
                                INNER JOIN teachers ON teachers.user_id = tutorias.tutor_user_id
                                RIGHT JOIN careers ON careers.id = teachers.career_id
                                GROUP BY
                                    careers.id,
                                    careers.abbreviation");
                        break;
                    }else{
                        $result = DB::select("SELECT
                                   careers.abbreviation AS y,
                                   COUNT(asesorias.id) AS a
                                FROM
                                    asesorias
                                INNER JOIN users AS tutores
                                ON
                                    tutores.id = asesorias.teacher_user_id AND asesorias.deleted = 0
                                INNER JOIN teachers ON teachers.user_id = asesorias.teacher_user_id
                                RIGHT JOIN careers ON careers.id = teachers.career_id
                                GROUP BY
                                    careers.id,
                                    careers.abbreviation");
                        break;
                    }

                }
            case "2":
                if($flag){
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                              	attention_problems.name as y,
                                COUNT(tutorias.id) as a
                            FROM
                                tutorias
                            RIGHT JOIN attention_problems ON attention_problems.id = tutorias.id_attention_problems AND tutorias.date_attention >= '".$start."' AND tutorias.date_attention <= '".$end."' AND tutorias.deleted = 0
                            GROUP BY attention_problems.id, attention_problems.name");
                    }else{
                        $result = DB::select("SELECT
                                asesorias.subject as y,
                                COUNT(*) as a
                            FROM
                                asesorias
                            WHERE asesorias.deleted=0 AND asesorias.date_attention >= '".$start."' AND asesorias.date_attention <= '".$end."'
                            GROUP BY asesorias.subject");
                    }
                }
                else{
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                              	attention_problems.name as y,
                                COUNT(tutorias.id) as a
                            FROM
                                tutorias
                            RIGHT JOIN attention_problems ON attention_problems.id = tutorias.id_attention_problems AND tutorias.deleted = 0
                            GROUP BY attention_problems.id, attention_problems.name");
                    }else{
                        $result = DB::select("SELECT
                                asesorias.subject as y,
                                COUNT(*) as a
                            FROM
                                asesorias
                            WHERE asesorias.deleted=0
                            GROUP BY asesorias.subject");
                    }
                }
                break;
            case "3":
                if($flag){
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                              	type_of_attentions.name as y,
                                COUNT(tutorias.id) as a
                            FROM
                                tutorias
                            RIGHT JOIN type_of_attentions ON type_of_attentions.id = tutorias.id_type_of_attention AND tutorias.date_attention >= '".$start."' AND tutorias.date_attention <= '".$end."' AND tutorias.deleted = 0
                            GROUP BY type_of_attentions.id, type_of_attentions.name");
                    }else{
                        $result = DB::select("SELECT
                            student_classes.name AS y,
                                COUNT(asesorias.id) AS a
                            FROM
                                asesorias
                            INNER JOIN
                            	student_classes ON student_classes.id=asesorias.class_id AND asesorias.date_attention >= '".$start."' AND asesorias.date_attention <= '".$end."' AND asesorias.deleted = 0
                            GROUP BY
                                asesorias.class_id, student_classes.name");
                    }
                    break;
                }else{
                    if($request->report_of=="2"){
                        $result = DB::select("SELECT
                              	type_of_attentions.name as y,
                                COUNT(tutorias.id) as a
                            FROM
                                tutorias
                            RIGHT JOIN type_of_attentions ON type_of_attentions.id = tutorias.id_type_of_attention AND tutorias.deleted = 0
                            GROUP BY type_of_attentions.id, type_of_attentions.name");
                    }else{
                        $result = DB::select("SELECT
                            student_classes.name AS y,
                                COUNT(asesorias.id) AS a
                            FROM
                                asesorias
                            INNER JOIN
                            	student_classes ON student_classes.id=asesorias.class_id
                            WHERE
                                asesorias.deleted = 0
                            GROUP BY
                                asesorias.class_id, student_classes.name");
                    }
                    break;
                }
        }
        return response()->json(['response'=>$result]);
    }

    /**
     * Se muestra la vista de reportes de tutorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTutorias()
    {



        if(Auth::user()->type==4 || Auth::user()->type==5)
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99 AND id = ".Auth::user()->id);
        else
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99");

        //Consulta para traer a los profesores y tutores

        //Consulta para traer a los estudiantes
        $students = DB::select("SELECT * FROM `users` WHERE type = 3");

        //Consulta de carreras a la BD excluyendo la carrera del sistema
        $careers = DB::table('careers')->where('id', '!=', '4294967295')->get();

        //Consulta para traer a los tipos de atencion o canalizacion
        $types_of_attentions = DB::select("SELECT * FROM `type_of_attentions` WHERE deleted = 0");

        //Consulta para traer a los tipos de atencion o canalizacion
        $attention_problems = DB::select("SELECT * FROM attention_problems");

        //Retorna a la vista de los reportes de tutorias
        return view('reports.tutorias')
          ->with('teachers', $teachers)
          ->with('students', $students)
          ->with('careers', $careers)
          ->with('types_of_attentions', $types_of_attentions)
          ->with('attention_problems', $attention_problems);
    }

    public function indexAnalytics()
    {
        return view('reports.analytics');
    }
    public function indexJtgTutorias()
    {
        if(Auth::user()->type==4 || Auth::user()->type==5)
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99 AND id = ".Auth::user()->id);
        else
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99");

        //Consulta para traer a los estudiantes
        $students = DB::select("SELECT * FROM `users` WHERE type = 3");

        //Consulta de carreras a la BD excluyendo la carrera del sistema
        $careers = DB::table('careers')->where('id', '!=', '4294967295')->get();


        //Retorna a la vista de los reportes de tutorias
        return view('reports.jtg_tutorias')
          ->with('teachers', $teachers)
          ->with('careers', $careers)
          ->with('students', $students);
    }

    public function indexSolicitudes()
    {
        if(Auth::user()->type==4 || Auth::user()->type==5)
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99 AND id = ".Auth::user()->id);
        else
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99");

        //Consulta para traer a los profesores y tutores

        //Consulta para traer a los estudiantes
        $students = DB::select("SELECT * FROM `users` WHERE type = 3");

        //Consulta de carreras a la BD excluyendo la carrera del sistema
        $careers = DB::table('careers')->where('id', '!=', '4294967295')->get();

        //Consulta para traer a los tipos de atencion o canalizacion
        $uses_salud = DB::select("SELECT * FROM `type_of_attentions` WHERE id = 2 AND deleted = 0");

        $uses_psicologia = DB::select("SELECT * FROM `type_of_attentions` WHERE id = 2 AND deleted = 0");

        //Consulta para traer a los tipos de atencion o canalizacion de tipo 2
        $use_salud = DB::select("SELECT * FROM attention_problems WHERE type_of_attention_id = 2 AND name = 'Salud' AND deleted = 0");

        $use_psicologia = DB::select("SELECT * FROM attention_problems WHERE type_of_attention_id = 2 AND name = 'Psicología' AND deleted = 0");

        //Retorna a la vista de los reportes de tutorias
        return view('reports.solicitudes')
          ->with('teachers', $teachers)
          ->with('students', $students)
          ->with('careers', $careers)
          ->with('uses_salud', $uses_salud)
          ->with('uses_psicologia', $uses_psicologia)
          ->with('use_salud', $use_salud)
          ->with('use_psicologia', $use_psicologia);
    }

    /**
     * Se muestra la vista de reportes de asesorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAsesorias()
    {
        if(Auth::user()->type==4 || Auth::user()->type==5)
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99 AND id = ".Auth::user()->id);
        else
            $teachers = DB::select("SELECT * FROM `users` WHERE type != 1 AND type != 2 AND type != 3 AND type != 6 AND type != 7 AND type != 99");

        //Consulta para traer a los estudiantes
        $students = DB::select("SELECT * FROM `users` WHERE type = 3");

        //Consulta para traer las clases de los estudiantes
        $students_classes = DB::select("SELECT * FROM `student_classes`");

        //Consulta de carreras a la BD excluyendo la carrera del sistema
        $careers = DB::table('careers')->where('id', '!=', '4294967295')->get();

        //Retorna a la vista de los reportes de asesorias
        return view('reports.asesorias')
          ->with('teachers', $teachers)
          ->with('students', $students)
          ->with('students_classes', $students_classes)
          ->with('careers', $careers)
          ->with('title', 'Listado de Carreras');
    }


    /**
    * Obtener las asesoiras de acuerdo a los filtros
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function get_asesoria_report(Request $request)
    {
        $query = DB::table('asesorias')
         ->join('asesorias_students as astd', 'astd.id_asesoria', '=', 'asesorias.id')
         ->join('users as student', 'astd.student_user_id', '=', 'student.id')
         ->join('users as professor', 'asesorias.teacher_user_id', '=', 'professor.id')
         ->join('student_classes as stdcl', 'stdcl.id', '=', 'asesorias.class_id')
         ->join('students as std', 'std.user_id', '=', 'student.id')
         ->join('careers', 'careers.id', '=', 'std.career_id')
         ->select(
           'asesorias.*',
            'asesorias.id as id_asesoria',
            'professor.title as professorTitle',
            'professor.first_name as professorFirstName',
            'professor.last_name as professorLastName',
            'professor.second_last_name as professorSecondLastName',
            'careers.abbreviation as name',
            'stdcl.name as materiaName',
            'asesorias.type as type_asesoria',
            'astd.student_user_id',
             'student.*'
         );

        if (!is_null($request->professor_id)) { //Filtrar por profesor
            $query->where('asesorias.teacher_user_id', '=', $request->professor_id);
        }

        if (!is_null($request->student_id)) { //Filtrar por estudiante
            $query->where('astd.student_user_id', '=', $request->student_id);
        }

        if (!is_null($request->student_id)) {
            $query->where('astd.student_user_id', '=', $request->student_id);
        }

        if (!is_null($request->career_id)) {  //Filtrar por carrera
            $query->where('std.career_id', '=', $request->career_id);
        }

        if (!is_null($request->class_id)) { //Filtrar por clase
            $query->where('asesorias.class_id', '=', $request->class_id);
        }

        if (!is_null($request->asesoria_id)) { //Filtrar por el tipo de asesoria
            $query->where('asesorias.type', '=', $request->asesoria_id);
        }

        if (!is_null($request->asesoria_state) && ($request->asesoria_state != -1)) { //Filtrar por el tipo de estado de asesoria
            $query->where('asesorias.state', '=', $request->asesoria_state);
        }

        if (!is_null($request->start) && !is_null($request->end)) { //Filtrar de acuerdo a un rango de fechas
          if ($request->start == $request->end) {
            $query->whereDate('asesorias.date_attention', getMySQLDate($request->end));
          }else{
            $query->whereBetween('asesorias.date_attention', [getMySQLDate($request->start), getMySQLDate($request->end)]);
          }
        }

        if(Auth::user()->type==4 || Auth::user()->type==5){
            $query->where('professor.id','=',Auth::user()->id);
        }

        //Retorna la consulta
        $result = $query->orderBy("id_asesoria")->get();
        return response()->json(['response'=>$result]);
    }

    /**
     * Obtiene los reportes de tutorias
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_tutoria_report(Request $request)
    {
        $query= DB::table("tutorias")
          ->join('users as teacher_user', 'tutorias.tutor_user_id', 'teacher_user.id')
          ->join('teachers as teacher', 'tutorias.tutor_user_id', '=', 'teacher.user_id')
          ->join('tutorias_students', 'tutorias_students.tutoria_id', '=', 'tutorias.id')
          ->join('users as student', 'tutorias_students.student_user_id', '=', 'student.id')
          ->join('type_of_attentions', 'tutorias.id_type_of_attention', '=', 'type_of_attentions.id')
          ->join('attention_problems', 'tutorias.id_attention_problems', '=', 'attention_problems.id')
          ->join('careers', 'teacher.career_id', '=', 'careers.id')
          ->select(
              'tutorias.id as id_tutoria',
              'teacher_user.*',
              'teacher.*',
              'student.*',
              'type_of_attentions.*',
              'attention_problems.*',
              'attention_problems.name as attention_name',
              'careers.*',
              'careers.abbreviation as careerName',
              'teacher_user.title as teacherTitle',
              'teacher_user.first_name as teacher_first_name',
              'teacher_user.last_name as teacher_last_name',
              'student.second_last_name as student_second_last_name',
              'student.first_name as student_first_name',
              'student.last_name as student_last_name',
              'teacher_user.second_last_name as teacher_second_last_name',
              'careers.name as career_name',
              'type_of_attentions.name as canalization_name',
              'tutorias.*',
              'tutorias_students.academic_situation as academic_situation',
              'tutorias_students.*'
          );

        if (!is_null($request->professor_id)) { //FIltra por el profesor
            $query->where('teacher_user.id', '=', $request->professor_id);
        }
        if (!is_null($request->student_id)) { //FIltra por el alumno
            $query->where('tutorias_students.student_user_id', '=', $request->student_id);
        }
        if (!is_null($request->attention)) { //FIltra por el tipo de atencion
            $query->where('type_of_attentions.id', '=', $request->attention);
        }
        if (!is_null($request->problem)) { //FIltra por el problema
            $query->where('attention_problems.id', '=', $request->problem);
        }
        if (!is_null($request->academic_situation) && ($request->academic_situation != -1)) { //Filtra por el tipo de situacion academica
            $query->where('tutorias_students.academic_situation', '=', $request->academic_situation);
        }
        if (!is_null($request->tutoria_state) && ($request->tutoria_state != -1)) { //Filtra por el estado de la tutoria
            $query->where('tutorias.state', '=', $request->tutoria_state);
        }
        if (!is_null($request->tutoria_type)) { //Filtra por el tipo de tutoria
            $query->where('tutorias.type_of_tutoria', '=', $request->tutoria_type);
        }
        if (!is_null($request->career_id)) { //FIltra por la carrera
            $query->where('teacher.career_id', '=', $request->career_id);
        }
        if (!is_null($request->start) && !is_null($request->end)) { //Filtra por el rango de fechas
            if ($request->start == $request->end) {
              $query->whereDate('tutorias.date_attention', getMySQLDate($request->end));
            }else{
              $query->whereBetween('tutorias.date_attention', [getMySQLDate($request->start), getMySQLDate($request->end)]);
            }
        }

        if(Auth::user()->type==4 || Auth::user()->type==5){
            $query->where('teacher_user.id','=',Auth::user()->id);
        }

        //Retorna la consulta de los reportes
        $result = $query->orderBy("id_tutoria")->get();

        return response()->json(['response'=>$result]);
    }

    public function get_solicitud_report(Request $request)
    {
        $query= DB::table("tutorias")
          ->join('users as teacher_user', 'tutorias.tutor_user_id', 'teacher_user.id')
          ->join('teachers as teacher', 'tutorias.tutor_user_id', '=', 'teacher.user_id')
          ->join('tutorias_students', 'tutorias_students.tutoria_id', '=', 'tutorias.id')
          ->join('users as student', 'tutorias_students.student_user_id', '=', 'student.id')
          ->join('type_of_attentions', 'tutorias.id_type_of_attention', '=', 'type_of_attentions.id')
          ->join('attention_problems', 'tutorias.id_attention_problems', '=', 'attention_problems.id')
          ->join('careers', 'teacher.career_id', '=', 'careers.id')
          ->select(
              'tutorias.id as id_tutoria',
              'teacher_user.*',
              'teacher.*',
              'student.*',
              'type_of_attentions.*',
              'attention_problems.*',
              'careers.*',
              'careers.abbreviation as careerName',
              'teacher_user.title as teacherTitle',
              'teacher_user.first_name as teacher_first_name',
              'teacher_user.last_name as teacher_last_name',
              'student.second_last_name as student_second_last_name',
              'student.first_name as student_first_name',
              'student.last_name as student_last_name',
              'teacher_user.second_last_name as teacher_second_last_name',
              'careers.name as career_name',
              'type_of_attentions.name as canalization_name',
              'tutorias.*',
              'tutorias_students.academic_situation as academic_situation',
              'tutorias_students.*'
          );

        if (!is_null($request->professor_id)) { //FIltra por el profesor
            $query->where('teacher_user.id', '=', $request->professor_id);
        }
        if (!is_null($request->student_id)) { //FIltra por el alumno
            $query->where('tutorias_students.student_user_id', '=', $request->student_id);
        }
        if (!is_null($request->attention)) { //FIltra por el tipo de atencion
            $query->where('type_of_attentions.id', '=', $request->attention);
        }
        if (!is_null($request->problem)) { //FIltra por el problema
            $query->where('attention_problems.id', '=', $request->problem);
        }
        if (!is_null($request->academic_situation) && ($request->academic_situation != -1)) { //Filtra por el tipo de situacion academica
            $query->where('tutorias_students.academic_situation', '=', $request->academic_situation);
        }
        if (!is_null($request->tutoria_state) && ($request->tutoria_state != -1)) { //Filtra por el estado de la tutoria
            $query->where('tutorias.state', '=', $request->tutoria_state);
        }
        if (!is_null($request->canalization_state) && ($request->canalization_state != -1)) { //Filtra por el estado de la canalizacion
            $query->where('tutorias.canalization_state', '=', $request->canalization_state);
        }
        if (!is_null($request->tutoria_type)) { //Filtra por el tipo de tutoria
            $query->where('tutorias.type_of_tutoria', '=', $request->tutoria_type);
        }
        if (!is_null($request->career_id)) { //FIltra por la carrera
            $query->where('teacher.career_id', '=', $request->career_id);
        }
        if (!is_null($request->start) && !is_null($request->end)) { //Filtra por el rango de fechas
            if ($request->start == $request->end) {
              $query->whereDate('tutorias.date_attention', getMySQLDate($request->end));
            }else{
              $query->whereBetween('tutorias.date_attention', [getMySQLDate($request->start), getMySQLDate($request->end)]);
            }
        }

        if(Auth::user()->type==4 || Auth::user()->type==5){
            $query->where('teacher_user.id','=',Auth::user()->id);
        }

        //Retorna la consulta de los reportes
        $result = $query->orderBy("id_tutoria")->get();
        return response()->json(['response'=>$result]);
    }


    /**
     * Obtiene los reportes de tutorias
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_jtg_tutoria_report(Request $request)
    {

        $query= DB::table("jtg_tutorias")
          ->join('users as teacher_user', 'jtg_tutorias.tutor_user_id', 'teacher_user.id')
          ->join('teachers as teacher', 'jtg_tutorias.tutor_user_id', '=', 'teacher.user_id')
          ->join('jtg_tutoria_students', 'jtg_tutoria_students.jtg_tutoria_id', '=', 'jtg_tutorias.id')
          ->join('users as student', 'jtg_tutoria_students.student_user_id', '=', 'student.id')
          ->join('careers', 'teacher.career_id', '=', 'careers.id')
          ->select(
              'jtg_tutorias.id as id_tutoria',
              'teacher_user.*',
              'teacher.*',
              'student.*',
              'careers.*',
              'careers.abbreviation as careerName',
              'teacher_user.title as teacherTitle',
              'teacher_user.first_name as teacher_first_name',
              'teacher_user.last_name as teacher_last_name',
              'student.second_last_name as student_second_last_name',
              'student.first_name as student_first_name',
              'student.last_name as student_last_name',
              'teacher_user.second_last_name as teacher_second_last_name',
              'careers.name as career_name',
              'jtg_tutorias.*',
              'jtg_tutoria_students.*'
          );

        if (!is_null($request->professor_id)) { //FIltra por el profesor
            $query->where('teacher_user.id', '=', $request->professor_id);
        }
        if (!is_null($request->student_id)) { //FIltra por el alumno
            $query->where('jtg_tutoria_students.student_user_id', '=', $request->student_id);
        }
        if (!is_null($request->tutoria_state) && ($request->tutoria_state != -1)) { //Filtra por el estado de la tutoria
            $query->where('jtg_tutorias.state', '=', $request->tutoria_state);
        }
        if (!is_null($request->career_id)) { //FIltra por la carrera
            $query->where('teacher.career_id', '=', $request->career_id);
        }
        if (!is_null($request->start) && !is_null($request->end)) { //Filtra por el rango de fechas
            if ($request->start == $request->end) {
              $query->whereDate('jtg_tutorias.date_attention', getMySQLDate($request->end));
            }else{
              $query->whereBetween('jtg_tutorias.date_attention', [getMySQLDate($request->start), getMySQLDate($request->end)]);
            }
        }
        if (!is_null($request->term)) {
            $query->where('term', 'like', '%' . $request->term . '%')->get();
        }
        if (!is_null($request->place)) {
            $query->where('place', 'like', '%' . $request->place . '%')->get();
        }

        if(Auth::user()->type==4 || Auth::user()->type==5){
            $query->where('teacher_user.id','=',Auth::user()->id);
        }


        //Retorna la consulta de los reportes
        $result = $query->orderBy("id_tutoria")->get();
        return response()->json(['response'=>$result]);
    }
}
