<?php

namespace App\Http\Controllers;

use Alert;
use App\StatusJob;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class StatusJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status_job = DB::table("status_job")
          ->join("siita_db.users as users","status_job.id_student","=","users.university_id")
          ->join("jobs","status_job.id_job","=","jobs.id")
          ->join("companies","companies.id","=","jobs.id_company")
          ->select("jobs.name as job","companies.name as company","users.university_id as matricula"
                   ,"users.first_name","users.last_name","users.second_last_name"
                   ,"status_job.id_job as id_job","companies.id as id_company","status_job.id as id")->where("status_job.status","=","Pendiente")->get();
        return view("status_job.list")->with("status_job",$status_job);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        $jobs = DB::table("jobs")->join("companies","jobs.id_company","=","companies.id")->select("jobs.*","companies.name as name_company")->where("jobs.deleted","=",0)->get();
        return view("status_job.create")->with("students",$students)->with("jobs",$jobs);
    }

    public function guardarPostulacion(Request $request,$id){
      $status_job = new StatusJob;
      $status_job->id_student = $request->matricula;
      $status_job->id_job = $id;
      $status_job->status = "Pendiente";
      if ($status_job->save()) {
            Alert::success('Exitosamente','El alumno '.$request->matricula." ha sido postulado en la vacante seleccionada");
  
            insertToLog(Auth::user()->id, 'added', $status_job->id, "postulacion");
  
            return redirect()->route('status_job.list');
          } else {
            Alert::error('No se realizo la postulación', 'Error');
            return redirect()->route('status_job.list');
          }
    }
  
    public function cancelarPostulacion($id){
      $status_job = StatusJob::find($id);
      
      if($status_job->delete()){
          Alert::success('Exitosamente','Postulación Cancelada');

          insertToLog(Auth::user()->id, 'deleted', $id, "postulación");

          return redirect()->route('status_job.list');
      }else{
          Alert::error('No se canceló la postulación', 'Error');

          return redirect()->route('status_job.list');
      }
    }
  
    public function answerAccepted(StatusJob $job){
      $job->status = "Aceptado";
      if($job->update()){
          Alert::success('Exitosamente','Postulante Aceptado');

          insertToLog(Auth::user()->id, 'updated', $job->id, "postulación");
          return redirect()->route('status_job.list');
      }else{
          Alert::error('No se aceptó el postulante', 'Error');

          return redirect()->route('status_job.list');
      }
    }
    
    public function answerRejected(StatusJob $job){
      if($job->delete()){
          Alert::success('Exitosamente','Postulante Rechazado');

          insertToLog(Auth::user()->id, 'deleted', $job->id, "postulación");

          return redirect()->route('status_job.list');
      }else{
          Alert::error('No se rechazó el postulante', 'Error');

          return redirect()->route('status_job.list');
      }
    }
  
    public function verific_jobs(Request $request){
        
        $id = $request->student_id;
        $num_jobs_student = StatusJob::where("id_student","=",$id)->count();
        $data_jobs = DB::table("jobs")->where("deleted","=",0)->get();
        $data_status_job = StatusJob::where("id_student","=",$id)->get();
          
        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$data_jobs,'num_jobs_student'=>$num_jobs_student,'data_status_job'=>$data_status_job]);
    }
}
