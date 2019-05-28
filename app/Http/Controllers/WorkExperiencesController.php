<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Country;
use App\State;
use App\City;
use App\work_experience;
class WorkExperiencesController extends Controller
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
        $countries = Country::pluck('name','id');        

        return view('work_experiences.create')->with('students',$students)->with('countries',$countries);
    }

    public function getStates(Request $request, $id){
        if($request->ajax()){
            $state = State::states($id);
            return response()->json($state);
        }
    }

    public function getCities(Request $request, $id){
        if($request->ajax()){
            $city = City::cities($id);
            return response()->json($city);
        }
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
            'position' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'description' => 'required',
            'company' => 'required',
            'country' => 'required|max:246|min:1',
            'state' => 'required|max:4121|min:1',
            'city' => 'required|max:48356|min:1',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'position.required' => ' * Este campo es obligatorio.',
            'description.required' => ' * Este campo es obligatorio.',
            'inicio.required' => ' * Este campo es obligatorio.',
            'fin.required' => ' * Este campo es obligatorio.',
            'company.required' => ' * Este campo es obligatorio.',
            'country.required' => ' * Este campo es obligatorio.',
            'country.max' => ' * Favor de seleccionar un país.',
            'country.min' => ' * Favor de seleccionar un país.',
            'state.required' => ' * Este campo es obligatorio.',
            'state.max' => ' * Favor de seleccionar un estado.',
            'state.min' => ' * Favor de seleccionar un estado.',
            'city.required' => ' * Este campo es obligatorio.',
            'city.max' => ' * Favor de seleccionar una ciudad.',
            'city.min' => ' * Favor de seleccionar una ciudad.',
          ]);

          if(Input::get('country') == "0"){
            Alert::error('Se debe seleccionar un pais', 'Error')->autoclose(4000);
            return redirect()->route('work_experiences.create');
          }
          
          if(Input::get('city') == "placeholder"){
            Alert::error('Se debe seleccionar una ciudad', 'Error')->autoclose(4000);
            return redirect()->route('work_experiences.create');          
          }
          
          
          $fecha_actual=date("Y-m-d");

          if(Input::get('inicio')>= Input::get('fin')){
            Alert::error('Fecha de inicio no puede ser mayor a la de finalización', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }else if (Input::get('fin')>$fecha_actual){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }
  
          //Se crea una nueva carrera
          $work_experience = new work_experience;
  
          //Se obtienen los valores de la vista
          $work_experience->id = Input::get('id');
          $work_experience->user_id = Input::get('matricula');
          $work_experience->position = Input::get('position');
          $work_experience->company = Input::get('company');
          $work_experience->country = Input::get('country');
          $work_experience->state = Input::get('state');
          $work_experience->city = Input::get('city');
          $work_experience->start_date = Input::get('inicio');
          $work_experience->finish_date = Input::get('fin');
          $work_experience->description = Input::get('description');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($work_experience->save()) {
            Alert::success('Exitosamente','Experiencia Laboral Registrada')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "experiencia laboral");
  
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          } else {
            Alert::error('No se registro la experiencia laboral', 'Error')->autoclose(4000);
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
        $work_experience = DB::table('work_experiences')->where('id','=',$id)->first();
        $pais = Country::find($work_experience->country);
        $estado = State::find($work_experience->state);
        $ciudad = City::find($work_experience->city);
        if($pais->name == "Seleccionar país"){
          $name_pais = "No se selecciono un país";
        }else{
          $name_pais = $pais->name;
        }
        if($estado == NULL){
          $name_estado = "No se selecciono un estado";
        }else{
          $name_estado = $estado->name;
        }
        if($ciudad == NULL){
          $name_ciudad = "No se selecciono una ciudad";
        }else{
          $name_ciudad = $ciudad->name;
        }
        return view('work_experiences.show', compact('work_experience','name_pais','name_estado','name_ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(work_experience $work_experience)
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        $countries = Country::pluck('name','id');
        $states = State::all()->where('country_id','=',$work_experience->country)->pluck('name','id');
        $cities = City::all()->where('state_id','=',$work_experience->state)->pluck('name','id');
        return view('work_experiences.edit')->with('work_experience',$work_experience)->with('students',$students)->with('countries',$countries)->with('states',$states)->with('cities',$cities);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(work_experience $work_experience)
    {
        $data = request()->validate([
            'id' => 'required|max:4294967295|min:1|numeric',
            'position' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'description' => 'required',
            'company' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'position.required' => ' * Este campo es obligatorio.',
            'description.required' => ' * Este campo es obligatorio.',
            'inicio.required' => ' * Este campo es obligatorio.',
            'fin.required' => ' * Este campo es obligatorio.',
            'company.required' => ' * Este campo es obligatorio.',
            'country.required' => ' * Este campo es obligatorio.',
            'state.required' => ' * Este campo es obligatorio.',
            'city.required' => ' * Este campo es obligatorio.',
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
          $work_experience->id = Input::get('id');
          $work_experience->user_id = Input::get('matricula');
          $work_experience->position = Input::get('position');
          $work_experience->company = Input::get('company');
          $work_experience->country = Input::get('country');
          $work_experience->state = Input::get('state');
          $work_experience->city = Input::get('city');
          $work_experience->start_date = Input::get('inicio');
          $work_experience->finish_date = Input::get('fin');
          $work_experience->description = Input::get('description');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($work_experience->update()) {
            Alert::success('Exitosamente','Experiencia Laboral Modificada')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "experiencia laboral");
  
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          } else {
            Alert::error('No se modificó la experiencia laboral', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(work_experience $work_experience)
    {
        DeleteHelper::instance()->onCascadeLogicalDelete('work_experiences','id',$work_experience->id);

        Alert::success('Exitosamente','Experiencia Laboral Eliminada')->autoclose(4000);

        insertToLog(Auth::user()->id, 'deleted', $work_experience->id, "experiencia laboral");

        return redirect()->route('students.show', ['id' => $work_experience->user_id]);
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('work_experiences','id',$request->id);

        Alert::success('Exitosamente','Experiencia Laboral Restaurada')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "experiencia laboral");
        $work_experience = work_experience::find($request->id);
        return redirect()->route('students.show', ['id' => $work_experience->user_id]);
    }
}
