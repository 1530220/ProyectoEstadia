<?php

namespace App\Http\Controllers;

use Alert;
use App\connections_companies;
use App\company;
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
        $connections = connections_companies::join("companies","connections_companies.company_id","=","companies.id")
                      ->join("siita_db.users as users","connections_companies.student_id_login","=","users.university_id")
                      ->select("connections_companies.*","companies.name","users.first_name","users.last_name","users.second_last_name")
                      ->get();
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
         
          if($request->companies_connect==NULL){
              Alert::error('Se debe seleccionar almenos una empresa para realizar una conexión', 'Error')->autoclose(4000);
              return redirect()->route("connections.create");
          }

          $companies_ids = $request->companies_connect;

          foreach ($companies_ids as $company) {
            $company_connect = new connections_companies();
            $company_connect->student_id_login = Input::get('matricula');
            $company_connect->company_id = $company;
            $company_connect->date = date("Y-m-d H:i:s");
            $company_connect->save();
            insertToLog(Auth::user()->id, 'added', $company_connect->id, "conexión");
          }
      
          Alert::success('Exitosamente','Conexión Creada')->autoclose(4000);
          return redirect()->route('connections.list');
    }

    
    public function destroy(connections_companies $connection)
    {
        if($connection->delete()){
          Alert::success('Exitosamente','Conexión Eliminada')->autoclose(4000);

          insertToLog(Auth::user()->id, 'deleted', $connection->id, "conexión");

          return redirect()->route('connections.list');  
        }else{
          Alert::error('No se eliminó la conexión', 'Error')->autoclose(4000);

          return redirect()->route('connections.list');  
        }
    }
  
 
    public function verific_companies(Request $request){
        
        $id = $request->student_id;
        $num_companies = company::whereNotExists(function($query) use ($id){
             $query->select(DB::raw(1))
                ->from('connections_companies')
                ->whereRaw('companies.id = connections_companies.company_id')
                ->where('connections_companies.student_id_login','=',$id);
              })->where('companies.deleted','=',0)
              ->count();
      
        $companies = company::whereNotExists(function($query) use ($id){
             $query->select(DB::raw(1))
                ->from('connections_companies')
                ->whereRaw('companies.id = connections_companies.company_id')
                ->where('connections_companies.student_id_login','=',$id);
              })->where('companies.deleted','=',0)
              ->get();
     
        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$companies,'num_companies'=>$num_companies]);
    }
}
