<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Helpers\DeleteHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Alert;
use App\competence;
use App\project;
use App\User;
use App\Student;
use App\Career;
use App\job;
use App\company;
use App\students_competences;
use App\students_skills;
use App\skill;
use App\work_experience;
use App\acknowledgments;
use App\Evidences;
use App\Country;
use App\State;
use App\City;

class EgresadosController extends Controller
{
    //Funciones para regresar la vistas de los egresados
    
    //Pagina de inicio
    public function inicio_egresado(){
        return view('egresado.inicio');
    }
    
    //Pagina de ofertas de trabajo
    public function ofertas_trabajo(){
        $companies=DB::table('companies')
        ->get();
        return view('egresado.lista_trabajo', compact('companies'));
    }
    
    //Pagina para ver otros egresados
    public function lista_egresados(Request $request){
        //Declarar variables para poder realizar la consulta correspondiente
        $university_id  = $request->get('university_id');
        $abbreviation = $request->get('abbreviation');
        
        
      
       $students_count=DB::table('siita_db.users')
        ->join('siita_db.students','siita_db.users.id','=','siita_db.students.user_id')
        ->join('siita_db.careers','siita_db.students.career_id','=','siita_db.careers.id')
        ->select('siita_db.users.*','siita_db.students.*','siita_db.careers.*')
        ->where('siita_db.users.university_id','LIKE',"%$university_id%")
        ->where('siita_db.careers.abbreviation','LIKE',"%$abbreviation%")
        ->orderBy('siita_db.users.university_id')
        ->count();
      
      if($students_count==0){
        $students_upv=DB::table('siita_db.users')
        ->join('siita_db.students','siita_db.users.id','=','siita_db.students.user_id')
        ->join('siita_db.careers','siita_db.students.career_id','=','siita_db.careers.id')
        ->select('siita_db.users.*','siita_db.students.*','siita_db.careers.*')
        ->where('siita_db.users.university_id','LIKE',"%$university_id%")
        ->where('siita_db.careers.abbreviation','LIKE',"%$abbreviation%")
        ->orderBy('siita_db.users.university_id')
        ->get();
        Alert::info('Este alumno no se encuentra','Algo sucedio!!!')->autoclose(4000);
      }else{
        $students_upv=DB::table('siita_db.users')
        ->join('siita_db.students','siita_db.users.id','=','siita_db.students.user_id')
        ->join('siita_db.careers','siita_db.students.career_id','=','siita_db.careers.id')
        ->select('siita_db.users.*','siita_db.students.*','siita_db.careers.*')
        ->where('siita_db.users.university_id','LIKE',"%$university_id%")
        ->where('siita_db.careers.abbreviation','LIKE',"%$abbreviation%")
        ->orderBy('siita_db.users.university_id')
        ->get();
      }
      
      

        //Obtener la lista de carreras para su busqueda
        $careers=DB::table('siita_db.careers')
        ->select('siita_db.careers.*')
        ->get();

        //Obtener la lista de los alumnos para su busqueda
        $students=DB::table('siita_db.users')
        ->select('siita_db.users.*')
        ->where('siita_db.users.type',3)
        ->get();    

        return view('egresado.lista_egresados', compact('students_count','students_upv','careers','students'));
    }

