<?php

namespace App\Http\Controllers;

use Alert;
use App\Skills;
use App\students_skills;
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




    public function editStudentSkill($id)
    {
      $skills = DB::table('students_skills')
        ->join('skills','students_skills.skill_id','=','skills.id')
        ->select('students_skills.*',
                'skills.name')
                ->where('students_skills.user_id','=',$id)->get();
      $num_skills = DB::table('students_skills')->where('user_id','=',$id)->count();
      return view('skills.student_skills_edit', ['skills' => $skills,'id'=>$id,'num_skills'=>$num_skills]);
    }

   

    public function updateStudentSkill(Request $request,$id)
    {
      $num_skills = DB::table('students_skills')->where('user_id','=',$id)->count();

      $skills = DB::table('students_skills')->where('user_id','=',$id)->get();

      foreach ($skills as $skill) {
        $update_skill = students_skills::find($skill->id);
        $update_skill->score = Input::get($skill->id);
        $update_skill->update();
        insertToLog(Auth::user()->id, 'updated', $skill->id, "puntuacion de habilidad");
      }
        Alert::success('Exitosamente','Puntuaciones Modificadas');

        return redirect()->route('students.show', ['id' => $id]);
    }

    
    public function destroyStudentSkill(students_skills $skill)
    {
      DeleteHelper::instance()->onCascadeLogicalDelete('students_skills','id',$skill->id);

        Alert::success('Exitosamente','Habilidad eliminada del estudiante');

        insertToLog(Auth::user()->id, 'deleted', $skill->id, "habilidad del estudiante");
        $student = students_skills::where('id','=',$skill->id)->first();
        return redirect()->route('students.show', ['id' => $student->user_id]);
    }

    public function restoreStudentSkill(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('students_skills','id',$request->id);

        Alert::success('Exitosamente','Habilidad restaurada en el estudiante');

        insertToLog(Auth::user()->id, 'recover', $request->id, "habilidad del estudiante");
        $student = students_skills::find($request->id);
        return redirect()->route('students.show', ['id' => $student->user_id]);
    }

    public function asignar($id){
      $skills_asigned = DB::table('skills')
              ->join('students_skills','skills.id','=','students_skills.skill_id')
              ->where('students_skills.user_id','=',$id)
              ->get();

      $skills_not_asigned = Skills::whereNotExists(function($query) use ($id){
             $query->select(DB::raw(1))
                ->from('students_skills')
                ->whereRaw('skills.id = students_skills.skill_id')
                ->where('students_skills.user_id','=',$id);
              })->where('skills.deleted','=',0)
              ->get();

      $num_student_skills = students_skills::where('user_id','=',$id)->count();
      $num_skills = Skills::count();

      return view('skills.asignar')->with('id',$id)
                                        ->with('skills_asigned',$skills_asigned)
                                        ->with('skills_not_asigned',$skills_not_asigned)
                                        ->with('num_student_skills',$num_student_skills)
                                        ->with('num_skills',$num_skills);
    }

    public function guardarAsignaciones(Request $request,$id){
      if($request->skills_not_asigned==NULL){
          Alert::error('Se debe seleccionar almenos una habilidad para asignar', 'Error');
          return redirect()->route('skills.asignar',['id' => $id]);
      }
      
      $skills_ids = $request->skills_not_asigned;

      foreach ($skills_ids as $skill) {

        $student_skills = new students_skills();
        $student_skills->user_id = $id;
        $student_skills->skill_id = $skill;
        $student_skills->save();
        insertToLog(Auth::user()->id, 'added', $skill, "habilidad del estudiante");

      }

      Alert::success('Exitosamente','Habilidades asignadas');
      return redirect()->route('students.show', ['id' => $id]);
    }

}
