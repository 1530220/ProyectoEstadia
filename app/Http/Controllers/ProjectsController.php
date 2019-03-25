<?php

namespace App\Http\Controllers;

use Alert;
use App\project;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        return view('projects.create')->with('students',$students);
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
            'inicio' => 'required',
            'fin' => 'required',
            'description' => 'required',
            'lider' => 'required',
            'empresa' => 'required',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'description.required' => ' * Este campo es obligatorio.',
            'inicio.required' => ' * Este campo es obligatorio.',
            'fin.required' => ' * Este campo es obligatorio.',
            'lider.required' => ' * Este campo es obligatorio.',
            'empresa.required' => ' * Este campo es obligatorio.',
          ]);
            
          $fecha_actual=date("Y-m-d");

          if(Input::get('inicio')>= Input::get('fin')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }else if (Input::get('fin')>$fecha_actual){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }

          $project = new project;
  
          //Se obtienen los valores de la vista
          $project->id = Input::get('id');
          $project->name = Input::get('name');
          $project->start_date = Input::get('inicio');
          $project->finish_date = Input::get('fin');
          $project->description = Input::get('description');
          $project->user_id = Input::get('matricula');
          $project->boss = Input::get('lider');
          $project->company = Input::get('empresa');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($project->save()) {
            Alert::success('Exitosamente','Proyecto Registrado')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "proyecto");
  
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          } else {
            Alert::error('No se registro el proyecto', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
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

        $project = project::find($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        return view('projects.edit')->with('project',$project)->with('students',$students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(project $project)
    {
        $data = request()->validate([
            'id' => 'required|max:4294967295|min:1|numeric',
            'name' => 'required|max:128',
            'inicio' => 'required',
            'fin' => 'required',
            'description' => 'required',
            'lider' => 'required',
            'empresa' => 'required',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'description.required' => ' * Este campo es obligatorio.',
            'inicio.required' => ' * Este campo es obligatorio.',
            'fin.required' => ' * Este campo es obligatorio.',
            'lider.required' => ' * Este campo es obligatorio.',
            'empresa.required' => ' * Este campo es obligatorio.',
          ]);
            
          $fecha_actual=date("Y-m-d");

          if(Input::get('inicio')>= Input::get('fin')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }else if (Input::get('fin')>$fecha_actual){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }

  
          //Se obtienen los valores de la vista
          $project->id = Input::get('id');
          $project->name = Input::get('name');
          $project->start_date = Input::get('inicio');
          $project->finish_date = Input::get('fin');
          $project->description = Input::get('description');
          $project->user_id = Input::get('matricula');
          $project->boss = Input::get('lider');
          $project->company = Input::get('empresa');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($project->update()) {
            Alert::success('Exitosamente','Proyecto Modificado')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "proyecto");
  
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          } else {
            Alert::error('No se modificó el proyecto', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        DeleteHelper::instance()->onCascadeLogicalDelete('projects','id',$project->id);

        Alert::success('Exitosamente','Proyecto Eliminado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'deleted', $project->id, "proyecto");

        return redirect()->route('students.show', ['id' => $project->user_id]);
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('projects','id',$request->id);

        Alert::success('Exitosamente','Proyecto Restaurado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "proyecto");
        $project = project::find($request->id);
        return redirect()->route('students.show', ['id' => $project->user_id]);
    }
}
