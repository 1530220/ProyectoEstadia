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

        return view('competences.list')
          ->with('competences',$competences)
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
            
            Alert::success('Exitosamente','Competencia Registrada');
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "competencia");
  
            return redirect()->route('competences.list');
          } else {
            Alert::error('No se registro la competencia', 'Error');
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
          Alert::success('Exitosamente','Competencia Modificada');

          insertToLog(Auth::user()->id, 'updated', Input::get('competence_id'), "competencia");

          return redirect()->route('competences.list');
        } else {
          Alert::error('No se modifico la competencia', 'Error');
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

        Alert::success('Exitosamente','Competencia Eliminada');

        insertToLog(Auth::user()->id, 'deleted', $competence->id, "competencia");

        return redirect()->route('competences.list');
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('competences','id',$request->id);

        Alert::success('Exitosamente','Competencia Restaurada');

        insertToLog(Auth::user()->id, 'recover', $request->id, "competencia");

        return redirect()->route('competences.list');
    }

    public function editStudentCompetence(competences $competence)
    {
       
    }

    public function updateStudentCompetence(competences $competence)
    {
      
    }

    public function destroyStudentCompetence(students_competences $competence)
    {
      DeleteHelper::instance()->onCascadeLogicalDelete('students_competences','id',$competence->id);

        Alert::success('Exitosamente','Competencia eliminada del estudiante');

        insertToLog(Auth::user()->id, 'deleted', $competence->id, "competencia del estudiante");
        $student = students_competences::where('id','=',$competence->id)->first();
        return redirect()->route('students.show', ['id' => $student->student_id]);
    }

    public function restoreStudentCompetence(Request $request)
    {

    }
}
