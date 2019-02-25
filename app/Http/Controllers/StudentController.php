<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Career;
use App\students_competences;
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

class StudentController extends Controller
{
    /**
     * Mostrando una lista con todos los alumnos registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutor = DB::table('siita_db.users as users')
            ->select("users.title","users.first_name","users.last_name","users.second_last_name")
            ->where('users.id','=',Auth::user()->id)
            ->first();

        $students = DB::table('siita_db.students as students')
            ->join('siita_db.users as users', 'students.user_id', '=', 'users.id')
            ->join('siita_db.careers as careers', 'careers.id', '=', 'students.career_id')
            ->join('siita_db.users as tutors', 'students.tutor_user_id', '=', 'tutors.id')
            ->select(
                'users.first_name as userFirstName',
                'users.last_name as userLastName',
                'users.second_last_name as userSecondName',
                'students.*',
                'careers.name as careerName',
                'careers.abbreviation as careerAbbreviation',
                'careers.id as career_id',
                'users.university_id as university_id',
                'users.id as id',
                'users.image_url as image',
                'users.deleted as deleted',
                'tutors.university_id as tutorUniversityId',
                'tutors.title as title',
                'tutors.id as tutorID',
                'tutors.first_name as tutorFirstName',
                'tutors.last_name as tutorLastName',
                'tutors.second_last_name as tutorSecondName'
            );

        if (Auth::user()->type==1) {
            $students=$students->get();
        } elseif(Auth::user()->type==2){
            $students=$students->where('users.deleted','=','0')->get();
        }else {
            $students=$students->where('students.tutor_user_id', '=', Auth::user()->id)->get();
        }

        return view('students.list')
            ->with('students', $students)
            ->with('tutor', $tutor)
            ->with('title', 'Listado de Alumnos');
    }

    /**
     * Mostrar los detalles del alumno solicitado.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Consulta para traer los detalles de un alumno
        $student = DB::table('siita_db.students as students')
            ->join('siita_db.users as users', 'students.user_id', '=', 'users.id')
            ->join('siita_db.users as tutors', 'students.tutor_user_id', '=', 'tutors.id')
            ->join('siita_db.careers as careers', 'students.career_id', '=', 'careers.id')
            ->select(
                'careers.*',
                'students.*',
                'users.first_name',
                'users.last_name',
                'users.second_last_name',
                'users.email',
                'users.university_id',
                'users.id as user_id',
                'users.image_url as image',
                'tutors.title as title',
                'tutors.first_name as tutorFirstName',
                'tutors.last_name as tutorLastName',
                'tutors.second_last_name as tutorSecondName',
                'users.image_url as image',
                'users.university_id as user_university_id',
                'tutors.university_id as tutor_university_id'
            )
            ->where('users.university_id', '=', $id)
            ->first();
        
        $projects = DB::table('projects')->where('projects.user_id','=',$id)->get();
        $acknowledgments = DB::table('acknowledgments')->where('acknowledgments.user_id','=',$id)->get();
        $work_experiences = DB::table('work_experiences')->where('work_experiences.user_id','=',$id)->get();
        
        $competences = DB::table('students_competences')
            ->join('competences','students_competences.competence_id','=','competences.id')
            ->select('students_competences.id as id','students_competences.score as score','students_competences.updated_at as updated','students_competences.deleted as deleted','competences.name as name')
            ->where('students_competences.student_id','=',$id)->where('students_competences.status','=',1)->get();

        $skills = DB::table('students_skills')
            ->join('skills','students_skills.skill_id','=','skills.id')
            ->select('students_skills.*',
                    'skills.name as name')
            ->where('students_skills.user_id','=',$id)->get();

        $medals = DB::table('students_medals')
            ->join('medals','students_medals.medal_id','=','medals.id')
            ->select('students_medals.*',
                    'medals.name as name',
                    'medals.image as image')
            ->where('students_medals.student_id','=',$id)->get();
        //Retorna a la vista de detalles de alumno
        return view('students.show', compact('student','projects','acknowledgments','work_experiences','competences','skills','medals'));
    }

    /**
     * Creando un nuevo alumno.
     *
     * @return \Illuminate\Http\Response
     */

}
