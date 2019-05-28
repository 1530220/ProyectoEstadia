<?php

namespace App\Http\Controllers;

use Alert;
use App\Tutoria;
use App\Student;
use App\Http\Requests;
use App\AttentionProblem;
use App\Type_of_attention;
use App\Tutorias_students;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SolicitudController extends Controller
{
  /**
   * Se muestra la lista de las solicitudes registradas en el sistema.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if (Auth::user()->type==3){
          //Consulta de usuarios a la BD
          $tutorias = DB::table('tutorias')
              ->join('users as tutor', 'tutorias.tutor_user_id', 'tutor.id')
              ->join('teachers as teacher', 'tutorias.tutor_user_id','=','teacher.user_id')
              ->join('type_of_attentions', 'tutorias.id_type_of_attention', '=', 'type_of_attentions.id')
              ->join('careers','teacher.career_id','=','careers.id')
              ->leftjoin('tutorias_students','tutorias_students.tutoria_id','=','tutorias.id')
              ->select(
                  'careers.abbreviation as careerAbbreviation',
                  'careers.name as careerName',
                  'tutor.university_id as tutorUniversityId',
                  'tutor.title as userTitle',
                  'tutor.first_name as userFirstName',
                  'tutor.last_name as userLastName',
                  'tutor.second_last_name as userSecondName',
                  'tutorias.*',
                  'type_of_attentions.name as typeOfAttentionName'
              );
      }else{
          $tutorias = DB::table('tutorias')
              ->join('users as tutor', 'tutorias.tutor_user_id', 'tutor.id')
              ->join('teachers as teacher', 'tutorias.tutor_user_id','=','teacher.user_id')
              ->join('type_of_attentions', 'tutorias.id_type_of_attention', '=', 'type_of_attentions.id')
              ->join('careers','teacher.career_id','=','careers.id')
              ->select(
                  'careers.abbreviation as careerAbbreviation',
                  'careers.name as careerName',
                  'tutor.university_id as tutorUniversityId',
                  'tutor.title as userTitle',
                  'tutor.first_name as userFirstName',
                  'tutor.last_name as userLastName',
                  'tutor.second_last_name as userSecondName',
                  'tutorias.*',
                  'tutorias.deleted as tutoriaDeleted',
                  'type_of_attentions.name as typeOfAttentionName'
              );
      }


      //Consulta de usuarios a la BD
      $tutorias_students = DB::table('tutorias')
          ->join('users as tutor', 'tutorias.tutor_user_id', 'tutor.id')
          ->join('tutorias_students', 'tutorias_students.tutoria_id','=','tutorias.id')
          ->join('users as students', 'tutorias_students.student_user_id','=','students.id')
          ->select(
              'tutorias.id as tutoria_id',
              'students.*',
              'tutorias_students.student_user_id'
          );

      if (Auth::user()->type==1) {
          $tutorias=$tutorias->get();
          $tutorias_students=$tutorias_students->get();
      } else if(Auth::user()->type==2){
          $tutorias=$tutorias->where('tutorias.deleted','=','0')->get();
          $tutorias_students=$tutorias_students->where('tutorias.deleted','=',0)->get();
      } else if (Auth::user()->type==3) {
          $tutorias=$tutorias->where('tutorias_students.student_user_id', '=', Auth::user()->id)->where('tutorias.deleted','=',0)
              ->groupBy('tutorias.id','date_attention','tutorias.scheduled_day_hour_id','tutorias.observations','tutorias.state',
                  'tutorias.canalization_state','tutorias.file_url','tutorias.id_type_of_attention','tutorias.id_attention_problems','tutorias.tutor_user_id',
                  'tutorias.type_of_tutoria','tutorias.deleted','tutorias.created_at','tutorias.updated_at','careers.abbreviation','careers.name',
                  'tutor.university_id','tutor.title','tutor.first_name','tutor.last_name','tutor.second_last_name','type_of_attentions.name')->get();
          $tutorias_students=$tutorias_students->where('tutorias.deleted','=',0)->get();
      } else if (Auth::user()->type==5) {
          $tutorias=$tutorias->where('tutorias.tutor_user_id', '=', Auth::user()->id)->where('tutorias.deleted','=',0)->get();
          $tutorias_students=$tutorias_students->where('tutorias.tutor_user_id', '=', Auth::user()->id)->where('tutorias.deleted','=',0)->get();
      } else if (Auth::user()->type==6) {
          $tutorias=$tutorias->where('tutorias.id_attention_problems', '=', 7)/*->where('tutorias.state', '=', 1)->where('tutorias.canalization_state', '=', 0)*/->where('tutorias.deleted','=',0)->get();
          $tutorias_students=$tutorias_students/*->where('tutorias.state', '=', 1)->where('tutorias.canalization_state', '=', 0)*/->where('tutorias.deleted','=',0)->get();
      } else if (Auth::user()->type==7) {
          $tutorias=$tutorias->where('tutorias.id_attention_problems', '=', 8)/*->where('tutorias.state', '=', 1)->where('tutorias.canalization_state', '=', 0)*/->where('tutorias.deleted','=',0)->get();
          $tutorias_students=$tutorias_students/*->where('tutorias.state', '=', 1)->where('tutorias.canalization_state', '=', 0)*/->where('tutorias.deleted','=',0)->get();
      }

      for ($i=0;$i<sizeof($tutorias);$i++) {
          setlocale(LC_ALL, "es_MX.utf8", 'Spanish_Spain', 'Spanish');
          $tutorias[$i]->date_attention=iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B del %Y", strtotime($tutorias[$i]->date_attention)));
      }


      return view('solicitudes.list')
                ->with('tutorias', $tutorias)
                ->with('tutorias_students', $tutorias_students)
                ->with('title', 'Listado de Solicitudes');
  }
}
