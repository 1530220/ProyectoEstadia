<?php

namespace App\Http\Controllers;

use Alert;
use App\company;
use App\Country;
use App\State;
use App\City;
use App\contact;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = DB::table('contacts')
          ->join('companies','contacts.company_id','=','companies.id')
          ->select('contacts.*','companies.name')->get();

        return view('contacts.list')
          ->with('contacts',$contacts)
          ->with('title', 'Listado de Contactos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = company::all();
        return view('contacts.create')->with('companies',$companies);
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
            'position' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'horario' => 'required',
        ], [
            'id.required' => ' * Este campo es obligatorio.',
            'id.min' => ' * El valor mínimo de este campo es 1.',
            'id.numeric' => ' * Este campo es de tipo numérico.',
            'position.required' => ' * Este campo es obligatorio.',
            'nombre.required' => ' * Este campo es obligatorio.',
            'paterno.required' => ' * Este campo es obligatorio.',
            'phone.required' => ' * Este campo es obligatorio.',
            'email.required' => ' * Este campo es obligatorio.',
            'horario.required' => ' * Este campo es obligatorio.',
        ]);
      
        $contact = new contact;
        $contact->id = Input::get("id");
        $contact->first_name = Input::get("nombre");
        $contact->last_name = Input::get("paterno");
        $contact->second_last_name = Input::get("materno");
        $contact->email = Input::get("email");
        $contact->phone = Input::get("phone");
        $contact->position = Input::get("position");
        $contact->company_id = Input::get("company");
        $contact->schedule = Input::get("horario");
      
        if($contact->save()){
            Alert::success('Exitosamente', 'Contacto Registrado')->autoclose(4000);
            insertToLog(Auth::user()->id, 'added', Input::get('id'), "contacto");
            return redirect()->route('contacts.list');
        }else{
            Alert::error('Contacto no registrado', 'Error')->autoclose(4000);
            return redirect()->route('contacts.list');  
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
        $contact = DB::table('contacts')
          ->join('companies','contacts.company_id','=','companies.id')
          ->select('contacts.*','companies.name')->where('contacts.id','=',$id)->first();
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(contact $contact)
    {
        $companies = company::all();
        $contact = contact::find($contact->id);
        return view('contacts.edit')->with('companies',$companies)->with('contact',$contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(contact $contact)
    {
        $data = request()->validate([
            'contact_id' => 'required|min:1|numeric',
            'position' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'horario' => 'required',
        ], [
            'contact_id.required' => ' * Este campo es obligatorio.',
            'contact_id.min' => ' * El valor mínimo de este campo es 1.',
            'contact_id.numeric' => ' * Este campo es de tipo numérico.',
            'position.required' => ' * Este campo es obligatorio.',
            'nombre.required' => ' * Este campo es obligatorio.',
            'paterno.required' => ' * Este campo es obligatorio.',
            'phone.required' => ' * Este campo es obligatorio.',
            'email.required' => ' * Este campo es obligatorio.',
            'horario.required' => ' * Este campo es obligatorio.',
        ]);
      
        $contact->id = Input::get("contact_id");
        $contact->first_name = Input::get("nombre");
        $contact->last_name = Input::get("paterno");
        $contact->second_last_name = Input::get("materno");
        $contact->email = Input::get("email");
        $contact->phone = Input::get("phone");
        $contact->position = Input::get("position");
        $contact->company_id = Input::get("company");
        $contact->schedule = Input::get("horario");
      
        if($contact->update()){
            Alert::success('Exitosamente', 'Contacto Modificado')->autoclose(4000);
            insertToLog(Auth::user()->id, 'updated', Input::get('contact_id'), "contacto");
            return redirect()->route('contacts.list');
        }else{
            Alert::error('Contacto no modificado', 'Error')->autoclose(4000);
            return redirect()->route('contacts.list');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact $contact)
    {
      
        DeleteHelper::instance()->onCascadeLogicalDelete('contacts','id',$contact->id);

        Alert::success('Exitosamente','Contacto Eliminado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'deleted', $contact->id, "contacto");

        return redirect()->route('contacts.list');
    }
  
    
    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('contacts','id',$request->id);

        Alert::success('Exitosamente','Contacto Restaurado')->autoclose(4000);

        insertToLog(Auth::user()->id, 'recover', $request->id, "contacto");

        return redirect()->route('contacts.list');
    }
  
    public function verific_contact_email(Request $request){
        //Se obtiene los detalles del profesor con el id mandado
        $contact = DB::table('contacts')
            ->select(
                'email'
            )
            ->where('email', '=', $request->id)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$contact]);
     }
    
    public function verific_contact_email_edit(Request $request){
         //Se obtiene los detalles del profesor con el id mandado
         $contact = DB::table('contacts')
            ->select(
                'email'
            )
            ->where('email', '=', $request->email)
            ->where('id', '!=', $request->id)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$contact]);
    }
}
