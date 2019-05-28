<?php

namespace App\Http\Controllers;

use Alert;
use App\competences;
use App\students_competences;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
class CompetencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competences = DB::table('competences')->where('id','!=','4294967295')->get();
        $competences_tutor = DB::table('competences')->where('deleted','=',0)->get();
        return view('competences.list')
          ->with('competences',$competences)
          ->with('competences_tutor',$competences_tutor)
          ->with('title', 'Listado de Competencias');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('competences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'id' => 'required|max:4294967295|min:1|numeric',
            'name' => 'required|max:128',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
          ]);
  
          //Se crea una nueva carrera
          $competences = new competences;
  
          //Se obtienen los valores de la vista
          $competences->id = Input::get('id');
          $competences->name = Input::get('name');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($competences->save()) {
            
            Alert::success('Exitosamente','Competencia Registrada')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "competencia");
  
            return redirect()->route('competences.list');
          } else {
            Alert::error('No se registro la competencia', 'Error')->autoclose(4000);
            return redirect()->route('competences.list');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id==4294967295)
            return redirect()->route('competences.list');

        $competence = competences::find($id);

        return view('competences.show', compact('competence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(competences $competence)
    {
        if($competence->id==4294967295)
            return redirect()->route('competences.list');
        
        return view('competences.edit', ['competence' => $competence]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(competences $competence)
    {
        if($competence->id==4294967295)
            return redirect()->route('competences.list');

        //Validaciones
        $data = request()->validate([
          'competence_id' => 'required|max:4294967295|min:1|numeric',
          'name' => 'required|max:128',
        ],[
          'competence_id.required' => ' * Este campo es obligatorio.',
          'competence_id.max' => ' * El valor máximo de este campo es 4294967294.',
          'competence_id.min' => ' * El valor mínimo de este campo es 1.',
          'competence_id.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
        ]);

        $competence->id = Input::get('competence_id');
        $competence->name = Input::get('name');

        //Se almacena y se muestra mensaje de exito
        if ($competence->update()) {
          Alert::success('Exitosamente','Competencia Modificada')->autoclose(4000);

          insertToLog(Auth::user()->id, 'updated', Input::get('competence_id'), "competencia");

          return redirect()->route('competences.list');
        } else {
          Alert::error('No se modifico la competencia', 'Error')->autoclose(4000);
          return redirect()->route('competences.list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(competences $competence)
    {
        if($competence->id==4294967295)
            return redirect()->route('competences.list');

    //        DB::update('UPDATE students SET career_id = ? WHERE career_id = ?', [4294967295,$career->id]);

        DeleteHelper::instance()->onCascadeLogicalDelete('competences','id',$competence->id);

        Alert::success('Exitosamente','Competencia Eliminada')->autoclose(4000);

        insertToLog(Auth::user()->id, 'deleted', $competence->id, "competencia");

        return redirect()->route('competences.list');
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('competences','id',$request->id);

        Alert::success('Exitosamente','Competencia Restaurada')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "competencia");

        return redirect()->route('competences.list');
    }

    public function editStudentCompetence(students_competences $competence)
    {
      $data_competence = DB::table('students_competences')
            ->join('competences','students_competences.competence_id','=','competences.id')
            ->select('students_competences.student_id as matricula',
                    'students_competences.id as id',
                    'students_competences.score as score',
                    'students_competences.updated_at as updated',
                    'students_competences.deleted as deleted',
                    'students_competences.evaluated as evaluated',
                    'competences.name as name')
            ->where('students_competences.id','=',$competence->id)->first();
      return view('competences.student_competence_edit', ['data_competence' => $data_competence]);
    }

    public function updateStudentCompetence(students_competences $competence)
    {
      $competence->score = Input::get('points');
      $competence->evaluated = 1;

      if ($competence->update()) {
        Alert::success('Exitosamente','Puntuación Modificada')->autoclose(4000);

        insertToLog(Auth::user()->id, 'updated', $competence->id, "puntuacion");

        return redirect()->route('students.show', ['id' => $competence->student_id]);
      } else {
        Alert::error('No se modifico la puntuación', 'Error')->autoclose(4000);
        return redirect()->route('students.show', ['id' => $competence->student_id]);
      }

    }

    public function destroyStudentCompetence(students_competences $competence)
    {
      DeleteHelper::instance()->onCascadeLogicalDelete('students_competences','id',$competence->id);

        Alert::success('Exitosamente','Competencia eliminada del estudiante')->autoclose(4000);

        insertToLog(Auth::user()->id, 'deleted', $competence->id, "competencia del estudiante");
        $student = students_competences::where('id','=',$competence->id)->first();
        return redirect()->route('students.show', ['id' => $student->student_id]);
    }

    public function restoreStudentCompetence(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('students_competences','id',$request->id);

        Alert::success('Exitosamente','Competencia restaurada en el estudiante')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "competencia del estudiante");
        $student = students_competences::find($request->id);
        return redirect()->route('students.show', ['id' => $student->student_id]);
    }

    public function asignar($id){
      $competences_asigned = DB::table('competences')
              ->join('students_competences','competences.id','=','students_competences.competence_id')
              ->where('students_competences.student_id','=',$id)
              ->get();

      $competences_not_asigned = competences::whereNotExists(function($query) use ($id){
             $query->select(DB::raw(1))
                ->from('students_competences')
                ->whereRaw('competences.id = students_competences.competence_id')
                ->where('students_competences.student_id','=',$id);
              })->where('competences.deleted','=',0)->get();

      $num_student_competences = students_competences::where('student_id','=',$id)->count();
      $num_competences = competences::count();

      return view('competences.asignar')->with('id',$id)
                                        ->with('competences_asigned',$competences_asigned)
                                        ->with('competences_not_asigned',$competences_not_asigned)
                                        ->with('num_student_competences',$num_student_competences)
                                        ->with('num_competences',$num_competences);
    }

    public function guardarAsignaciones(Request $request,$id){
      if($request->competences_not_asigned==NULL){
          Alert::error('Se debe seleccionar almenos una competencia para asignar', 'Error')->autoclose(4000);
          return redirect()->route('competences.asignar',['id' => $id]);
      }
      
      $competences_ids = $request->competences_not_asigned;

      foreach ($competences_ids as $competence) {

        $student_competences = new students_competences();
        $student_competences->student_id = $id;
        $student_competences->competence_id = $competence;
        $student_competences->status = 1;
        $student_competences->save();
        insertToLog(Auth::user()->id, 'added', $competence, "competencia del estudiante ".$id);

      }

      Alert::success('Exitosamente','Competencias asignadas')->autoclose(4000);
      return redirect()->route('students.show', ['id' => $id]);
    }

    public function solicitudes(){
      if(Auth::user()->type == 5){
        $students_competences = DB::table('students_competences as solicitudes')
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
                  ->get();
      }else{
          $students_competences = DB::table('students_competences as solicitudes')
          ->join('siita_db.users as users','solicitudes.student_id','=','users.university_id')
          ->join('competences','solicitudes.competence_id','=','competences.id')
          ->select('solicitudes.*',
                  'users.first_name',
                  'users.last_name',
                  'users.second_last_name',
                  'competences.name')
                  ->where('solicitudes.status','=',0)
                  ->get();
      }
      return view('competences.solicitudes')->with('students_competences',$students_competences);
    }

    public function answerAccepted(students_competences $competence){
      $competence->status = 1;
      if($competence->update()){
        Alert::success('Exitosamente','Solicitud aceptada')->autoclose(4000);
        insertToLog(Auth::user()->id, 'added', $competence->id, "competencia del estudiante");

        return redirect()->route('students.show', ['id' => $competence->student_id]);
      }else{
        Alert::error('No se pudo aceptar la solicitud', 'Error')->autoclose(4000);        
        return redirect()->route('students.show', ['id' => $competence->student_id]);
      }
    }

    public function answerRejected(students_competences $competence){

      if($competence->delete()){
        Alert::success('Exitosamente','Solicitud rechazada')->autoclose(4000);
        insertToLog(Auth::user()->id, 'deleted', $competence->id, "competencia del estudiante");

        return redirect()->route('students.show', ['id' => $competence->student_id]);
      }else{
        Alert::error('No se pudo rechazar la solicitud', 'Error')->autoclose(4000);        
        return redirect()->route('students.show', ['id' => $competence->student_id]);
      }
    }
  
    public function not_evaluated(){
       $competences_tutor = DB::table("students_competences")
                ->join("competences","students_competences.competence_id","=","competences.id")
                ->join("siita_db.users as users","students_competences.student_id","=","users.university_id")
                ->join("siita_db.students as students","users.id","=","students.user_id")
                ->select("users.*",
                         "competences.name as nameCompetence",
                         "students_competences.id as id_students_competences")
                  ->where("students.tutor_user_id","=",Auth::user()->id)
                  ->where("students_competences.deleted","=",0)
                  ->where("students_competences.status","=",1)
                  ->where("students_competences.evaluated","=",0)->get();
      return view("competences.notEvaluated")->with("competences_tutor",$competences_tutor);
    }
}



