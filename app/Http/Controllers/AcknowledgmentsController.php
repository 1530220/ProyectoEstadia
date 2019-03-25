<?php

namespace App\Http\Controllers;

use Alert;
use App\acknowledgments;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class AcknowledgmentsController extends Controller
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
        return view('acknowledgments.create')->with('students',$students);
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
            'fecha' => 'required',
            'description' => 'required',
            'emisor' => 'required',
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
            'description.required' => ' * Este campo es obligatorio.',
            'fecha.required' => ' * Este campo es obligatorio.',
            'emisor.required' => ' * Este campo es obligatorio.',
          ]);

          $fecha_actual=date("Y-m-d");

          if (Input::get('fecha')>$fecha_actual){
            Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          }
          //Se crea un nuevo reconocimiento
          $acknowledgments = new acknowledgments;
  
          //Se obtienen los valores de la vista
          $acknowledgments->id = Input::get('id');
          $acknowledgments->title = Input::get('name');
          $acknowledgments->date = Input::get('fecha');
          $acknowledgments->transmitter = Input::get('emisor');
          $acknowledgments->description = Input::get('description');
          $acknowledgments->user_id = Input::get('matricula');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($acknowledgments->save()) {
            Alert::success('Exitosamente','Reconocimiento Registrado')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "reconocimiento");
  
            return redirect()->route('students.show', ['id' => Input::get('matricula')]);
          } else {
            Alert::error('No se registro el reconocimiento', 'Error')->autoclose(4000);
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
        $acknowledgment = DB::table('acknowledgments')->where('id','=',$id)->first();

        return view('acknowledgments.show', compact('acknowledgment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(acknowledgments $acknowledgment)
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        return view('acknowledgments.edit')->with('acknowledgment',$acknowledgment)->with('students',$students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(acknowledgments $acknowledgment)
    {
      $data = request()->validate([
        'id' => 'required|max:4294967295|min:1|numeric',
        'name' => 'required|max:128',
        'fecha' => 'required',
        'description' => 'required',
        'emisor' => 'required',
      ],[
        'id.required' => ' * Este campo es obligatorio.',
        'id.max' => ' * El valor máximo de este campo es 4294967294.',
        'id.min' => ' * El valor mínimo de este campo es 1.',
        'id.numeric' => ' * Este campo es de tipo numérico.',
        'name.required' => ' * Este campo es obligatorio.',
        'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
        'description.required' => ' * Este campo es obligatorio.',
        'fecha.required' => ' * Este campo es obligatorio.',
        'emisor.required' => ' * Este campo es obligatorio.',
      ]);

      $fecha_actual=date("Y-m-d");

      if (Input::get('fecha')>$fecha_actual){
        Alert::error('Fecha de finalización excede a la fecha actual', 'Error')->autoclose(4000);
        return redirect()->route('students.show', ['id' => Input::get('matricula')]);
      }
      //Se obtienen los valores de la vista
      $acknowledgment->id = Input::get('id');
      $acknowledgment->title = Input::get('name');
      $acknowledgment->date = Input::get('fecha');
      $acknowledgment->transmitter = Input::get('emisor');
      $acknowledgment->description = Input::get('description');
      $acknowledgment->user_id = Input::get('matricula');

      //Se almacena y se muestran mensajes en caos de registro exitoso
      if ($acknowledgment->save()) {
        Alert::success('Exitosamente','Reconocimiento Modificado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'updated', Input::get('id'), "reconocimiento");

        return redirect()->route('students.show', ['id' => Input::get('matricula')]);
      } else {
        Alert::error('No se modificó el reconocimiento', 'Error')->autoclose(4000);
        return redirect()->route('students.show', ['id' => Input::get('matricula')]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(acknowledgments $acknowledgment)
    {
      DeleteHelper::instance()->onCascadeLogicalDelete('acknowledgments','id',$acknowledgment->id);

      Alert::success('Exitosamente','Reconocimiento Eliminado')->autoclose(4000);

      insertToLog(Auth::user()->id, 'deleted', $acknowledgment->id, "reconocimiento");

      return redirect()->route('students.show', ['id' => $acknowledgment->user_id]);
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('acknowledgments','id',$request->id);

        Alert::success('Exitosamente','Reconocimiento Restaurado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "reconocimiento");
        $acknowledgment = acknowledgments::find($request->id);
        return redirect()->route('students.show', ['id' => $acknowledgment->user_id]);
    }
}
