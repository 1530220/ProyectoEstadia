<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\User;
use Alert;
use App\Career;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Helpers\DeleteHelper;

class AssignationController extends Controller
{
  /**
   * Lista de tutores y tutorados.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //Obtener los estudiantes junto con sus tutores
      $students = DB::table('students')
          ->join('users', 'students.user_id', '=', 'users.id')
          ->join('careers', 'careers.id', '=', 'students.career_id')
          ->join('users as tutors', 'students.tutor_user_id', '=', 'tutors.id')
          ->select(
            'users.id as student_user_id',
            'users.first_name as userFirstName',
            'users.last_name as userLastName',
            'users.second_last_name as userSecondName',
            'students.*',
            'careers.name as careerName',
            'careers.abbreviation as careerAb',
            'careers.id as career_id',
            'users.university_id as university_id',
            'users.id as id',
            'users.image_url as image',
            'users.deleted as deleted',
            'tutors.university_id as tutorUniversityId',
            'tutors.title as tutorTitle',
            'tutors.first_name as tutorFirstName',
            'tutors.last_name as tutorLastName',
            'tutors.second_last_name as tutorSecondName',
            'careers.id as career_id')
          ->where('users.deleted','!=','1')
          ->get();


        $teachers = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select(
              'users.*',
              'users.id as user_id',
              'users.deleted as deleted'
             )
            ->where('users.type', '=', 5)
        ->get();
      //Redirrecciona a la vista del listado de tutorados
      return view('assignations.list')
          ->with('students', $students)
          ->with('teachers', $teachers)
          ->with('title', 'Asignaciones');
  }

  /**
   * realizar una asignacion.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //Consulta para traer todas los tutores registrados
    $tutors = DB::table('teachers')
        ->join('users', 'users.id', '=', 'teachers.user_id')
        ->select('users.*','users.id as user_id')
        ->where('users.type', '=', 5)
        ->get();
    //Consulta para traer a los estudiantes
    $students = DB::table('students')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->select('users.*')
        ->where('users.type', '=', 3)
        ->get();

    return view('assignations.create', compact('tutors', 'students'));
  }

  /**
   * Realizar un cambio o reasignacion de tutor.
   *
   * @param  \App\Teacher  $tutor
   * @return \Illuminate\Http\Response
   */
  public function reassignation($id)
  {

      //Se realiza una consulta para obtener los datos del tutor, de acuerdo a parametro
      $student = DB::table('students')
          ->join('users', 'users.id', '=', 'students.user_id')
          ->join('users as tutor', 'tutor.id', '=', 'students.tutor_user_id')
          ->select('users.*','tutor.first_name as tutor_first_name','tutor.last_name as tutor_last_name','tutor.second_last_name as tutor_second_last_name','tutor.id as tutor_user_id','students.career_id as career_id')
          ->where('users.id', '=', $id)
          ->get();

      //Si el alumno no tiene tutor, entonces se trae a todos los tutores registrados
      if ($student[0]->career_id == 4294967295){
        $tutors = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->select('users.*','users.id as user_id')
            ->where('users.type', '=', 5)
            ->where('users.id', '!=', $student[0]->tutor_user_id)
            ->get();
      } else {
        //Consulta para traer todas los tutores registrados con la misma carrera que el alumno
        $tutors = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->select('users.*','users.id as user_id')
            ->where('users.type', '=', 5)
            ->where('users.id', '!=', $student[0]->tutor_user_id)
            ->where('teachers.career_id', '=', $student[0]->career_id)
            ->get();
      }

      $siita = DB::table('users')
        ->select('users.*','users.id as user_id')
        ->where('users.id','=',4294967295)
        ->first();

    $tutors->push($siita);


      //Redirecciona a la vista de edicion de tutor
      return view('assignations.reassignation', ['student' => $student], compact('tutors','student'));
  }

