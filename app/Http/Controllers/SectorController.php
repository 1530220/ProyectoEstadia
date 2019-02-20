<?php

namespace App\Http\Controllers;

use Alert;
use App\Sectors;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = DB::table('sectors')->where('id','!=','4294967295')->get();

        return view('sectors.list')
          ->with('sectors',$sectors)
          ->with('title', 'Listado de Sectores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sectors.create');
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
            'description' => 'required',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'description.required' => ' * Este campo es obligatorio.',
          ]);
  
          //Se crea una nueva carrera
          $sectors = new Sectors;
  
          //Se obtienen los valores de la vista
          $sectors->id = Input::get('id');
          $sectors->name = Input::get('name');
          $sectors->description = Input::get('description');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($sectors->save()) {
            Alert::success('Exitosamente','Sector Registrado');
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "sector");
  
            return redirect()->route('sectors.list');
          } else {
            Alert::error('No se registro el sector', 'Error');
            return redirect()->route('sectors.list');
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
            return redirect()->route('sectors.list');

        $sector = Sectors::find($id);

        return view('sectors.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sectors $sector)
    {
        if($sector->id==4294967295)
            return redirect()->route('sectors.list');
        
        return view('sectors.edit', ['sector' => $sector]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Sectors $sector)
    {
        if($sector->id==4294967295)
            return redirect()->route('sectors.list');

        //Validaciones
        $data = request()->validate([
          'sector_id' => 'required|max:4294967295|min:1|numeric',
          'name' => 'required|max:128',
          'description' => 'required',
        ],[
          'skill_id.required' => ' * Este campo es obligatorio.',
          'skill_id.max' => ' * El valor máximo de este campo es 4294967294.',
          'skill_id.min' => ' * El valor mínimo de este campo es 1.',
          'skill_id.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'description.required' => ' * Este campo es obligatorio.',
        ]);

        $sector->id = Input::get('sector_id');
        $sector->name = Input::get('name');
        $sector->description = Input::get('description');

        //Se almacena y se muestra mensaje de exito
        if ($sector->update()) {
          Alert::success('Exitosamente','Sector Modificado');

          insertToLog(Auth::user()->id, 'updated', Input::get('sector_id'), "sector");

          return redirect()->route('sectors.list');
        } else {
          Alert::error('No se modifico el sector', 'Error');
          return redirect()->route('sectors.list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sectors $sector)
    {
        if($sector->id==4294967295)
            return redirect()->route('sectors.list');

//        DB::update('UPDATE students SET career_id = ? WHERE career_id = ?', [4294967295,$career->id]);

        DeleteHelper::instance()->onCascadeLogicalDelete('sectors','id',$sector->id);

        Alert::success('Exitosamente','Sector Eliminado');

        insertToLog(Auth::user()->id, 'deleted', $sector->id, "sector");

        return redirect()->route('sectors.list');
    }


    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('sectors','id',$request->id);

        Alert::success('Exitosamente','Sector Restaurado');

        insertToLog(Auth::user()->id, 'recover', $request->id, "sector");

        return redirect()->route('sectors.list');
    }
}
