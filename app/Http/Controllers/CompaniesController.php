<?php

namespace App\Http\Controllers;

use Alert;
use App\company;
use App\Country;
use App\State;
use App\City;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')->where('id','!=','4294967295')->get();

        return view('companies.list')
          ->with('companies',$companies)
          ->with('title', 'Listado de Empresas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id'); 
        return view('companies.create')->with("countries",$countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd("1");
        $data = request()->validate([
            'id' => 'required|min:1|numeric',
            'name' => 'required',
            'telefono' => 'required|numeric',
            'zip' => 'required|numeric',
            'colonia' => 'required',
            'calle' => 'required',
            'horario' => 'required',
            'descripcion' => 'required',
            'email' => 'required',
        ], [
            'id.required' => ' * Este campo es obligatorio.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'telefono.required' => ' * Este campo es obligatorio.',
            'telefono.numeric' => ' * Este campo es de tipo numérico.',
            'zip.required' => ' * Este campo es obligatorio.',
            'zip.numeric' => ' * Este campo es de tipo numérico.',
            'colonia.required' => ' * Este campo es obligatorio.',
            'calle.required' => ' * Este campo es obligatorio.',
            'horario.required' => ' * Este campo es obligatorio.',
            'descripcion.required' => ' * Este campo es obligatorio.',
            'email.required' => ' * Este campo es obligatorio.',
        ]);

        if(Input::get('country') == "0"){
            Alert::error('Se debe seleccionar un pais', 'Error');
            return redirect()->route('companies.create');
        }
        
        if(Input::get('city') == "placeholder"){
            Alert::error('Se debe seleccionar una ciudad', 'Error');
            return redirect()->route('companies.create');          
        }
        
        
        $user = new User;

        $user->id = Input::get('id');
        $user->email = Input::get('email');
        $user->university_id = Input::get('id');
        $user->first_name = 'Empresa';
        $user->last_name = Input::get('name');
        $user->password = bcrypt('secret');
        $user->username = 'company'.Input::get('id');
        $user->type = 8;

        $user->save();
        //Se crea una nueva instancia de usuario
        $company = new company;

        //Se llena el usuario con los datos ingresados en la vista
        $company->id = Input::get('id');
        $company->rfc = Input::get('rfc');
        $company->name = Input::get('name');
        $company->phone = Input::get('telefono');
        $company->country = Input::get('country');
        $company->state = Input::get('state');
        $company->city = Input::get('city');
        $company->zip = Input::get('zip');
        $company->colony = Input::get('colonia');
        $company->street = Input::get('calle');
        $company->schedule = Input::get('horario');
        $company->description = Input::get('descripcion');

        //Se carga la imagen subida
        $image = Input::file('image');
        //Si se ingreso una imagen a guardar, entonces la guarda en storage en la carpeta de users
        if ($image!=null) {
            //Almacenando la imagen del alumno
            $path=$request->file('image')->store('/public/companies');
            $company->image_url = 'storage/companies/'.Input::file('image')->hashName();
        }

        //dd($user);
        //Se muestran los mensajes de cofirmacion para cada tipo de usuario y se realiza
        //el almacenamiento necesario para cada tipo de usuario
        if($company->save()){
            Alert::success('Exitosamente', 'Empresa Registrada');
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "empresa");
            return redirect()->route('companies.list');
        }else{
            Alert::error('Empresa no registrada', 'Error');
            return redirect()->route('companies.list');  
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
        $company = Company::find($id);
        $pais = Country::find($company->country);
        $estado = State::find($company->state);
        $ciudad = City::find($company->city);
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
        return view('companies.show', compact('company','name_pais','name_estado','name_ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $user = User::find($company->id);
        $countries = Country::pluck('name','id');
        $states = State::all()->where('country_id','=',$company->country)->pluck('name','id');
        $cities = City::all()->where('state_id','=',$company->state)->pluck('name','id');
        return view('companies.edit')->with('company',$company)->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company)
    {
        $data = request()->validate([
            'name' => 'required',
            'telefono' => 'required|numeric',
            'zip' => 'required|numeric',
            'colonia' => 'required',
            'calle' => 'required',
            'horario' => 'required',
            'descripcion' => 'required',
            'email' => 'required',
        ], [
            'name.required' => ' * Este campo es obligatorio.',
            'telefono.required' => ' * Este campo es obligatorio.',
            'telefono.numeric' => ' * Este campo es de tipo numérico.',
            'zip.required' => ' * Este campo es obligatorio.',
            'zip.numeric' => ' * Este campo es de tipo numérico.',
            'colonia.required' => ' * Este campo es obligatorio.',
            'calle.required' => ' * Este campo es obligatorio.',
            'horario.required' => ' * Este campo es obligatorio.',
            'descripcion.required' => ' * Este campo es obligatorio.',
            'email.required' => ' * Este campo es obligatorio.',
        ]);

        if(Input::get('country') == "0"){
            Alert::error('Se debe seleccionar un pais', 'Error');
            return redirect()->route('companies.create');
        }
        if(Input::get('state') == "placeholder"){
            Alert::error('Se debe seleccionar un estado', 'Error');
            return redirect()->route('companies.create');
        }
        if(Input::get('city') == "placeholder"){
            Alert::error('Se debe seleccionar una ciudad', 'Error');
            return redirect()->route('companies.create');          
        }
        

        //Se llena el usuario con los datos ingresados en la vista
        $company->id = Input::get('id');
        $company->name = Input::get('name');
        $company->phone = Input::get('telefono');
        $company->country = Input::get('country');
        $company->state = Input::get('state');
        $company->city = Input::get('city');
        $company->zip = Input::get('zip');
        $company->colony = Input::get('colonia');
        $company->street = Input::get('calle');
        $company->schedule = Input::get('horario');
        $company->description = Input::get('descripcion');

        //Imagen nueva(mandada atraves del file input)
        $image = Input::file('image');
        //Imagen actual(registrada en la base de datos)
        $image2 = Input::get('image_2');

        //Se actualiza la empresa
        $company->update();
        
        //Actualizar imagen, eliminando la anterior
        if ($image!=null) {
            if ($image2!='storage/no_image.png') {
                //Se realiza el eliminado de la imagen de la direccion fisica de
                //la imagen en el disco duro
                unlink(public_path()."/".$image2);
            }
            //Se realiza el almacenado de la nueva imagen(cargada en el file input)
            $path=Input::file('image')->store('/public/users');
            //Se obtiene el nombre de la imagen
            $image_url = 'storage/users/'.Input::file('image')->hashName();
            //Se realiza la nueva actualizacion al registro del usuario actual con el
            //nombre de la nueva imagen
            DB::update('UPDATE users SET image_url = ? WHERE id = ?', [$image_url, $user_id]);
        }

        //dd($user);
        //Se muestran los mensajes de cofirmacion para cada tipo de usuario y se realiza
        //el almacenamiento necesario para cada tipo de usuario
        if($company->save()){
            Alert::success('Exitosamente', 'Empresa Registrada');
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "empresa");
            return redirect()->route('companies.list');
        }else{
            Alert::error('Empresa no registrada', 'Error');
            return redirect()->route('companies.list');  
        }
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

    public function verific_column(Request $request){
        //Se obtiene los detalles del profesor con el id mandado
        $company = DB::table('siita_db.users as users')
            ->select(
                'users.id',
            )
            ->where('users.id', '=', $request->id)
            ->first();
        if($company == NULL){
            $company = DB::table('siita_db.users as users')
            ->select(
                'users.id',
            )
            ->where('users.university_id', '=', $request->id)
            ->first();
        }

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$company]);
    }

    public function verific_email(Request $request){
        //Se obtiene los detalles del profesor con el id mandado
        $company = DB::table('siita_db.users as users')
            ->select(
                'users.email',
            )
            ->where('users.email', '=', $request->id)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$company]);
    }
}
