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
           break;
        case 5: //INFORMACION DASHBOARD PARA TUTORES
           break;
        default:
           
      }
    }
}
