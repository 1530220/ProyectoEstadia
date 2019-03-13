<?php

namespace App\Http\Controllers;

use Alert;
use App\job;
use App\jobs_skills;
use App\Country;
use App\State;
use App\City;
use App\Http\Requests;
use App\company;
use App\Sectors;
use App\Skills;
use App\contact;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = DB::table('jobs')->get();
        $companies = DB::table('companies')->get();
        return view('jobs.list')
          ->with('jobs',$jobs)
          ->with('companies',$companies)
          ->with('title', 'Listado de Vacantes');
    }

    
    public function select_company()
    {
        $num_companies = DB::table('companies')->where("deleted","=",0)->count();
      
       if($num_companies == 0){
            Alert::error('No existen empresas para poder crear una vacante', 'Error');
            return redirect()->route('companies.create');  
       }else{
         $companies = DB::table('companies')->where("deleted","=",0)->get();
          return view('jobs.select_company')->with("companies",$companies); 
       }
       
    }

    public function create($id){
        $num_contacts = DB::table('contacts')->where("deleted","=",0)->where("company_id","=",$id)->count();
        $num_sectors = DB::table('sectors')->where("deleted","=",0)->count();
        $num_skills = DB::table('skills')->where('deleted',"=",0)->count();
        if($num_contacts == 0){
            Alert::error('No existen contactos para crear una vacante de la empresa seleccionada', 'Error');
            return redirect()->route('contacts.create');  
        }else if($num_sectors == 0){
            Alert::error('No existen sectores para poder crear una vacante', 'Error');
            return redirect()->route('sectors.create');  
        }else if($num_skills == 0){
            Alert::error('No existen habilidades para poder crear una vacante', 'Error');
            return redirect()->route('skills.create');  
        }else{
          $contacts = DB::table('contacts')->where("deleted","=",0)->where("company_id","=",$id)->get();
          $sectors = DB::table('sectors')->where("deleted","=",0)->get();
          $countries = Country::pluck('name','id'); 
          $skills = Skills::where('deleted','=',0)->get();
          return view('jobs.create')->with("countries",$countries)
                                    ->with("contacts",$contacts)
                                    ->with("sectors",$sectors)
                                    ->with("skills",$skills); 
        }
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
            'id' => 'required|min:1|numeric',
            'name' => 'required',
            'descripcion' => 'required',
            'zip' => 'required|numeric',
            'colonia' => 'required',
            'calle' => 'required',
        ], [
            'id.required' => ' * Este campo es obligatorio.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'descripcion.required' => ' * Este campo es obligatorio.',
            'zip.required' => ' * Este campo es obligatorio.',
            'zip.numeric' => ' * Este campo es de tipo numérico.',
            'colonia.required' => ' * Este campo es obligatorio.',
            'calle.required' => ' * Este campo es obligatorio.',
        ]);

       if(Input::get('country') == "0"){
            Alert::error('Se debe seleccionar un pais', 'Error');
            return redirect()->route('jobs.create');
        }
        
        if(Input::get('city') == "placeholder"){
            Alert::error('Se debe seleccionar una ciudad', 'Error');
            return redirect()->route('jobs.create');          
        }
        
        if($request->skills_required==NULL){
            Alert::error('Se debe seleccionar almenos una habilidad para asignar', 'Error');
            return redirect()->route('jobs.create');  
        }
        
        $job = new job;
        $job->id = Input::get("id");
        $job->name = Input::get("name");
        $job->description = Input::get("descripcion");
        $job->salary = Input::get("salary");
        $job->job_type = Input::get("type");
        $job->country = Input::get("country");
        $job->state = Input::get("state");
        $job->city = Input::get("city");
        $job->zip = Input::get("zip");
        $job->colony = Input::get("colonia");
        $job->street = Input::get("calle");
        $job->id_sector = Input::get("sector");
        $job->id_contact = Input::get("contact");
        $contacto = contact::find(Input::get("contact"));
        $job->id_company = $contacto->company_id;
        
        $skills_ids = $request->skills_required;

        foreach ($skills_ids as $skill) {
          $jobs_skills = new jobs_skills();
          $jobs_skills->job_id = Input::get("id");
          $jobs_skills->skill_id = $skill;
          $jobs_skills->save();
        }
      
        if($job->save()){
            Alert::success('Exitosamente', 'Vacante Registrada');
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "vacante");
            return redirect()->route('jobs.list');
        }else{
            Alert::error('Vacante no registrada', 'Error');
            return redirect()->route('jobs.list');  
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
        $job = job::find($id);
        $pais = Country::find($job->country);
        $estado = State::find($job->state);
        $ciudad = City::find($job->city);
        $sector = Sectors::find($job->id_sector);
        $company = company::find($job->id_company);
        $contact = contact::find($job->id_contact);
        $jobs_skills = jobs_skills::where("job_id","=",$id)
                          ->join("skills","jobs_skills.skill_id","=","skills.id")
                          ->select("skills.name")->get();
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
        return view('jobs.show', compact('job','name_pais','name_estado','name_ciudad','sector','company','contact','jobs_skills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        $num_contacts = DB::table('contacts')->where("deleted","=",0)->where("company_id","=",$job->id_company)->count();
        $num_sectors = DB::table('sectors')->where("deleted","=",0)->count();
        $num_skills = DB::table('skills')->where('deleted',"=",0)->count();
        if($num_contacts == 0){
            Alert::error('No existen contactos para la vacante seleccionada', 'Error');
            return redirect()->route('jobs.list');  
        }else if($num_sectors == 0){
            Alert::error('No existen sectores para poder modificar la vacante', 'Error');
            return redirect()->route('sectors.create');  
        }else if($num_skills == 0){
            Alert::error('No existen habilidades para poder modificar la vacante', 'Error');
            return redirect()->route('skills.create');  
        }else{
          $contacts = DB::table('contacts')->where("deleted","=",0)->where("company_id","=",$job->id_company)->get();
          $sectors = DB::table('sectors')->where("deleted","=",0)->get();
          $countries = Country::pluck('name','id'); 
          $states = State::all()->where('country_id','=',$job->country)->pluck('name','id');
          $cities = City::all()->where('state_id','=',$job->state)->pluck('name','id');
          $jobs_skills = jobs_skills::where("job_id","=",$job->id)->get();
          $skills = Skills::where('deleted','=',0)->get();
          return view('jobs.edit')->with("countries",$countries)
                                    ->with("contacts",$contacts)
                                    ->with("sectors",$sectors)
                                    ->with("states",$states)
                                    ->with("cities",$cities)
                                    ->with("skills",$skills)
                                    ->with("jobs_skills",$jobs_skills)
                                    ->with("job",$job); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(job $job,Request $request)
    {
        $data = request()->validate([
            'job_id' => 'required|min:1|numeric',
            'name' => 'required',
            'descripcion' => 'required',
            'zip' => 'required|numeric',
            'colonia' => 'required',
            'calle' => 'required',
        ], [
            'job_id.required' => ' * Este campo es obligatorio.',
            'job_id.min' => ' * El valor mínimo de este campo es 1.',
            'job_id.numeric' => ' * Este campo es de tipo numérico.',
            'name.required' => ' * Este campo es obligatorio.',
            'descripcion.required' => ' * Este campo es obligatorio.',
            'zip.required' => ' * Este campo es obligatorio.',
            'zip.numeric' => ' * Este campo es de tipo numérico.',
            'colonia.required' => ' * Este campo es obligatorio.',
            'calle.required' => ' * Este campo es obligatorio.',
        ]);

        if($request->skills_required==NULL){
            Alert::error('Se debe seleccionar almenos una habilidad para asignar', 'Error');
            return redirect()->route('jobs.create');  
        }
      
        $job->id = Input::get("job_id");
        $job->name = Input::get("name");
        $job->description = Input::get("descripcion");
        $job->salary = Input::get("salary");
        $job->job_type = Input::get("type");
        $job->country = Input::get("country");
        $job->state = Input::get("state");
        $job->city = Input::get("city");
        $job->zip = Input::get("zip");
        $job->colony = Input::get("colonia");
        $job->street = Input::get("calle");
        $job->id_sector = Input::get("sector");
        $job->id_contact = Input::get("contact");
    
        DB::delete("DELETE FROM jobs_skills WHERE job_id=?",[$job->id]);
      
        $skills_ids = $request->skills_required;

        foreach ($skills_ids as $skill) {
          $jobs_skills = new jobs_skills();
          $jobs_skills->job_id = Input::get("job_id");
          $jobs_skills->skill_id = $skill;
          $jobs_skills->save();
        }
      
        if($job->update()){
            Alert::success('Exitosamente', 'Vacante Modificada');
            insertToLog(Auth::user()->id, 'updated', Input::get('job_id'), "vacante");
            return redirect()->route('jobs.list');
        }else{
            Alert::error('Vacante no modificada', 'Error');
            return redirect()->route('jobs.list');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(job $job)
    {
        DeleteHelper::instance()->onCascadeLogicalDelete('jobs','id',$job->id);

        Alert::success('Exitosamente','Vacante Eliminada');

        insertToLog(Auth::user()->id, 'deleted', $job->id, "vacante");

        return redirect()->route('jobs.list');  
    }

    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('jobs','id',$request->id);

        Alert::success('Exitosamente','Vacante Restaurada');

        insertToLog(Auth::user()->id, 'recover', $request->id, "vacante");
        return redirect()->route('jobs.list');  
    }
}