  /**
   * Almacenamiento de las asignaciones
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

      //Validaciones
      $data = request()->validate([
        'students_sel' => 'required',
      ],[
        'students_sel.required' => ' * Seleccione al menos a un estudiante.',
      ]);

      //Verifica el tamaño de la reasignacion, es decir, cuantos alumnos son
      if (sizeof($request->students_sel) == 1) {

        //SI es 1, entonces se actualiza el valor del tutor por la del nuevo
        DB::update('UPDATE students SET tutor_user_id = ? WHERE user_id = ?', [$request->tutor, $request->students_sel[0]]);
        //Mensaje de exito
        Alert::success('Exitosamente', 'Asignación Completada');
        //Insert en la tabla de log para que quede registrado el movimiento
        insertToLog(Auth::user()->id, 'added', $request->students_sel[0], "asignación");
        //Redirecciona a ls lista de tutorados
        return redirect()->route('assignations.list');

      } else if (sizeof($request->students_sel) > 1) {

        //Si son varios, entonces se realiza la actualizacion dentro de un ciclo de acuerdo a la cantidad de alumnos
        for ($i=0; $i < sizeof($request->students_sel); $i++) {
          DB::update('UPDATE students SET tutor_user_id = ? WHERE user_id = ?', [$request->tutor, $request->students_sel[$i]]);
          insertToLog(Auth::user()->id, 'added', $request->students_sel[$i], "asignación");
        }
        //Mensaje de exito
        Alert::success('Exitosamente', 'Asignación Completada');
        //Redireccion a la lista de tutorados
        return redirect()->route('assignations.list');
      }
  }

  /**
   * Cambio de tutor
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function changeTutor(Request $request)
  {
      //Se obtienen los valores de los campos
      $id = Input::get('id');
      $id_old_tutor = Input::get('id_old_tutor');
      $tutor_user_id = Input::get('tutor_user_id');

      //Se realiza una consulta para actualizar el tipo de usuario, ahora pasa de ser profesor a Tutor
      $reasignar = DB::update('UPDATE `students` SET `tutor_user_id` = ? WHERE `user_id` = ?', [$tutor_user_id, $id]);
      //Si se cumple
      if ($reasignar) {
        //Mensaje de exito
        Alert::success('Reasignación Completada', 'Cambio Registrado');
        return redirect()->route('tutors.tutorados', $id_old_tutor);
      } else { //Sino se cumple
        //Mensaje de error
        Alert::error('No se realizó la reasignación', 'Error');
        return redirect()->route('tutors.tutorados', $id_old_tutor);
      }

  }

  /**
   * Permite obtener los alumnos que son tutorados del profesor mandado
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array                                Detalles del profesor
   */
  public function getStudents(Request $request)
  {
      //obtener la carrera del tutor
      $tutor_career_id = DB::table('teachers')
          ->select('teachers.career_id as career_id','teachers.*')
          ->where('teachers.user_id', '=', $request->id)
          ->get();

      //Se obtiene los detalles del profesor con el id mandado
      $tutorados = DB::table('users')
          ->join('students', 'students.user_id', '=', 'users.id')
          ->select(
              'users.email',
              'users.id',
              'users.university_id',
              'users.first_name',
              'users.last_name',
              'users.second_last_name',
              'users.image_url'
          )
          ->where('students.tutor_user_id', '=', 4294967295)
          ->get();

      //Se retorna una respuesta codificada con JSON
      return response()->json(['response'=>$tutorados]);
  }

  /**
   * Permite obtener los tipos problemas que le pertenecen al tipo de atencion mandado
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array                                Detalles del profesor
   */
  public function getProblemsOfTypeAttention(Request $request)
  {

      //Se obtiene los detalles del profesor con el id mandado
      $attention_problems = DB::table('attention_problems')
          ->select('attention_problems.id', 'attention_problems.name')
          ->where('attention_problems.type_of_attention_id', '=', $request->id)
          ->get();

      //Se retorna una respuesta codificada con JSON
      return response()->json(['response'=>$attention_problems]);
  }

  /**
   * Permite obtener los detalles del alumno
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array                                Detalles del profesor
   */
  public function getStudentDetails(Request $request)
  {
      //Se obtiene los detalles del profesor con el id mandado
      $student = DB::table('users')
          ->join('students','students.user_id','=','users.id')
          ->select('users.email','users.id','users.university_id','users.first_name','users.last_name',
              'users.second_last_name','users.image_url', 'students.academic_situation')
          ->where('users.id', '=', $request->id)
          ->first();

      //Se retorna una respuesta codificada con JSON
      return response()->json(['response'=>$student]);
  }

  public function removeTutor($id){

      $removed = DB::update('UPDATE `students` SET `tutor_user_id` = ? WHERE `user_id` = ?', [4294967295, $id]);

      //Obtener los estudiantes junto con sus tutores
      $students = DB::table('students')
        ->join('users', 'students.user_id', '=', 'users.id')
        ->join('careers', 'careers.id', '=', 'students.career_id')
        ->join('users as tutors', 'students.tutor_user_id', '=', 'tutors.id')
        ->select(
          'users.id as student_user_id',
          'users.first_name as userFirstName',
          'users.last_name as userLastName',
          'users.second_last_name as userSecondName',
          'students.*',
          'careers.name as careerName',
          'careers.abbreviation as careerAb',
          'careers.id as career_id',
          'users.university_id as university_id',
          'users.id as id',
          'users.image_url as image',
          'users.deleted as deleted',
          'tutors.university_id as tutorUniversityId',
          'tutors.title as tutorTitle',
          'tutors.first_name as tutorFirstName',
          'tutors.last_name as tutorLastName',
          'tutors.second_last_name as tutorSecondName',
          'careers.id as career_id'
        )
        ->where('users.deleted', '!=', '1')
        ->get();


      $teachers = DB::table('teachers')
          ->join('users', 'teachers.user_id', '=', 'users.id')
          ->select(
            'users.*',
            'users.id as user_id',
            'users.deleted as deleted'
           )
          ->where('users.type', '=', 5)
      ->get();


    if($removed){
        Alert::success('Eliminacion exitosa', 'Tutor Eliminado');
    }else{
        Alert::error('No se realizo la eliminacion del tutor', 'Tutor No Cambiado');
    }
      //Redirrecciona a la vista del listado de tutorados
      return view('assignations.list')
        ->with('students', $students)
        ->with('teachers', $teachers)
        ->with('title', 'Asignaciones');
  }


}
