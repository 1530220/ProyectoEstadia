<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Career;
use App\Student;
use App\Teacher;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\DeleteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TeacherController extends Controller
{
    /**
     * Se muestra una lista para el CRUD de tutores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consulta de para traer la informacion de los teachers de la BD
        $teachers = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->join('careers', 'teachers.career_id', '=', 'careers.id')
            ->select(
              'users.*',
              'careers.*',
              'careers.abbreviation as career_abbreviation',
              'users.id as user_id',
              'users.deleted as deleted'
             )
            ->selectRaw('(SELECT COUNT(*) FROM students WHERE students.tutor_user_id = users.id) as num_tutorados')
            ->where('users.type', '=', 5);

        if(Auth::user()->type==2){
            $teachers=$teachers->where('users.deleted','=','0')->get();
        }else{
            $teachers=$teachers->get();
        }
        //Retorna a la vista de la tabla de tutores
        return view('tutors.list')
                  ->with('teachers', $teachers)
                  ->with('title', 'Listado de Tutores');
    }

    /**
     * Se muestra una lista para el CRUD de tutores.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTeachers()
    {
        //Consulta de para traer la informacion de los teachers de la BD
        $teachers = DB::table('teachers')
          ->join('users', 'teachers.user_id', '=', 'users.id')
          ->join('careers', 'teachers.career_id', '=', 'careers.id')
          ->select(
              'users.*',
              'careers.*',
              'careers.abbreviation as career_abbreviation',
              'users.id as user_id',
              'users.deleted as deleted'
          )
          ->where('users.type', '=', 4);

          if(Auth::user()->type==2){
              $teachers=$teachers->where('users.deleted','=','0')->get();
          }else{
              $teachers=$teachers->get();
          }
        //Retorna a la vista de la tabla de tutores
        return view('tutors.listTeachers')
                  ->with('teachers', $teachers)
                  ->with('title', 'Listado de Profesores');
    }

    /**
     * Se muestra el form para crear un nuevo tutor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Input::get('id', 0);

        //Se realiza una consulta para traer a los teachers que seran tutores
        $users = DB::table('users')
          ->join('teachers', 'users.id', '=', 'teachers.user_id')
          ->select('users.*')
          ->where('users.type', '=', '4')
          ->where('users.deleted', '=', 0)
          ->get();

        //Consulta para traer toda la informacion de la tabla de profesores
        $careers = Career::all()->where('id', '!=', '4294967295')->where('deleted', '!=', '1');

        if ($id==0) {
            //Retorna la vista de crear profesores
            return view('tutors.create', compact('users', 'careers'));
        } else {

            //Retorna la vista de crear tutor con el id de un profesor
            return view('tutors.create', compact('users', 'careers', 'id'));
        }
    }

    /**
     * Se muestra el form para crear un nuevo teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTeacher()
    {
        //Consulta para traer toda la informacion de la tabla de carreras
        $careers = Career::all()->where('id', '!=', '4294967295')->where('deleted', '!=', '1');

        //Retorna la vista de crear teacher
        return view('tutors.createTeacher', compact('careers'));
    }

    /**
     * Se almacena la informacion al crear un nuevo tutor
     *
     * @return \Illuminate\Http\Response
     */
    public function createTutor()
    {
        //Redirecciona a la vista de crear tutor (desde cero, es decir, que no esta registrado previamente en la BD)
        return view('tutors.createTutor');
    }

    /**
     * Se almacena un nuevo tutor en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Obtiene los valores de los select y se almacenan en variables
        $user_id = Input::get('tutor_user_id');
        $id = Input::get('tutor_user_id');
        $career_id = Input::get('career_id');

        if ($id != null) {
            //Se realiza una consulta para actualizar el tipo de usuario, ahora pasa de ser profesor a Tutor
            DB::update('UPDATE `users` SET `type` = ? WHERE `users`.`id` = ?', [5, $id]);
            Alert::success('Profesor guardado como Tutor', 'Cambio Registrado');
            insertToLog(Auth::user()->id, 'updated', $user_id, "profesor");
            return redirect()->route('tutors.list');
        } else {
            Alert::error('No se pudo realizar el cambio', 'Error');
            return redirect()->route('tutors.list');
        }
    }

    /**
     * Almacenar un nuevo tutor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTutor(Request $request)
    {
        $data = request()->validate([
          'id' => 'required|max:4294967294|min:1|numeric',
          'num_employee' => 'required|min:1|numeric',
          'name' => 'required|max:60',
          'last_name' => 'required|max:60',
          'username' => 'required|max:128',
          'password' => 'required|max:128',
          'career_id' => 'required',
        ], [
          'id.required' => ' * Este campo es obligatorio.',
          'id.max' => ' * El valor máximo de este campo es 4294967294.',
          'id.min' => ' * El valor mínimo de este campo es 1.',
          'id.numeric' => ' * Este campo es de tipo numérico.',
          'num_employee.required' => ' * Este campo es obligatorio.',
          'num_employee.min' => ' * El valor mínimo de este campo es 1.',
          'num_employee.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'last_name.required' => ' * Este campo es obligatorio.',
          'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'username.required' => ' * Este campo es obligatorio.',
          'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'password.required' => ' * Este campo es obligatorio.',
          'password.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'career_id.required' => ' * Este campo es obligatorio.',
        ]);

        //Se crea una instancia de Usuario, se guardan en variables los datos necesarios
        $user = new User;
        $user->id = Input::get('id');
        $user->university_id = Input::get('num_employee');
        $university_id = Input::get('num_employee');
        $user->title = Input::get('title');
        $user->first_name = Input::get('name');
        $user->last_name = Input::get('last_name');
        $user->second_last_name = Input::get('second_last_name');
        $user->username = Input::get('username');
        $user->password = bcrypt(Input::get('password'));
        $user->email = Input::get('username')."@upv.edu.mx";
        $user->type = 5;
        $image = Input::file('image');
        //Si se ingreso una imagen a guardar, entonces la guarda en storage en la carpeta de students
        if ($image!=null) {
            //Almacenando la imagen del alumno
            $path=$request->file('image')->store('/public/teachers');
            $user->image_url = 'storage/teachers/'.$request->file('image')->hashName();
        } else {    //En caso contrario se asigna la de defecto
            $user->image_url = 'storage/no_image.png';
        }
        $user->save();

        //Se realiza una consulta para obtener el user_id del usuario recien agregado
        $user_id = DB::select("SELECT id FROM users WHERE university_id = $university_id")[0];

        //En caso de que se guarde correctamente el usuario,
        if ($user->save()) {
            //Se crea una instancia de Teacher, la cual almacenara el user_id de la consulta anterior y el id de carrera
            $teacher = new Teacher;
            $teacher->user_id = $user_id->id;
            $teacher->career_id = Input::get('career_id');
            $teacher->save();
            if ($teacher->save()) {
            //if ($user->save()) {
                Alert::success('Exitosamente', 'Tutor Registrado');
                insertToLog(Auth::user()->id, 'added', Input::get('id'), "tutor");
                return redirect()->route('tutors.list');
            } else {
                Alert::success('No se pudo registrar el tutor', 'Error');
                return redirect()->route('tutors.list');
            }
        }
    }

    /**
     * Almacenar un nuevo profesor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTeacher(Request $request)
    {
        $data = request()->validate([
          'id' => 'required|max:4294967294|min:1|numeric',
          'num_employee' => 'required|min:1|numeric',
          'name' => 'required|max:60',
          'last_name' => 'required|max:60',
          'username' => 'required|max:128',
          'password' => 'required|max:128',
          'career_id_2' => 'required',
        ], [
          'id.required' => ' * Este campo es obligatorio.',
          'id.max' => ' * El valor máximo de este campo es 4294967294.',
          'id.min' => ' * El valor mínimo de este campo es 1.',
          'id.numeric' => ' * Este campo es de tipo numérico.',
          'num_employee.required' => ' * Este campo es obligatorio.',
          'num_employee.min' => ' * El valor mínimo de este campo es 1.',
          'num_employee.numeric' => ' * Este campo es de tipo numérico.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'last_name.required' => ' * Este campo es obligatorio.',
          'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'username.required' => ' * Este campo es obligatorio.',
          'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'password.required' => ' * Este campo es obligatorio.',
          'password.max' => ' * Este campo debe contener sólo 128 caracteres.',
          'career_id_2.required' => ' * Este campo es obligatorio.',
        ]);

        //Se crea una instancia de Usuario, se guardan en variables los datos necesarios
        $user = new User;
        $user->id = Input::get('id');
        $user->university_id = Input::get('num_employee');
        $university_id = Input::get('num_employee');
        $user->title = Input::get('title');
        $user->first_name = Input::get('name');
        $user->last_name = Input::get('last_name');
        $user->second_last_name = Input::get('second_last_name');
        $user->username = Input::get('username');
        $user->password = bcrypt(Input::get('password'));
        $user->email = Input::get('username')."@upv.edu.mx";
        $user->type = 4;
        $image = Input::file('image');
        //Si se ingreso una imagen a guardar, entonces la guarda en storage en la carpeta de students
        if ($image!=null) {
            //Almacenando la imagen del alumno
            $path=$request->file('image')->store('/public/teachers');
            $user->image_url = 'storage/teachers/'.$request->file('image')->hashName();
        } else {//En caso contrario se asigna la de defecto
            $user->image_url = 'storage/no_image.png';
        }
        $user->save();

        //Se realiza una consulta para obtener el user_id del usuario recien agregado
        $user_id = DB::select("SELECT id FROM users WHERE university_id = $university_id")[0];

        //En caso de que se guarde correctamente el usuario,
        if ($user->save()) {
            //Se crea una instancia de Teacher, la cual almacenara el user_id de la consulta anterior y el id de carrera
            $teacher = new Teacher;
            $teacher->user_id = $user_id->id;
            $teacher->career_id = Input::get('career_id_2');
            $teacher->save();
            if ($teacher->save()) {
                Alert::success('Exitosamente', 'Profesor Registrado');
                insertToLog(Auth::user()->id, 'added', Input::get('id'), "profesor");
                return redirect()->route('teachers.list');
            } else {
                Alert::success('No se pudo registrar el profesor', 'Error');
                return redirect()->route('teachers.list');
            }
        }
    }


    /**
     * Se cargan los datos para mostrar el nuevo profesor en la vista.
     *
     * @param  integer  $id   id del profesor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Se obtenienen los detalles del usuario,
        //dependiendo del valor del parametro que se obtiene, en este caso, el numero de empleado
        $tutor = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->join('careers', 'teachers.career_id', '=', 'careers.id')
            ->select(
                'users.*',
                'careers.*',
                'users.deleted as user_deleted", "careers.name as career_name',
                'users.id as user_id',
                'users.image_url as image',
                'users.deleted as user_deleted'
            )
            ->where('users.university_id', '=', $id)
            ->first();

        $tutorados = DB::table('students')
            ->where('students.tutor_user_id', '=', $tutor->user_id)
            ->get()->count();


        //Redirecciona a la vista de show o detalles
        return view('tutors.show', compact('tutor', 'tutorados'));
    }

    /**
     * Se muestran los tutorados de determinado tutor.
     *
     * @param  integer  $id   id del profesor
     * @return \Illuminate\Http\Response
     */

    public function showTutorados($id)
    {
        //Se obtienen todos los tutorados del tutor con el id mandado mediante $id
        $tutorados = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('careers', 'students.career_id', '=', 'careers.id')
            ->join('users as tutor', 'tutor.id', '=', 'students.tutor_user_id')
            ->select(
                'users.*',
                'careers.*',
                'users.id as user_id',
                'users.image_url as image',
                'students.academic_situation as academic_situation',
                'students.deleted as deleted',
                'tutor.first_name as tutor_first_name',
                'tutor.last_name as tutor_last_name',
                'tutor.second_last_name as tutor_second_last_name'
            )
            ->where('students.tutor_user_id', '=', $id)
            ->where('students.deleted', '!=', '1')
            ->get();

        if (sizeof($tutorados) == 0) {
            $tutorados = array();
        }

        $tutor = DB::select("SELECT id, university_id, title, first_name, last_name, second_last_name FROM users WHERE id = $id")[0];
        //dd($tutor_name);
        return view('tutors.tutorados', compact('tutor', 'tutorados'));
    }

    /**
     * Se muestran los detalles de un profesor.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */

    public function showTeacher($id)
    {
        //Se obtenienen los detalles del usuario,
        //dependiendo del valor del parametro que se obtiene, en este caso, el numero de empleado
        $teacher = DB::table('teachers')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->join('careers', 'teachers.career_id', '=', 'careers.id')
            ->select(
                'users.*',
                'careers.*',
                'users.deleted as user_deleted',
                'careers.name as career_name',
                'users.id as user_id',
                'users.image_url as image'
            )
            ->where('users.university_id', '=', $id)
            ->first();

        //Redirecciona a la vista de show o detalles
        return view('tutors.showTeacher', compact('teacher'));
    }

    /**
     * Se llena el form para la edicion de un tutor.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $tutor)
    {
        //Se realiza una consulta para obtener los datos del tutor, de acuerdo a parametro
        $tutor = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->select(
                'users.*',
                'users.id as num_employee',
                'teachers.career_id as tutor_career_id'
            )
            ->where('users.id', '=', $tutor->user_id)
            ->first();

        //Consulta para traer la informacion de las carreras
        $careers = Career::all()->where('deleted', '!=', '1');

        //Redirecciona a la vista de edicion de tutor
        return view('tutors.edit', ['tutor' => $tutor], compact('careers', 'tutor'));
    }

    /**
     * Se llena el form para la edicion de un profesor.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function editTeacher(Teacher $tutor)
    {
        //Se realiza una consulta para obtener los datos del tutor, de acuerdo a parametro
        $tutors = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->select(
                'users.*',
                'users.id as num_employee'
            )
            ->where('users.id', '=', $tutor->user_id)
            ->get();

        //Consulta para traer la informacion de las carreras
        $careers = Career::all()->where('deleted', '!=', '1');

        //Redirecciona a la vista de edicion del profesor
        return view('tutors.editTeacher', ['tutor' => $tutor], compact('careers', 'tutors', 'tutor'));
    }

    /**
     * Se actualiza un tutor registrado en la base de datos.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Teacher $tutor)
    {
        $data = request()->validate([
          'university_id' => 'required',
          'name' => 'required|max:60',
          'last_name' => 'required|max:60',
          'username' => 'required|max:128',
        ], [
          'university_id.required' => ' * Este campo es obligatorio.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'last_name.required' => ' * Este campo es obligatorio.',
          'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'username.required' => ' * Este campo es obligatorio.',
          'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
        ]);

        //Se almacenan en variables la informacion que se edito del tutor
        $user_id = Input::get('user_id');
        $university_id = Input::get('university_id');
        $title = Input::get('title');
        $first_name = Input::get('name');
        $last_name = Input::get('last_name');
        $second_last_name = Input::get('second_last_name');
        $email = Input::get('username')."@upv.edu.mx";
        $username = Input::get('username');
        $image = Input::file('image');//Imagen Nueva
        $image2 = Input::get('image_2');//Imagen Actual

        //Se realiza la actualizacion de la informacion del tutor
        $tutor->career_id = Input::get('career_id');
        $tutor->update();

        //En caso de ser exitosa, se realiza una actualizacion en la tabla de usuarios sobre la informacion actualizada del tutor
        if ($tutor->update()) {
            DB::update('UPDATE users SET university_id = ?, title = ?, first_name = ?, last_name = ?, second_last_name = ?, email = ?, username = ? WHERE id = ?', [$university_id, $title, $first_name, $last_name, $second_last_name, $email, $username, $user_id]);
            //Si el tutor cambia la contraseña, se actualiza, es caso contrario se queda como estaba guardada
            if (Input::get('password') != null) {
                $password = bcrypt(Input::get('password'));
                DB::update('UPDATE users SET password = ? WHERE id = ?', [$password, $user_id]);
            }

            //Actualizar foto, elimina la anterior
            if ($image!=null) {
                if ($image2!='storage/no_image.png') {
                    unlink(public_path()."/".$image2);
                }
                $path=Input::file('image')->store('/public/teachers');
                $image_url = 'storage/teachers/'.Input::file('image')->hashName();
                DB::update('UPDATE users SET image_url = ? WHERE id = ?', [$image_url, $user_id]);
            }
            Alert::success('Exitosamente', 'Tutor Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('user_id'), "tutor");
            return redirect()->route('tutors.list');
        } else {
            Alert::error('No se modifico el tutor', 'Error');
            return redirect()->route('tutors.list');
        }
    }

    /**
     * Se actualiza la informacion de un profesor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(Teacher $tutor)
    {
        $data = request()->validate([
          'university_id' => 'required',
          'name' => 'required|max:60',
          'last_name' => 'required|max:60',
          'username' => 'required|max:128',
        ], [
          'university_id.required' => ' * Este campo es obligatorio.',
          'name.required' => ' * Este campo es obligatorio.',
          'name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'last_name.required' => ' * Este campo es obligatorio.',
          'last_name.max' => ' * Este campo debe contener sólo 60 caracteres.',
          'username.required' => ' * Este campo es obligatorio.',
          'username.max' => ' * Este campo debe contener sólo 128 caracteres.',
        ]);

        //Se almacenan en variables la informacion que se edito del tutor
        $user_id = Input::get('user_id');
        $university_id = Input::get('university_id');
        $title = Input::get('title');
        $first_name = Input::get('name');
        $last_name = Input::get('last_name');
        $second_last_name = Input::get('second_last_name');
        $email = Input::get('username')."@upv.edu.mx";
        $username = Input::get('username');
        $image = Input::file('image');//Imagen Nueva
        $image2 = Input::get('image_2');//Imagen Actual

        //Se realiza la actualizacion de la informacion del tutor
        $tutor->career_id = Input::get('career_id');
        $tutor->update();

        //En caso de ser exitosa, se realiza una actualizacion en la tabla de usuarios sobre la informacion actualizada del tutor
        if ($tutor->update()) {
            DB::update('UPDATE users SET university_id = ?, title = ?, first_name = ?, last_name = ?, second_last_name = ?, email = ?, username = ? WHERE id = ?', [$university_id, $title, $first_name, $last_name, $second_last_name, $email, $username, $user_id]);
            //Si el tutor cambia la contraseña, se actualiza, es caso contrario se queda como estaba guardada
            if (Input::get('password') != null) {
                $password = bcrypt(Input::get('password'));
                DB::update('UPDATE users SET password = ? WHERE id = ?', [$password, $user_id]);
            }

            //Actualizar foto, elimina la anterior
            if ($image!=null) {
                if ($image2!='storage/no_image.png') {
                    unlink(public_path()."/".$image2);
                }
                $path=Input::file('image')->store('/public/teachers');
                $image_url = 'storage/teachers/'.Input::file('image')->hashName();
                DB::update('UPDATE users SET image_url = ? WHERE id = ?', [$image_url, $user_id]);
            }
            Alert::success('Exitosamente', 'Tutor Modificado');
            insertToLog(Auth::user()->id, 'updated', Input::get('user_id'), "profesor");
            return redirect()->route('teachers.list');
        } else {
            Alert::error('No se modifico el tutor', 'Error');
            return redirect()->route('teachers.list');
        }
    }

    /**
     * Se realiza un eliminado de manera logica del tutor.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $tutor)
    {
        DB::update('UPDATE students SET tutor_user_id = ? WHERE tutor_user_id = ?', [4294967295, $tutor->user_id]);
        //DB::delete('DELETE FROM users WHERE id = ?', [$tutor->user_id]);
        DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $tutor->user_id);
        //$tutor->delete();
        Alert::success('Exitosamente', 'Tutor Eliminado');
        insertToLog(Auth::user()->id, 'deleted', $tutor->user_id, "tutor");
        return redirect()->route('tutors.list');
    }

    /**
     * Se realiza un restaurado de manera logica del tutor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('users', 'id', $request->id);

        Alert::success('Exitosamente', 'Tutor Restaurado');
        insertToLog(Auth::user()->id, 'recover', $request->id, "tutor");
        return redirect()->route('tutors.list');
    }

    /**
     * Se realiza un eliminado de manera logica del teacher.
     *
     * @param  \App\Teacher  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroyTeacher(Teacher $tutor)
    {
        DeleteHelper::instance()->onCascadeLogicalDelete('users', 'id', $tutor->user_id);

        Alert::success('Exitosamente', 'Profesor Eliminado');
        insertToLog(Auth::user()->id, 'deleted', $tutor->user_id, "profesor");
        return redirect()->route('teachers.list');
    }

    /**
     * Se realiza un restaurado de manera logica del teacher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restoreTeacher(Request $request)
    {
        DeleteHelper::instance()->restoreLogicalDelete('users', 'id', $request->id);

        Alert::success('Exitosamente', 'Profesor Restaurado');
        insertToLog(Auth::user()->id, 'recover', $request->id, "profesor");
        return redirect()->route('teachers.list');
    }

    /**
     * Permite obtener los detalles de algun profesor y codificarlos en un array
     * de json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array                                Detalles del profesor
     */

    public function getDetailsFromTeacher(Request $request)
    {
        //Se obtiene los detalles del profesor con el id mandado
        $teacher = DB::table('users')
            ->select('university_id', 'title', 'first_name', 'last_name', 'second_last_name', 'email', 'image_url')
            ->where('users.id', '=', $request->id)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$teacher]);
    }


    /**
     * Permite obtener los profesores de determinada carrera
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array                                Detalles del profesor
     */
    public function getTeachersFromCurrentCareer(Request $request)
    {
        //Se obtiene los detalles del profesor con el id mandado
        $teachers = DB::table('users')
            ->join('teachers', 'users.id', '=', 'teachers.user_id')
            ->select(
                'users.id',
                'users.title',
                'users.first_name',
                'users.last_name',
                'users.second_last_name'
            )
            ->where('teachers.career_id', '=', $request->id)
            ->where('users.type', '=', 5)
            ->where('users.deleted', '=', 0)
            ->get();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$teachers]);
    }

    /**
     * Permite obtener los profesores de determinada carrera
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array                                Detalles del profesor
     */
    public function getStudentDetails(Request $request)
    {
        //Se obtiene los detalles del profesor con el id mandado
        $student = DB::table('users')
            ->select(
                'users.id',
                'users.university_id',
                'users.title',
                'users.first_name',
                'users.last_name',
                'users.second_last_name',
                'users.image_url',
                'users.email'
            )
            ->where('user.id', '=', $request->id)
            ->where('users.type', '=', 3)
            ->where('users.deleted', '=', 0)
            ->first();

        //Se retorna una respuesta codificada con JSON
        return response()->json(['response'=>$student]);
    }
}
