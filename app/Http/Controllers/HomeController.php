<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Career;
use App\Student;
use App\User;
use App\Skills;
use App\company;
use Alert;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Funcion para mostrar los datos del dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      switch (Auth::user()->type) {
        case 1: //INFORMACION DASHBOARD PARA ADMINISTRADORES
            $user_id = 4294967295;
            $careers =  DB::table('siita_db.careers')->count();
            //$students = Student::all()->count();
            $students = DB::table('siita_db.students')->count();
            $tutores = DB::table('siita_db.users')->where('type','=','5')->count();
            //$users = DB::table('siita.users')->count();
            $sessions = DB::table('log')->where('action', '!=', '3')->where('action', '!=', '4')->where('action', '!=', '5')->where('action', '!=', '6')->count();
            $movements = DB::table('log')->where('action', '!=', '1')->where('action', '!=', '2')->count();
            $skills = Skills::all()->count();
            $competences = DB::table('competences')->count();
            $medals = DB::table('medals')->count();
            $companies = DB::table('companies')->count();
            $contacts = DB::table('contacts')->count();
            $jobs = DB::table('jobs')->count();
            $sectors = DB::table('sectors')->count();

            //$tutorInfo = DB::select("SELECT * FROM users WHERE id = ?", [$user_id]);
            //$tutorInfo[0]->name = "ITI";
            //dd($tutorInfo);
            //Redirecciona a ls vista home o de dashboard
            return view('home', compact('careers', 'students','tutores','sessions','movements','skills','competences','medals','companies','contacts','jobs','sectors'));
            break;
        case 3: //INFORMACION DASHBOARD PARA ESTUDIANTES
          $students=DB::table('siita_db.students')
              ->where('siita_db.students.user_id',Auth::user()->id)
              ->first();
          if( $students->deleted==0){
            
           $jobs=DB::table('jobs')
           ->join('companies as c','c.id','=','jobs.id_company')
          ->join('sectors as s','s.id','=','jobs.id_sector')
          ->select('c.name as company_name', 'c.image_url','jobs.*','s.name as sector_name')
          ->latest()
          ->get();
          return view('egresado.inicio', compact('jobs'));
           break;
          }else{
            return view('noaccess');
            break;
          }
        case 5: //INFORMACION DASHBOARD PARA TUTORES
          $tutorados = DB::table('siita_db.students as students')->where("students.tutor_user_id","=",Auth::user()->id)->count();
          $solicitudes = DB::table('students_competences as solicitudes')
          ->join('siita_db.users as users','solicitudes.student_id','=','users.university_id')
          ->join('competences','solicitudes.competence_id','=','competences.id')
          ->join('siita_db.students as students',"students.user_id","=","users.id")
          ->select('solicitudes.*',
                  'users.first_name',
                  'users.last_name',
                  'users.second_last_name',
                  'competences.name')
                  ->where('solicitudes.status','=',0)
                  ->where('students.tutor_user_id',"=",Auth::user()->id)
                  ->count();
          $evaluar = DB::table("students_competences")
                ->join("siita_db.users as users","students_competences.student_id","=","users.university_id")
                ->join("siita_db.students as students","users.id","=","students.user_id")
                ->select("students_competences.*")
                  ->where("students.tutor_user_id","=",Auth::user()->id)
                  ->where("students_competences.deleted","=",0)
                  ->where("students_competences.status","=",1)
                  ->where("students_competences.evaluated","=",0)->count();
          
          return view('home')->with("tutorados",$tutorados)
                            ->with("solicitudes",$solicitudes)
                            ->with("evaluar",$evaluar);
           break;
       case 8: //INFORMACION DASHBOARD PARA EMPRESA
            $companies=DB::table('companies')
              ->where('companies.id',Auth::user()->id)
              ->first();
          
         if( $companies->deleted==0){
            $job_requests=DB::table('status_job as status')
          ->join('jobs as j','j.id','=','status.id_job')
          ->join('companies as c','c.id','=','j.id_company')
          ->join('siita_db.students as s','s.user_id','=','status.id_student')
          ->join('siita_db.users as u','u.id','=','s.user_id')
          ->get();
          return view('empresa.inicio', compact('job_requests'));
           break;}else{
            return view('noaccess');
            break;
          }
        default:
          return view('noaccess');
          break;
      }
    }
}
