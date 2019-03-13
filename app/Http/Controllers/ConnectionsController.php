<?php

namespace App\Http\Controllers;

use Alert;
use App\connections_companies;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ConnectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connections = connections_companies::all();
        return view("connections.list")->with("connections",$connections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = DB::table('siita_db.users')->where('type','=','3')->get();
        $companies = DB::table("companies")->where("deleted","=",0)->get();
        return view("connections.create")->with("students",$students)->with("companies",$companies);
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
          ],[
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * El valor máximo de este campo es 4294967294.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
          ]);
        
          $fecha_actual=date("Y-m-d H:i:s");
          $connection = new connections_companies;
  
          //Se obtienen los valores de la vista
          $connection->id = Input::get('id');
          $connection->student_id_login = Input::get('matricula');
          $connection->company_id = Input::get('company');
          $connection->date = $fecha_actual;
  
          //Se almacena y se muestran mensajes en caos de registro exitoso
          if ($connection->save()) {
            Alert::success('Exitosamente','Conexión Creada');
  
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "conexión");
  
            return redirect()->route('connections.list');
          } else {
            Alert::error('No se creo la conexión', 'Error');
            return redirect()->route('connections.list');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  
    public function verific_companies(Request $request){
      $companies = DB::table('connections_companies')->where('student_id_login', '=', $request->student_id)->get();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$companies]);
    }
}
