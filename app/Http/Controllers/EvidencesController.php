<?php

namespace App\Http\Controllers;

use Alert;
use App\Evidences;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class EvidencesController extends Controller
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
    public function create($id)
    {
        $matricula = $id;
        return view("evidences.create")->with("matricula",$matricula);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
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
  
          $evidence = new Evidences;
          
          $evidence->id = Input::get("id");
          $evidence->student_id = $id;
          $evidence->name = Input::get("name");
      
         
          $path=$request->file('archivo')->store('/public/evidences');
          $evidence->path = 'storage/evidences/'.Input::file('archivo')->hashName();
         

          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($evidence->save()) {
            Alert::success('Exitosamente','Evidencia Almacenada')->autoclose(4000);
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "evidencia");
  
            return redirect()->route('students.show', ['id' => $id]);
          } else {
            Alert::error('No se cargo la evidencia', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => $id]);
          }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evidences $evidence)
    {
        if($evidence->delete()){
          unlink(public_path()."/".$evidence->path);
          Alert::success('Exitosamente','Evidencia Eliminada')->autoclose(4000);

          insertToLog(Auth::user()->id, 'deleted', $evidence->id, "evidencia");

          return redirect()->route('students.show', ['id' => $evidence->student_id]);  
        }else{
          Alert::error('No se elimino la evidencia', 'Error')->autoclose(4000);
            return redirect()->route('students.show', ['id' => $evidence->student_id]);  
        }
    }
  
     protected function downloadFile($src){
        if(is_file($src)){
          $finfo=finfo_open(FILEINFO_MIME_TYPE);
          $content_type=finfo_file($finfo,$src);
          finfo_close($finfo);
          $file_name=basename($src).PHP_EOL;
          $size=filesize($src);
          header("Content-Type: $content_type");
          header("Content-Disposition: attachment; filename=$file_name");
          header("Content-Transfer-Encoding: binary");
          header("Content-Length: $size");
          readfile($src);
          return true;
        }else{
          return false;
        }
    }

    public function download($id){
        $path=DB::table('evidences')
          ->select('path')
          ->where('id',$id)
          ->first();
        if(!$this->downloadFile($path->path)){
          return redirect()->back();
        }
    }

}
