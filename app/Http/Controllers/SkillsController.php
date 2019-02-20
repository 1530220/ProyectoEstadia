<?php

namespace App\Http\Controllers;

use Alert;
use App\Skills;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = DB::table('skills')->where('id','!=','4294967295')->get();

        return view('skills.list')
          ->with('skills',$skills)
          ->with('title', 'Listado de Habilidades');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skills.create');
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
          $skills = new Skills;
  
          //Se obtienen los valores de la vista
          $skills->id = Input::get('id');
          $skills->name = Input::get('name');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($skills->save()) {
            Alert::success('Exitosamente','Habilidad Registrada');
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "habilidad");
  
            return redirect()->route('skills.list');
          } else {
            Alert::error('No se registro la habilidad', 'Error');
            return redirect()->route('skills.list');
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
        //Se excluye la habilidad del sistema(sin asignar)
        if($id==4294967295)
            return redirect()->route('skills.list');

        $skill = Skills::find($id);

        return view('skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Skills $skill)
    {
        if($skill->id==4294967295)
            return redirect()->route('skills.list');
        
        return view('skills.edit', ['skill' => $skill]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Skills $skill)
    {
        if($skill->id==4294967295)
            return redirect()->route('skills.list');

        //Validaciones
        $data = request()->validate([
          'skill_id' => 'required|max:4294967295|min:1|numeric',
          'name' => 'required|max:128',
        ],[
          'skill_id.required' => ' * Este campo es obligatorio.',
          'skill_id.max' => ' * El valor máximo de este campo es 4294967294.',
          'skill_id.min' => ' * El valor mínimo de este campo es 1.',
          'skill_id.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
        ]);

        $skill->id = Input::get('skill_id');
        $skill->name = Input::get('name');

        //Se almacena y se muestra mensaje de exito
        if ($skill->update()) {
          Alert::success('Exitosamente','Habilidad Modificada');

          insertToLog(Auth::user()->id, 'updated', Input::get('skill_id'), "habilidad");

          return redirect()->route('skills.list');
        } else {
          Alert::error('No se modifico la habilidad', 'Error');
          return redirect()->route('skills.list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skills $skill)
    {
        if($skill->id==4294967295)
            return redirect()->route('skills.list');

//        DB::update('UPDATE students SET career_id = ? WHERE career_id = ?', [4294967295,$career->id]);

        DeleteHelper::instance()->onCascadeLogicalDelete('skills','id',$skill->id);

        Alert::success('Exitosamente','Habilidad Eliminada');

        insertToLog(Auth::user()->id, 'deleted', $skill->id, "habilidad");

        return redirect()->route('skills.list');
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('skills','id',$request->id);

        Alert::success('Exitosamente','Habilidad Restaurada');

        insertToLog(Auth::user()->id, 'recover', $request->id, "habilidad");

        return redirect()->route('skills.list');
    }
}
