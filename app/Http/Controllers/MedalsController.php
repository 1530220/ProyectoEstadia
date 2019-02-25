<?php

namespace App\Http\Controllers;

use Alert;
use App\Medals;
use App\students_medals;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class MedalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medals = DB::table('medals')->where('id','!=','4294967295')->get();

        return view('medals.list')
          ->with('medals',$medals)
          ->with('title', 'Listado de Medallas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medals.create');
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
  
          //Se crea una nueva medalla
          $medals = new Medals;
  
          //Se obtienen los valores de la vista
          $medals->id = Input::get('id');
          $medals->name = Input::get('name');
          $medals->description = Input::get('description');
          $medals->image = Input::get('medal_img');
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($medals->save()) {
            Alert::success('Exitosamente','Medalla Registrada');
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "medallla");
  
            return redirect()->route('medals.list');
          } else {
            Alert::error('No se registro la medalla', 'Error');
            return redirect()->route('medals.list');
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
            return redirect()->route('medals.list');

        $medal = Medals::find($id);

        return view('medals.show', compact('medal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Medals $medal)
    {
        if($medal->id==4294967295)
            return redirect()->route('medals.list');
        
        return view('medals.edit', ['medal' => $medal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Medals $medal)
    {
      //Validaciones
      $data = request()->validate([
        'medal_id' => 'required|max:4294967295|min:1|numeric',
        'name' => 'required|max:128',
        'description' => 'required',
      ],[
        'medal_id.required' => ' * Este campo es obligatorio.',
        'medal_id.max' => ' * El valor máximo de este campo es 4294967294.',
        'medal_id.min' => ' * El valor mínimo de este campo es 1.',
        'medal_id.numeric' => ' * Este campo es de tipo numérico.',
        'name.required' => ' * Este campo es obligatorio.',
        'name.max' => ' * Este campo debe contener sólo 128 caracteres.',
        'description.required' => ' * Este campo es obligatorio.',
      ]);

      $medal->id = Input::get('medal_id');
      $medal->name = Input::get('name');
      $medal->description = Input::get('description');

      //Se almacena y se muestra mensaje de exito
      if ($medal->update()) {
        Alert::success('Exitosamente','Medalla Modificada');

        insertToLog(Auth::user()->id, 'updated', Input::get('sector_id'), "sector");

        return redirect()->route('medals.list');
      } else {
        Alert::error('No se modifico el sector', 'Error');
        return redirect()->route('medals.list');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medals $medal)
    {
      DeleteHelper::instance()->onCascadeLogicalDelete('medals','id',$medal->id);

      Alert::success('Exitosamente','Medalla Eliminada');

      insertToLog(Auth::user()->id, 'deleted', $medal->id, "medalla");

      return redirect()->route('medals.show', ['id' => $medal->user_id]);
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('medals','id',$request->id);

        Alert::success('Exitosamente','Medalla Restaurada');

        insertToLog(Auth::user()->id, 'recover', $request->id, "medalla");
        $medal = Medals::find($request->id);
        return redirect()->route('medals.show', ['id' => $medal->user_id]);
    }

    public function asignar($id){
      $medals_asigned = DB::table('medals')
              ->join('students_medals','medals.id','=','students_medals.medal_id')
              ->where('students_medals.student_id','=',$id)
              ->get();

      $medals_not_asigned = Medals::whereNotExists(function($query) use ($id){
             $query->select(DB::raw(1))
                ->from('students_medals')
                ->whereRaw('medals.id = students_medals.medal_id')
                ->where('students_medals.student_id','=',$id);
              })->where('medals.deleted','=',0)
              ->get();

      return view('medals.asignar')->with('id',$id)
                                        ->with('medals_asigned',$medals_asigned)
                                        ->with('medals_not_asigned',$medals_not_asigned);
    }

    public function guardarAsignaciones(Request $request,$id){
      $medals_ids = $request->medals_not_asigned;

      foreach ($medals_ids as $medals) {

        $student_medals = new students_medals();
        $student_medals->student_id = $id;
        $student_medals->medal_id = $medals;
        $student_medals->save();
        insertToLog(Auth::user()->id, 'added', $medals, "medalla a estudiante {$id}");

      }

      Alert::success('Exitosamente','Medallas asignadas');
      return redirect()->route('students.show', ['id' => $id]);
    }

    public function destroyStudentMedal(students_medals $medal){
      DeleteHelper::instance()->onCascadeLogicalDelete('students_medals','id',$medal->id);

        Alert::success('Exitosamente','Medalla eliminada del estudiante');

        insertToLog(Auth::user()->id, 'deleted', $medal->id, "medalla del estudiante {$medal->student_id}");
        return redirect()->route('students.show', ['id' => $medal->student_id]);
    }

    public function restoreStudentMedal(Request $request){
      DeleteHelper::instance()->restoreLogicalDelete('students_medals','id',$request->id);

        Alert::success('Exitosamente','Medalla restaurada en el estudiante');
        $student = students_medals::find($request->id);

        insertToLog(Auth::user()->id, 'recover', $request->id, "medalla del estudiante {$student->student_id}");
        return redirect()->route('students.show', ['id' => $student->student_id]);
    }
}