    //Pagina para ver el perfil del egresado
    public function perfil_egresado($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();

        $count_jobs=DB::table('status_job')
        ->where('id_student',auth()->user()->university_id)
        ->count();

        $contador_pendientes=DB::table('status_job')
        ->where('id_student',auth()->user()->university_id)
        ->where('status','Pendiente')
        ->count();

        $contador_aceptados=DB::table('status_job')
        ->where('id_student',auth()->user()->university_id)
        ->where('status','Aceptado')
        ->count();

        $contador_rechazados=DB::table('status_job')
        ->where('id_student',auth()->user()->university_id)
        ->where('status','Rechazado')
        ->count();

        $contador_competencias=DB::table('students_competences as sc')
        ->join('siita_db.users as u', 'u.university_id','=','student_id')
        ->where('student_id',auth()->user()->university_id)
        ->count();

        $competences=DB::table('students_competences as sc')
        ->join('siita_db.users as u', 'u.university_id','=','student_id')
        ->join('competences as c', 'c.id','=','competence_id')
        ->select('c.id as id_competence','c.name','sc.*','u.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();

        $competencias_pendientes=DB::table('students_competences as sc')
        ->where('sc.student_id',auth()->user()->university_id)
        ->where('status',0)
        ->count();

        $competencias_aceptadas=DB::table('students_competences as sc')
        ->where('sc.student_id',auth()->user()->university_id)
        ->where('status',1)
        ->count();
        
        $trabajos_pendientes=DB::table('status_job')
        ->join('jobs as j','j.id','=','id_job')
        ->join('companies as c','c.id','=','j.id_company')
        ->where('id_student',auth()->user()->university_id)
        ->where('status','Pendiente')
        ->select('j.*','status_job.*','c.name as company_name')
        ->get();
      
      
      $contador_proyectos=DB::table('projects as p')
        ->join('siita_db.users as u', 'u.university_id','=','p.user_id')
        ->where('p.user_id',auth()->user()->university_id)
        ->count();

        $projects=DB::table('projects as p')
        ->join('siita_db.users as u', 'u.university_id','=','p.user_id')
        ->select('p.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();
        
        $proyectos_agregados=DB::table('projects as p')
        ->where('p.user_id',auth()->user()->university_id)
        ->where('deleted',0)
        ->count();

        $proyectos_eliminados=DB::table('projects as p')
        ->where('p.user_id',auth()->user()->university_id)
        ->where('deleted',1)
        ->count();
      
        $skills_student=DB::table('students_skills as ss')
          ->join('siita_db.users as u','u.university_id','ss.user_id')
          ->join('skills as s','s.id','ss.skill_id')
          ->select('ss.*','s.name')
          ->where('u.university_id',auth()->user()->university_id)
          ->get();
      
      $experiences=DB::table('work_experiences as we')
        ->join('siita_db.users as u', 'u.university_id','=','we.user_id')
        ->select('we.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();
      
      $count_experiences=DB::table('work_experiences as we')
        ->join('siita_db.users as u', 'u.university_id','=','we.user_id')
        ->select('we.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->count();
      
     $student_medals=DB::table('students_medals as sm')
        ->join('siita_db.users as u', 'u.university_id','=','sm.student_id')
        ->join('medals as m','m.id','sm.medal_id')
        ->select('sm.*','m.name','m.description','m.image')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();
      
      $count_medals=DB::table('students_medals as sm')
        ->join('siita_db.users as u', 'u.university_id','=','sm.student_id')
        ->select('sm.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->count();
      
      $acknowledgments=DB::table('acknowledgments as a')
        ->join('siita_db.users as u', 'u.university_id','=','a.user_id')
        ->select('a.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();
      
      $count_acknowledgments=DB::table('acknowledgments as a')
        ->join('siita_db.users as u', 'u.university_id','=','a.user_id')
        ->select('a.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->count();
      
      $evidences=DB::table('evidences as e')
        ->join('siita_db.users as u', 'u.university_id','=','e.student_id')
        ->select('e.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->get();
      
      
      
      $count_evidences=DB::table('evidences as e')
        ->join('siita_db.users as u', 'u.university_id','=','e.student_id')
        ->select('e.*')
        ->where('u.university_id',auth()->user()->university_id)
        ->count();
           
        return view('egresado.perfil', compact('evidences','count_evidences','acknowledgments','count_acknowledgments','student_medals','count_medals','count_experiences','experiences','skills_student','users','trabajos_pendientes','count_jobs','contador_pendientes','contador_aceptados','contador_rechazados','contador_competencias','competences','competencias_pendientes','competencias_aceptadas','contador_proyectos','projects','proyectos_agregados','proyectos_eliminados'));
    }

    public function editprofile($id){
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();

        return view('egresado.editprofile',compact('users'));
    }

    public function update_profile($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::find($id);
        $image = Input::file('image');
        $image2 = Input::get('image_2');
      if($image==null){
        Alert::info('No se actualizo la imagen')->autoclose(4000);
        return back();
      }

      if($image->getClientOriginalExtension()=="png" || $image->getClientOriginalExtension()=="jpg" || $image->getClientOriginalExtension()=="jpeg" || $image->getClientOriginalExtension()=="gif"){
        //Actualizar foto, elimina la anterior
        if ($image!=null) {
            if ($image2!='storage/no_image.png') {
                unlink(public_path()."/".$image2);
            }
            $path=Input::file('image')->store('/public/students');
            $image_url = 'storage/students/'.Input::file('image')->hashName();
            DB::update('UPDATE siita_db.users SET image_url = ? WHERE id = ?', [$image_url, $id]); 
            Alert::success('Se ha actualizado tu perfil','Bien Hecho!!!')->autoclose(4000);
            return back();
        }  
        
        
      }else{
        Alert::info("Solo se permiten archivos .jpg, .jpeg, .png o .gif ",'No se actualizo la imagen')->autoclose(4000);
        return back();
      }
        
    }

    //Pagina para ver el perfil de otros egresados
    public function perfil_usuario($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $careers=DB::table('siita_db.students as s')
        ->join('siita_db.users as u','s.user_id','=','u.id')
        ->join('siita_db.careers as c','c.id','=','s.career_id')
        ->select('s.*', 'u.*','c.*')
        ->where('u.id','=',$id)
        ->get();
        return view('egresado.perfil_usuario', compact('users','careers'));
    }

    //Pagina para ver la conexiones del egresado
    public function conexiones_egresado($id){
        $users=User::findOrFail($id);
        $information=DB::table('siita_db.students as s')
        ->join('siita_db.users as u','s.user_id','=','u.id')
        ->join('siita_db.careers as c','c.id','=','s.career_id')
        ->select('s.*', 'u.*','c.*')
        ->where('u.id','=',$id)
        ->get();
        return view('egresado.conexiones',compact('users','information'));
    }

    //Pagina para ver las vacantes
    public function vacante($id){
        $jobs=job::find($id);
        $jobs=DB::table('jobs')
        ->join('companies as c', 'c.id','=','jobs.id_company')
        ->join('sectors as s', 's.id','=','jobs.id_sector')
        ->select('jobs.*','c.name as company_name','s.name as sector_name')
        ->where('jobs.id',$id)
        ->get();
        
        $id_student=Student::join('siita_db.users as u','user_id','=','u.id')
        ->where('user_id',auth()->user()->id)
        ->first();
        

        $contador=DB::table('status_job')
        ->where('id_job','=',$id)
        ->where('id_student','=',$id_student->university_id)
        ->count();
      
        $status=DB::table('status_job')
        ->where('id_job','=',$id)
        ->where('id_student','=',$id_student->university_id)
        ->first();
        
        if($contador==0){
          return view('egresado.vacante', compact('jobs','contador','status'));
        }else{
          if($status->status=="Aceptado"){
          Alert::success("Tu solicitud ha sido aceptada","Felicidades");
        }
        if($status->status=="Pendiente"){
          Alert::info("Tu solicitud esta pendiente");
        }
          return view('egresado.vacante', compact('jobs','contador','status'));
        }
      
        
    }

    public function sendjob(){
        $id_job=request('id_job');
        $id_student=request('id_student');
        $status=request('status');

        $query=DB::table('status_job')
        ->insert(
            array('id_student' => $id_student, 'id_job' => $id_job, 'status' => $status)
        );
        Alert::success('La solicitud se ha enviado correctamente','Bien Hecho!!!')->autoclose(4000);
        return back();
    }

    public function destroy_sendjob($id){
        $id_student=Student::join('siita_db.users as u','u.id','=','user_id')
        ->where('user_id',auth()->user()->id)
        ->first();
        
      
        $query=DB::table('status_job')
        ->where('id_job',$id)
        ->where('id_student','=',$id_student->university_id)
        ->delete();
      
        Alert::success('Tu solicitud ha sido cancelada','Bien Hecho!!!')->autoclose(4000);
        return back();
    }

    public function addcompetence($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.users.university_id','=',auth()->user()->university_id)
        ->get();

        /*$search_id=students::join('users','users.id','=','user_id')
        ->where('user_id',auth()->user()->id)
        ->first();*/

        //$id_student=(int)$search_id->university_id;
      $id_student=auth()->user()->university_id;
       $competences=DB::table('competences')
        ->join('students_competences','competences.id','=','students_competences.competence_id')
        ->where('students_competences.student_id',$id_student)
        ->get();

        $competences_not_asigned=DB::table('competences')
        ->whereNotExists(function ($query) use ($id_student){
            $query->select(DB::raw(1))
            ->from('students_competences')
            ->whereRaw('competences.id = students_competences.competence_id')
            ->where('students_competences.student_id',$id_student);
        })
        ->get();

        $count_competences=DB::table('students_competences')
        ->where('student_id',$id_student)
        ->count();

        $students_competences=DB::table('students_competences')
        ->join('competences as c','c.id','=','competence_id')
        ->select('students_competences.status')
        ->get();

        return view('egresado.addcompetence', compact('users','competences','count_competences','students_competences','competences_not_asigned','id_student'));
    }

    public function store_addcompetences(Request $request){
      
      if($competences_ids=$request->competences==auth()->user()->id){
         Alert::error('No has agregado competencias','Mal Hecho!!!')->autoclose(4000);
         return back(); 
       }else{
        $competences_ids=$request->competences;
        foreach($competences_ids as $id){
            $students_competences=new students_competences();
            $students_competences->student_id=auth()->user()->university_id;
            $students_competences->competence_id=$id;
            $students_competences->save();
        }
        Alert::success('La solicitud de competencias de ha enviado correctamente','Bien Hecho!!!')->autoclose(4000);
        return back();
       }
 
    }

    
    //Pagina para ver el perfil de la empresa
    public function egresado_perfil_empresa($id){
        $companies=company::findOrFail($id);

        /*dd($sectors=DB::table('companies')
        ->join('sectors','sectors.id','=','companies.id_sector')
        ->select('sectors.*')
        ->get());*/
        $companies=DB::table('companies')
        ->join('siita_db.users as u','u.id','=','companies.id')
        ->select('companies.*','u.email')
        ->where('companies.id','=',$id)
        ->get();
        $jobs=DB::table('jobs as j')
        ->join('companies as c', 'c.id','=','j.id_company')
        ->join('siita_db.users as u','u.id','=','c.id')
        ->join('sectors as s', 's.id','=','j.id_sector')
        ->select('c.name as company_name', 'c.phone as company_phone','u.email as company_email','j.*','s.name as sector_name')
        ->where('j.id_company',$id)
        ->latest()
        ->get();
        
        $contacts=DB::table('contacts as con')
        ->join('companies as c', 'c.id','=','con.company_id')
        ->select('c.name','con.*')
        ->where('con.company_id',$id)
        ->latest()
        ->get();

        return view('egresado.egresado_perfil_empresa', compact('companies','jobs','contacts'));
    }
  
  //Pagina para ver el perfil del egresado
    public function addprojects($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();
      
        return view('egresado.addproject', compact('users'));
    }

  //Pagina para ver el perfil del egresado
    public function store_addprojects(Request $request){
        $data = request()->validate([
            'name' => 'required|max:128',
            'start_date' => 'required',
            'finish_date' => 'required',
            'description' => 'required',
            'boss' => 'required',
            'company' => 'required',
          ],[
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'description.required' => ' * Este campo es obligatorio.',
            'start_date.required' => ' * Este campo es obligatorio.',
            'finish_date.required' => ' * Este campo es obligatorio.',
            'boss.required' => ' * Este campo es obligatorio.',
            'company.required' => ' * Este campo es obligatorio.',
          ]);
            
          $fecha_actual=date("Y-m-d");

          if(Input::get('start_date')>= Input::get('finish_date')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error');
            return back();
          }else if (Input::get('start_date')>$fecha_actual ){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error');
            return back();
          }

          $project = new project;
  
          //Se obtienen los valores de la vista
          $project->name = Input::get('name');
          $project->start_date = Input::get('start_date');
          $project->finish_date = Input::get('finish_date');
          $project->description = Input::get('description');
          $project->user_id = Input::get('university_id');
          $project->boss = Input::get('boss');
          $project->company = Input::get('company');
          $project->save();
        //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($project->save()) {
            Alert::success('El proyecto ha sido agregado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
            return redirect()->route('profile_student',[auth()->user()->id]);
          } else {
            Alert::error('No se registro el proyecto', 'Error');
            return redirect()->route('profile_student',[auth()->user()->id]);
          }
         
    }
  
  public function editproject($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $project=project::findOrFail($id);
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.editproject', compact('users','project'));
    }
  
  public function update_project($id){
        //Mostrar un perfil de usuario con el id correspondiente
        
        $projects=project::find($id);
    
         $fecha_actual=date("Y-m-d");

          if(request('start_date')>= request('finish_date')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error')->autoclose(4000);
            return back();
          }else if (request('start_date')>$fecha_actual ){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
            return back();
          }

        //Mostrar la carrera del alumno correspondiente
        $projects=DB::table('projects')
        ->select('projects.*')
        ->where('projects.id',$id)
        ->update(['name' => request('name'),'start_date' => request('start_date'),'finish_date' => request('finish_date'),'description' => request('description'),'boss' => request('boss'),'company' => request('company')]);
        Alert::success('El proyecto ha sido actualizada correctamente','Bien Hecho!!!')->autoclose(4000);
        return back();
    }
    public function delete_project($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $id=request('idproject');
        
        if(request('delete')==1){
          //Mostrar la carrera del alumno correspondiente
        $projects=DB::table('projects')
        ->select('projects.*')
        ->where('projects.id',$id)
        ->update(['deleted' => request('delete')]);
        Alert::success('El proyecto ha sido eliminado correctamente','Bien Hecho!!!')->autoclose(4000);
        return back();
        }else{
          //Mostrar la carrera del alumno correspondiente
        $projects=DB::table('projects')
        ->select('projects.*')
        ->where('projects.id',$id)
        ->update(['deleted' => request('delete')]);
        Alert::success('El proyecto ha sido restaurado correctamente','Bien Hecho!!!')->autoclose(4000);
        return back();
        }

        
    }
  public function addskills($id){
        $users=User::findOrFail($id);

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();
       
       $id_student=auth()->user()->university_id;
       $skills=DB::table('skills')
        ->join('students_skills','skills.id','=','students_skills.skill_id')
        ->where('students_skills.user_id',$id_student)
        ->get();

        $skills_not_asigned=DB::table('skills')
        ->whereNotExists(function ($query) use ($id_student){
            $query->select(DB::raw(1))
            ->from('students_skills')
            ->whereRaw('skills.id = students_skills.skill_id')
            ->where('students_skills.user_id',$id_student);
        })
        ->get();

       
        return view('egresado.addskill', compact('users','skills','skills_not_asigned','id_student'));
    }

    public function store_addskills(Request $request){
        
       if($skills_ids=$request->skills==null){
         Alert::error('No has agregado habilidades','Mal Hecho!!!')->autoclose(4000);
         return back(); 
       }else{
        $skills_ids=$request->skills;
        foreach($skills_ids as $id){
            $students_skills=new students_skills();
            $students_skills->user_id=auth()->user()->university_id;
            $students_skills->skill_id=$id;
            $students_skills->save();
        }
        Alert::success('Tus habilidades han sido agregadas correctamente','Bien Hecho!!!')->autoclose(4000);
        return back(); 
       }
   
    }
  
     public function editskills($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $skill=DB::table('students_skills as ss')
          ->join('skills as s','s.id','ss.skill_id')
          ->join('siita_db.users as u','u.university_id','ss.user_id')
          ->select('ss.*','s.name')
          ->where('ss.id',$id)
          ->first();
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.editskill', compact('users','skill'));
    }
  
  public function update_skill($id){
        //Mostrar un perfil de usuario con el id correspondiente
        
        if( request('score')>100 || request('score')<0 ){
          Alert::error('La puntuación de esta habilidad debe ser entre 0 y 100','Mal Hecho!!!')->autoclose(4000);
          return back();
        }else{
          $skills=project::find($id);
          $skills=DB::table('students_skills as ss')
          ->select('ss.*')
          ->where('ss.id',$id)
          ->update(['score' => request('score')]);
          //swal("Good job!", "You clicked the button!", "success");
          Alert::success('La puntuación de esta habilidad ha sido actualizada correctamente','Bien Hecho!!!')->autoclose(4000);
          return back();
        }
        
    }
  public function deleteskills($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $skill=DB::table('students_skills as ss')
          ->join('skills as s','s.id','ss.skill_id')
          ->join('siita_db.users as u','u.university_id','ss.user_id')
          ->select('ss.*','s.name')
          ->where('ss.id',$id)
          ->first();
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.deleteskill', compact('users','skill'));
    }
  
  public function destroy_skill($id){
        $id=request('idskill');
        $skill=DB::table('students_skills')
        ->where('id',$id)
        ->delete();
      
        Alert::success('Tu habilidad ha sido eliminada','Bien Hecho!!!')->autoclose(4000);
        return redirect()->route('profile_student',[auth()->user()->id]);
        
    }
  
  //Pagina para ver el perfil del egresado
    public function addworkexperiences($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);
        $countries = Country::pluck('name','id'); 

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();
      
        return view('egresado.addworkexperience', compact('users','countries'));
    }
  
  public function store_workexperiences(Request $request){
        $data = request()->validate([
            'position' => 'required|max:128',
            'start_date' => 'required',
            'finish_date' => 'required',
            'description' => 'required',
            'company' => 'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
          ],[
            'position.required' => ' * Este campo es obligatorio.',
            'position.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'company.required' => ' * Este campo es obligatorio.',
            'country.required' => ' * Este campo es obligatorio.',
            'state.required' => ' * Este campo es obligatorio.',
            'city.required' => ' * Este campo es obligatorio.',
            'description.required' => ' * Este campo es obligatorio.',
            'start_date.required' => ' * Este campo es obligatorio.',
            'finish_date.required' => ' * Este campo es obligatorio.',
          ]);
            
          $fecha_actual=date("Y-m-d");

          if(Input::get('start_date')>= Input::get('finish_date')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error');
            return back();
          }else if (Input::get('start_date')>$fecha_actual ){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error');
            return back();
          }

          $work_experience = new work_experience;
  
          //Se obtienen los valores de la vista
          $work_experience->user_id = Input::get('university_id');
          $work_experience->position = Input::get('position');
          $work_experience->company = Input::get('company');
          $work_experience->country = Input::get('country');
          $work_experience->state = Input::get('state');
          $work_experience->city = Input::get('city');
          $work_experience->start_date = Input::get('start_date');
          $work_experience->finish_date = Input::get('finish_date');
          $work_experience->description = Input::get('description');
          
          
        //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($work_experience->save()) {
            Alert::success('La experiencia laboral ha sido agregado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
            
            return redirect()->route('profile_student',[auth()->user()->id]);
          } else {
            Alert::error('No se registro la experiencia laboral', 'Error');
            return redirect()->route('profile_student',[auth()->user()->id]);
          }
         
    }
  public function editworkexperience($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $work_experience=work_experience::findOrFail($id);
        
        $countries = Country::pluck('name','id');
        $states = State::all()->where('country_id','=',$work_experience->country)->pluck('name','id');
        $cities = City::all()->where('state_id','=',$work_experience->state)->pluck('name','id');
    
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.editworkexperience', compact('users','work_experience','countries','states','cities'));
    }
  
  public function update_workexperience($id){
          
          $fecha_actual=date("Y-m-d");

          if(Input::get('start_date')>= Input::get('finish_date')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error');
            return back();
          }else if (Input::get('finish_date')>$fecha_actual){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error');
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }
    
           $work_experience=work_experience::find($id);
            $work_experience=DB::table('work_experiences as we')
          ->select('we.*')
          ->where('we.id',$id)
          ->update(['position' => request('position'),'company' => request('company'),'country' => request('country'),'state' => request('state'),'city' => request('city'),'start_date' => request('start_date'),'finish_date' => request('finish_date'),'description' => request('description')]);
          //swal("Good job!", "You clicked the button!", "success");
          Alert::success('La experiencia laboral ha sido actualizado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
          return back();
         
    }
  
  public function deleteworkexperiences($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $work_experience=DB::table('work_experiences as we')
          ->join('siita_db.users as u','u.university_id','we.user_id')
          ->select('we.*')
          ->where('we.id',$id)
          ->first();
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.deleteworkexperience', compact('users','work_experience'));
    }
  
  public function destroy_workexperience($id){
        $id=request('idwork');
        $work_experience=DB::table('work_experiences')
        ->where('id',$id)
        ->first();
        if($work_experience->deleted==0){
          $work_experience=DB::table('work_experiences')
           ->where('id',$id)
           ->update(['deleted' => 1]);
          Alert::success('Tu experiencia laboral ha sido eliminada','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }else{
          $work_experience=DB::table('work_experiences')
           ->where('id',$id)
           ->update(['deleted' => 0]);
          Alert::success('Tu experiencia laboral ha sido restaurada','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }

    }
  
  public function addacknowledgments($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);
        

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();
      
        return view('egresado.addacknowledgment', compact('users'));
    }
  
  public function store_acknowledgments(Request $request){
        $data = request()->validate([
            'title' => 'required|max:128',
            'date' => 'required',
            'description' => 'required',
            'transmitter' => 'required',
          ],[
            'title.required' => ' * Este campo es obligatorio.',
            'title.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'transmitter.required' => ' * Este campo es obligatorio.',
            'description.required' => ' * Este campo es obligatorio.',
            'date.required' => ' * Este campo es obligatorio.',
          ]);
            
          $fecha_actual=date("Y-m-d");
          if (Input::get('date')>$fecha_actual ){
            Alert::error('Tu fecha se excede a la fecha actual', 'Error')->autoclose(4000);
            return back();
          }

          $acknowledgment = new acknowledgments;
  
          //Se obtienen los valores de la vista
          $acknowledgment->user_id = Input::get('university_id');
          $acknowledgment->title = Input::get('title');
          $acknowledgment->transmitter = Input::get('transmitter');
          $acknowledgment->date = Input::get('date');
          $acknowledgment->description = Input::get('description');
          
          
        //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($acknowledgment->save()) {
            Alert::success('El reconocimiento ha sido agregado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
            
            return redirect()->route('profile_student',[auth()->user()->id]);
          } else {
            Alert::error('No se registro el reconocimiento', 'Error');
            return redirect()->route('profile_student',[auth()->user()->id]);
          }
         
    }
  
   public function editacknowledgment($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $acknowledgment=acknowledgments::findOrFail($id);
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.editacknowledgment', compact('users','acknowledgment'));
    }
  public function update_acknowledgment($id){
          
          $fecha_actual=date("Y-m-d");
          if (Input::get('date')>$fecha_actual ){
            Alert::error('Tu fecha se excede a la fecha actual', 'Error')->autoclose(4000);
            return back();
          }
    
           $acknowledgment=acknowledgments::find($id);
            $acknowledgment=DB::table('acknowledgments as a')
          ->select('a.*')
          ->where('a.id',$id)
          ->update(['title' => request('title'),'transmitter' => request('transmitter'),'date' => request('date'),'description' => request('description')]);
          //swal("Good job!", "You clicked the button!", "success");
          Alert::success('El reconocimiento ha sido actualizado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
          return back();
         
    }
  
  public function deleteacknowledgments($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $acknowledgment=DB::table('acknowledgments as a')
          ->join('siita_db.users as u','u.university_id','a.user_id')
          ->select('a.*')
          ->where('a.id',$id)
          ->first();
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.deleteacknowledgments', compact('users','acknowledgment'));
    }
  
  public function destroy_acknowledgment($id){
        $id=request('idacknowledgment');
        $acknowledgment=DB::table('acknowledgments')
        ->where('id',$id)
        ->first();
        if($acknowledgment->deleted==0){
          $acknowledgment=DB::table('acknowledgments')
           ->where('id',$id)
           ->update(['deleted' => 1]);
          Alert::success('Tu reconocimiento ha sido eliminado','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }else{
          $acknowledgment=DB::table('acknowledgments')
           ->where('id',$id)
           ->update(['deleted' => 0]);
          Alert::success('Tu reconocimiento ha sido restaurado','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }

    }
  
  public function addevidences($id){
        //Mostrar un perfil de usuario con el id correspondiente
        $users=User::findOrFail($id);
        

        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',$id)
        ->get();
      
        return view('egresado.addevidence', compact('users'));
    }
  
  public function store_evidences(Request $request){
        $data = request()->validate([
            'name' => 'required|max:128',
            'path' => 'required',
          ],[
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'path.required' => ' * Este campo es obligatorio.',
          ]);
           
          $file=Input::file('path');
          
          if($file==null){
            Alert::info('No se subio el archivo')->autoclose(4000);
            return back();
          }

        if($file->getClientOriginalExtension()=="png" || $file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="jpeg" || $file->getClientOriginalExtension()=="gif" || $file->getClientOriginalExtension()=="pdf"){
          $evidence = new Evidences;
  
          //Se obtienen los valores de la vista
          $evidence->student_id = Input::get('university_id');
          $evidence->name= Input::get('name');
          
          $path=$request->file('path')->store('/public/evidences');
          $evidence->path = 'storage/evidences/'.Input::file('path')->hashName();
          
          
        //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($evidence->save()) {
            Alert::success('La evidencia ha sido agregado correctamente correctamente','Bien Hecho!!!')->autoclose(4000);
            
            return redirect()->route('profile_student',[auth()->user()->id]);
          } else {
            Alert::error('No se registro la evidencia', 'Error')->autoclose(4000);
            return redirect()->route('profile_student',[auth()->user()->id]);
          }
          
        }else{
            Alert::error('Solo se permiten archivos .jpg, .jpeg, .png, .gif o .pdf ', 'Error');
            return back();
        }
          
          
         
    }
  
  protected function downloadFile($src){
    if(is_file($src)){
      $finfo=finfo_open(FILEINFO_MIME_TYPE);
      $content_type=finfo_file($finfo,$src);
      finfo_close($finfo);
      $file_name=basename($src).PHP_EOL;
      $size=filesize($src);
      header("Content-Type: $content_type");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: $size");
      readfile($src);
      return true;
    }else{
      return false;
    }
  }
  
  public function download($id){
    
    $path=DB::table('evidences')
      ->select('path')
      ->where('id',$id)
      ->first();
    if(!$this->downloadFile($path->path)){
      return redirect()->back();
    }
  }
  
  public function deleteevidences($id){
         //Mostrar un perfil de usuario con el id correspondiente
        $evidence=DB::table('evidences as e')
          ->join('siita_db.users as u','u.university_id','e.student_id')
          ->select('e.*')
          ->where('e.id',$id)
          ->first();
        
      
        //Mostrar la carrera del alumno correspondiente
        $users=DB::table('siita_db.students')
        ->join('siita_db.users','siita_db.students.user_id','=','siita_db.users.id')
        ->join('siita_db.careers','siita_db.careers.id','=','siita_db.students.career_id')
        ->select('siita_db.students.*', 'siita_db.users.*','siita_db.careers.*')
        ->where('siita_db.students.user_id','=',auth()->user()->id)
        ->get();
      
         return view('egresado.deleteevidences', compact('users','evidence'));
    }
  
  public function destroy_evidence($id){
        $id=request('idevidence');
        $evidence=DB::table('evidences')
        ->where('id',$id)
        ->first();
        if($evidence->deleted==0){
          $evidence=DB::table('evidences')
           ->where('id',$id)
           ->update(['deleted' => 1]);
          Alert::success('Tu evidencia ha sido eliminada','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }else{
          $evidence=DB::table('evidences')
           ->where('id',$id)
           ->update(['deleted' => 0]);
          Alert::success('Tu evidencia ha sido restaurada','Bien Hecho!!!')->autoclose(4000);
          return redirect()->route('profile_student',[auth()->user()->id]);
        }

    }


}
