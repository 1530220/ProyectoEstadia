<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Career;
use App\Student;
use App\Teacher;
use App\Http\Requests;
use App\Helpers\DeleteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Listar los usuarios registrados en el sistema
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consulta de todos usuarios a la BD(excluyendo al tipo de usuario 99)
        $users = DB::table('users')->where('type', '!=', '99')->get();

        return view('users.list')
          ->with('users', $users);
    }

    /**
     * Muestra un registro dependiendo de su id
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Se busca en todos los registros el usuario con el id mandado
        $user = DB::table('siita_db.users')->where('id','=',$id)->first();//User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Muestra el perfil personal del usuario en sesion activa
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function showOwnProfile()
    {
        //Se obtiene el id del usuario con la sesion activa
        $id=Auth::user()->id;

        switch(Auth::user()->type){
            case 1:
            case 2:
            case 6:
            case 7:
                $user = DB::table('siita_db.users')->where('id', '=', $id)->first();
                break;
            case 3:
                // TODO:
                /*$user = DB::table('users')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->join('careers', 'students.career_id', '=', 'careers.id')
                    ->select(
                      'users.*',
                      'careers.*',
                      'users.id as user_id',
                      'users.deleted as deleted'
                     )
                    ->where('users.id', '=', $id)
                ->first();*/
                $user = DB::table('siita_db.users')->where('id', '=', $id)->first();
                break;
            case 4:
                $user = User::find($id);

                $teacher = Teacher::find($id);

                if ($teacher) {
                  $career = Career::find($teacher->career_id);
                }
                $logs = DB::select("SELECT * FROM log WHERE user_id = $id");

                return view('profile.show', compact('user','career','logs'));
                break;
            case 5:
                $user = User::find($id);

                $teacher = Teacher::find($id);

                if ($teacher) {
                  $career = Career::find($teacher->career_id);
                }
                $logs = DB::select("SELECT * FROM log WHERE user_id = $id");

                return view('profile.show', compact('user','career','logs'));
                break;
        }

        return view('profile.show', compact('user'));
    }

    /**
     * Muestra un registro dependiendo de su id
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        dd(Auth::user()->id);
        //Se busca en todos los registros el usuario con el id mandado
        $user = DB::table('siita_db.users')->where('id', '=', $id)->first();

        $teacher = Teacher::find($id);

        if ($teacher) {
          $career = Career::find($teacher->career_id);
        }

        $logs = DB::select("SELECT * FROM log WHERE user_id = $id");

        return view('profile.show', compact('user','career','logs'));
    }

    /**
     * Creando un nuevo alumno.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Se traen todas las carreras(incluyendo la de sin carrera asignada)
        $careers = DB::table('careers')->where('id', '!=', '4294967295')->get();

        //Se traen los tutores que tengan el usuarios con el tipo 5
        $tutors = User::where('type', '=', '5')->get();

        return view('users.create', compact('careers', 'tutors'));
    }

    //Se prepara el almacenado de un usuario
    public function store(Request $request)
    {
        if (Input::get('type')==3) {
          //Validaciones requeridas
          $data = request()->validate([
              'user_id' => 'required|max:4294967294|min:1|numeric',
              'id' => 'required|min:1|numeric',
              'first_name' => 'required|max:60',
              'last_name' => 'required|max:60',
              'username' => 'required|max:128',
              'password' => 'required|max:128',
              'career_id' => 'required',
              'tutor_id' => 'required',
          ], [
              'user_id.required' => ' * Este campo es obligatorio.',
              'user_id.max' => ' * El valor máximo de este campo es 4294967294.',
              'user_id.min' => ' * El valor mínimo de este campo es 1.',
              'user_id.numeric' => ' * Este campo es de tipo numérico.',
              'id.required' => ' * Este campo es obligatorio.',
              'id.min' => ' * El valor mínimo de este campo es 1.',
              'id.numeric' => ' * Este campo es de tipo numérico.',
              'first_name.required' => ' * Este campo es obligatorio.',
              'first_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
              'last_name.required' => ' * Este campo es obligatorio.',
              'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
              'username.required' => ' * Este campo es obligatorio.',
              'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
              'password.required' => ' * Este campo es obligatorio.',
              'password.max' => ' * Este campo debe contener sólo 128 caracteres.',
              'career_id.required' => ' * Este campo es obligatorio.',
            'tutor_id.required' => ' * Este campo es obligatorio.',
          ]);

        }else{
          //Validaciones requeridas
          $data = request()->validate([
              'user_id' => 'required|max:4294967294|min:1|numeric',
              'id' => 'required|min:1|numeric',
              'first_name' => 'required|max:60',
              'last_name' => 'required|max:60',
              'username' => 'required|max:128',
              'password' => 'required|max:128',
          ], [
              'user_id.required' => ' * Este campo es obligatorio.',
              'user_id.max' => ' * El valor máximo de este campo es 4294967294.',
              'user_id.min' => ' * El valor mínimo de este campo es 1.',
              'user_id.numeric' => ' * Este campo es de tipo numérico.',
              'id.required' => ' * Este campo es obligatorio.',
              'id.min' => ' * El valor mínimo de este campo es 1.',
              'id.numeric' => ' * Este campo es de tipo numérico.',
              'first_name.required' => ' * Este campo es obligatorio.',
              'first_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
              'last_name.required' => ' * Este campo es obligatorio.',
              'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
              'username.required' => ' * Este campo es obligatorio.',
              'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
              'password.required' => ' * Este campo es obligatorio.',
              'password.max' => ' * Este campo debe contener sólo 128 caracteres.',

          ]);
        }


        //Se crea una nueva instancia de usuario
        $user = new User;

        //Se llena el usuario con los datos ingresados en la vista
        $user->id = Input::get('user_id');
        $user->university_id = Input::get('id');
        $user->title = Input::get('title');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->second_last_name = Input::get('second_last_name');
        $user->username = Input::get('username');
        $user->password = bcrypt(Input::get('password'));
        $user->email = Input::get('username')."@upv.edu.mx";
        $user->type = Input::get('type');

        //Se carga la imagen subida
        $image = Input::file('image');
        //Si se ingreso una imagen a guardar, entonces la guarda en storage en la carpeta de users
        if ($image!=null) {
            //Almacenando la imagen del alumno
            $path=$request->file('image')->store('/img/users');
            $user->image_url = 'img/users/'.$request->file('image')->hashName();
        }

        //dd($user);
        //Se muestran los mensajes de cofirmacion para cada tipo de usuario y se realiza
        //el almacenamiento necesario para cada tipo de usuario
        if ($user->type == 1) {         //En caso de que sea administrador
            $user->save();
            Alert::success('Exitosamente', 'Administrador Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 2) {   //En caso de que sea usuario(depto. tutorias)
            $user->save();
            Alert::success('Exitosamente', 'Usuario / Empleado Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 3) {   //En caso de que sea estudiante
            $user->save();
            $student = new Student;
            $student->user_id=Input::get('user_id');
            $student->academic_situation = Input::get('academic_situation_id');
            $student->career_id = Input::get('career_id');
            $student->tutor_user_id = Input::get('tutor_id');
            $student->save();
            Alert::success('Exitosamente', 'Alumno Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 4) {   //En caso de que sea profesor
            $user->save();
            $teacher = new Teacher;
            $teacher->user_id=Input::get('user_id');
            $teacher->career_id = Input::get('career_id');
            $teacher->save();

            Alert::success('Exitosamente', 'Profesor Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 5) {   //En caso de que sea tutor
            $user->save();
            $teacher = new Teacher;
            $teacher->user_id=Input::get('user_id');
            $teacher->career_id = Input::get('career_id');
            $teacher->save();
            Alert::success('Exitosamente', 'Tutor Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 6) {   //En caso de que sea usuario de salud
            $user->save();
            Alert::success('Exitosamente', 'Usuario de Salud Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 7) {   //En caso de que sea usuario de psicologia
            $user->save();
            Alert::success('Exitosamente', 'Usuario de Psicología Registrado');
            insertToLog(Auth::user()->id, 'added', Input::get('user_id'), "usuario");
            return redirect()->route('users.list');
        }
    }

    /**
     * Permite la edicion de un usuario mandado como parametro
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Se realizan los pasos necesarios para le edicion de cada tipo de usuario
        if ($user->type == 1 || $user->type == 2 || $user->type == 6 || $user->type == 7) {         //Administrador y Empleado (Tutorias, Salud y Psicologia)
            $careers = Career::all()->where('id', '!=', '4294967295');
            return view('users.edit', compact('careers', 'user'));
        } elseif ($user->type == 3) {                       //Estudiante - Profesor - Tutor
            $careers = Career::all()->where('id', '!=', '4294967295');
            $student = DB::select("SELECT * FROM students WHERE user_id = $user->id")[0];
            return view('users.edit', compact('careers', 'user', 'student'));
        } elseif ($user->type == 4 || $user->type == 5) {   //Estudiante - Profesor - Tutor
            $careers = Career::all()->where('id', '!=', '4294967295');
            $teacher = DB::select("SELECT * FROM teachers WHERE user_id = $user->id")[0];
            return view('users.edit', compact('careers', 'user', 'teacher'));
        }
    }

    /**
     * Permite la edicion de un usuario mandado como parametro
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editOwnProfile()
    {
        $user = DB::table('siita_db.users')->where('id', '=', Auth::user()->id)->first();//User::find(Auth::user()->id);

        $careers = DB::table('siita_db.careers')->where('id','!=','4294967295')->get();//Career::all()->where('id', '!=', '4294967295');
        //Se realizan los pasos necesarios para le edicion de cada tipo de usuario
        if ($user->type == 1 || $user->type == 2 || $user->type == 6 || $user->type == 7) {         //Administrador y Empleado (Tutorias, Salud y Psicologia)
            return view('profile.edit', compact('careers', 'user'));
        } elseif ($user->type == 3) {                       //Estudiante - Profesor - Tutor
            $student = DB::select("SELECT * FROM siita_db.students WHERE user_id = $user->id")[0];
            return view('profile.edit', compact('careers', 'user', 'student'));
        } elseif ($user->type == 4 || $user->type == 5) {   //Estudiante - Profesor - Tutor
            $teacher = DB::select("SELECT * FROM teachers WHERE user_id = $user->id")[0];
            //$career = Career::find($user->id);
            $teacher = Teacher::find($user->id);

            $career = Career::find($teacher->career_id);

            //dd($career->name);
            return view('profile.edit', compact('career', 'user', 'teacher'));
        }
    }

    /**
     * Permite realizar el actualizado del usuario en la base de datos
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $data = request()->validate([
            'university_id' => 'required|min:1|max:university_id|numeric',
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'username' => 'required|max:128',
        ], [
            'university_id.required' => ' * Este campo es obligatorio.',
            'university_id.max' => ' * El valor máximo de este campo es 4294967294.',
            'university_id.min' => ' * El valor mínimo de este campo es 1.',
            'university_id.numeric' => ' * Este campo es de tipo numérico.',
            'id.required' => ' * Este campo es obligatorio.',
            'id.max' => ' * Este campo debe contener sólo 191 caracteres.',
            'first_name.required' => ' * Este campo es obligatorio.',
            'first_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
            'last_name.required' => ' * Este campo es obligatorio.',
            'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
            'username.required' => ' * Este campo es obligatorio.',
            'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
        ]);

        //Se cargan todos los datos mandados de la vista
        $user->university_id = Input::get('university_id');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->second_last_name = Input::get('second_last_name');
        $user->username = Input::get('username');
        $user->email = Input::get('username')."@upv.edu.mx";
        $user->type = Input::get('type');
        //Se obtiene la carrera del usuario
        $career = Input::get('career_id');
        //Se obtiene el id del usuario
        $user_id = Input::get('id');
        //Imagen nueva(mandada atraves del file input)
        $image = Input::file('image');
        //Imagen actual(registrada en la base de datos)
        $image2 = Input::get('image_2');

        //Se actualiza el usuario
        $user->update();
        //Si el usuario cambia la contraseña, se actualiza, es caso contrario se queda como estaba guardada
        if (Input::get('password') != null) {
            $password = bcrypt(Input::get('password'));
            DB::update('UPDATE users SET password = ? WHERE id = ?', [$password, $user_id]);
        }
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

        if ($user->type == 1) {             //En caso de que el usuario sea administrador
            Alert::success('Exitosamente', 'Administrador Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 2) {        //En caso de que sea usuario(depto. tutorias)
            Alert::success('Exitosamente', 'Usuario / Empleado Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 3) {       //En caso de que sea estudiante
            DB::update('UPDATE students SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Alumno Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 4) {       //En caso de que sea profesor
            DB::update('UPDATE teachers SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Profesor Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 5) {       //En caso de que sea tutor
            DB::update('UPDATE teachers SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Tutor Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 6) {        //En caso de que sea usuario(depto. salud)
            Alert::success('Exitosamente', 'Usuario de Salud Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 7) {        //En caso de que sea usuario(depto. psicologia)
            Alert::success('Exitosamente', 'Usuario de Psicología Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('id'), "usuario");
            return redirect()->route('users.list');
        }
    }

    /**
     * Permite realizar la actualizacion del usuario en sesion
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateOwnProfile(User $user)
    {
        //Se obtiene el id del usuario en sesion
        $user_id = Auth::user()->id;
        $user = User::find(Auth::user()->id);




        //En caso de que el usuario que modifique su perfil no sea administrador
        //este sera forzado a usar solamente numeros en su university_id
        if(Auth::user()->type==1 || Auth::user()->type==2){
            //Validaciones a los datos de entrada
            $data = request()->validate([
                'university_id' => 'required|min:1',
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
                'username' => 'required|max:128',
            ], [
                'university_id.required' => ' * Este campo es obligatorio.',
                'id.required' => ' * Este campo es obligatorio.',
                'id.max' => ' * Este campo debe contener sólo 191 caracteres.',
                'first_name.required' => ' * Este campo es obligatorio.',
                'first_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
                'last_name.required' => ' * Este campo es obligatorio.',
                'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
                'username.required' => ' * Este campo es obligatorio.',
                'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
                //'university_id.max' => ' * El valor máximo de este campo es 4294967294.',
                'university_id.min' => ' * El valor mínimo de este campo es 1.',
                //'university_id.numeric' => ' * Este campo es de tipo numérico.',
            ]);
        }else{
            $data = request()->validate([
                'username' => 'required|max:128',
            ], [
                'username.required' => ' * Este campo es obligatorio.',
                'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
            ]);

        }

        if(Auth::user()->type==1 || Auth::user()->type==2 ){
            //Se cargan todos los datos mandados de la vista
            $user->university_id = Input::get('university_id');
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->second_last_name = Input::get('second_last_name');
            $user->username = Input::get('username');
            $user->email = Input::get('username')."@upv.edu.mx";
            $user->type = Auth::user()->type;

            //Se obtiene la carrera del usuario
            $career = Input::get('career_id');
        }else{
            $user->username = Input::get('username');
            $user->email = Input::get('username')."@upv.edu.mx";
        }

        //Imagen nueva(mandada atraves del file input)
        $image = Input::file('image');
        //Imagen actual(registrada en la base de datos)
        $image2 = Input::get('image_2');

        //Se actualiza el usuario
        $user->update();
        //Si el usuario cambia la contraseña, se actualiza, es caso contrario se queda como estaba guardada
        if (Input::get('password') != null) {
            $password = bcrypt(Input::get('password'));
            DB::update('UPDATE siita_db.users SET password = ? WHERE id = ?', [$password, $user_id]);
        }


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
            DB::update('UPDATE siita_db.users SET image_url = ? WHERE id = ?', [$image_url, $user_id]);
        }

        if ($user->type == 1) {             //En caso de que el usuario sea administrador
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 2) {        //En caso de que sea usuario(depto. tutorias)
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 3) {       //En caso de que sea estudiante
            //DB::update('UPDATE students SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 4) {       //En caso de que sea profesor
            //DB::update('UPDATE teachers SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 5) {       //En caso de que sea tutor
          // DB::update('UPDATE teachers SET career_id = ? WHERE user_id = ?', [$career, $user_id]);
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 6) {        //En caso de que sea usuario(depto. salud)
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        } elseif ($user->type == 7) {        //En caso de que sea usuario(depto. psicologia)
            Alert::success('Exitosamente', 'Perfil Modificado');
            return redirect()->route('profile.show_own_profile');
        }
    }

    /**
     * Permite el borrado(logico de un usuario)
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->type == 1) {             //En caso de que sea administrador
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Administrador Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 2) {     //En caso de que sea usuario(depto tutorias)
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Usuario / Empleado Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 3) {     //En caso de que sea estudiante
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Alumno Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 4) {     //En caso de que sea profesor
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Profesor Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 5) {     //En caso de que sea tutor
            DB::update('UPDATE students SET tutor_user_id = ? WHERE tutor_user_id = ?', [4294967295, $user->id]);
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Tutor Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 6) {     //En caso de que sea usuario(depto tutorias)
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Usuario de Salud Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        } elseif ($user->type == 7) {     //En caso de que sea usuario(depto tutorias)
            DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $user->id);
            Alert::success('Exitosamente', 'Usuario de Psicología Eliminado');
            insertToLog(Auth::user()->id, 'deleted', $user->id, "usuario");
            return redirect()->route('users.list');
        }
    }

    /**
     * Restaurar(de manera logica) el usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        //Se llama el delete helper que realiza el restaurado logico
        DeleteHelper::instance()->restoreLogicalDelete('users', 'id', $request->id);

        Alert::success('Exitosamente', 'Usuario Restaurado');
        insertToLog(Auth::user()->id, 'recover', $request->id, "usuario");
        return redirect()->route('users.list');
    }
}
