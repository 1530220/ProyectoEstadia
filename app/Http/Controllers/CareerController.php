<?php

namespace App\Http\Controllers;

use Alert;
use App\Career;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CareerController extends Controller
{
    /**
     * Se enlistan todas las carreras.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Consulta de carreras a la BD excluyendo la carrera del sistema
      $careers = DB::table('careers')->where('id','!=','4294967295')->get();

      return view('careers.list')
        ->with('careers',$careers)
        ->with('title', 'Listado de Carreras');
    }

    /**
     * Se muestra la vista para la creacion de una nueva carrera.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('careers.create');
    }

    /**
     * Se almacena la carrera en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validaciones
        $data = request()->validate([
          'id' => 'required|max:4294967295|min:1|numeric',
          'name' => 'required|max:128',
          'abbreviation' => 'max:28',
        ],[
          'id.required' => ' * Este campo es obligatorio.',
          'id.max' => ' * El valor máximo de este campo es 4294967294.',
          'id.min' => ' * El valor mínimo de este campo es 1.',
          'id.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'abbreviation.max' => ' * Este campo debe contener sólo 28 caracteres.',
        ]);

        //Se crea una nueva carrera
        $career = new Career;

        //Se obtienen los valores de la vista
        $career->id = Input::get('id');
        $career->name = Input::get('name');
        $career->abbreviation = Input::get('abbreviation');

        //Se almacena y se muestran mensajes en caos de registro exitoso
        if ($career->save()) {
          Alert::success('Exitosamente','Carrera Registrada');

          insertToLog(Auth::user()->id, 'added', Input::get('id'), "carrera");

          return redirect()->route('careers.list');
        } else {
          Alert::error('No se registro la carrera', 'Error');
          return redirect()->route('careers.list');
        }
    }

    /**
     * Se muestran los detalles de la carrera, seleccionada.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Se excluye la carrera del sistema(sin asignar)
        if($id==4294967295)
            return redirect()->route('careers.list');

        $career = Career::find($id);

        return view('careers.show', compact('career'));
    }

    /**
     * Se muestra la vista para la edicion de la carrera
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        //Se excluye la carrera del sistema(sin asignar)
        if($career->id==4294967295)
            return redirect()->route('careers.list');

        return view('careers.edit', ['career' => $career]);
    }

    /**
     * Se actualiza la carrera almacenada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Career $career)
    {
        //Se excluye la carrera del sistema(sin asignar)
        if($career->id==4294967295)
            return redirect()->route('careers.list');

        //Validaciones
        $data = request()->validate([
          'career_id' => 'required|max:4294967295|min:1|numeric',
          'name' => 'required|max:128',
          'abbreviation' => 'max:28',
        ],[
          'career_id.required' => ' * Este campo es obligatorio.',
          'career_id.max' => ' * El valor máximo de este campo es 4294967294.',
          'career_id.min' => ' * El valor mínimo de este campo es 1.',
          'career_id.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'abbreviation.max' => ' * Este campo debe contener sólo 28 caracteres.',
        ]);

        $career->id = Input::get('career_id');
        $career->name = Input::get('name');
        $career->abbreviation = Input::get('abbreviation');

        //Se almacena y se muestra mensaje de exito
        if ($career->update()) {
          Alert::success('Exitosamente','Carrera Modificada');

          insertToLog(Auth::user()->id, 'updated', Input::get('career_id'), "carrera");

          return redirect()->route('careers.list');
        } else {
          Alert::error('No se modifico la carrera', 'Error');
          return redirect()->route('careers.list');
        }
    }

    /**
     * Eliminar una carrera de la manera logica
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        //Se excluye la carrera del sistema
        if($career->id==4294967295)
            return redirect()->route('careers.list');

        DB::update('UPDATE students SET career_id = ? WHERE career_id = ?', [4294967295,$career->id]);

        DeleteHelper::instance()->onCascadeLogicalDelete('careers','id',$career->id);

        Alert::success('Exitosamente','Carrera Eliminada');

        insertToLog(Auth::user()->id, 'deleted', $career->id, "carrera");

        return redirect()->route('careers.list');
    }
    /**
     * Permite restaurar la carrera del eliminado logico
     * @param  \Illuminate\Http\Request  $request
     */
    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('careers','id',$request->id);

        Alert::success('Exitosamente','Carrera Restaurada');

        insertToLog(Auth::user()->id, 'recover', $request->id, "carrera");

        return redirect()->route('careers.list');
    }
}
