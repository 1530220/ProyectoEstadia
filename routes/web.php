<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas de la aplicacion
|
*/

Route::get('/', 'Auth\LoginController@index')->name('main');
Auth::routes();


/******************************************
            Rutas para el sistema         *
 ******************************************/
//Verificacion de la existencia de una columna
Route::post('/operations/ajax/column_exists', 'VerificationsController@column_exists')->name('verify.column_exists');

Route::post('/auth/check', 'VerificationsController@loggedIn')->name('validation');

Route::group(['middleware'=>['auth']], function () {
    /******************************************
        Ruta para el control de la aplicacion *
     ******************************************/

    //Principales
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    /**************  Termina control aplicacion  ***************/

    /*******************************************
     * Rutas para para user profile            *
     *******************************************/

    //Mostrar Perfil del Usuario
    Route::get('/profile', 'UserController@showOwnProfile')->where('id', '[0-9]+')->name('profile.show_own_profile');

    //Editar Perfil del Usuario
    Route::get('/profile/edit', 'UserController@editOwnProfile')->where('id', '[0-9]+')->name('profile.edit');

    //Actualizar Perfil de Usuario
    Route::put('/profile', 'UserController@updateOwnProfile')->name('profile.update_own_profile');
    /**************  Termina user profile  ***************/

    /*******************************************
     * Rutas para para las operaciones AJAX    *
     *******************************************/


    Route::post('/operations/ajax/companies/verific_column', 'CompaniesController@verific_column')->name('companies.verific_column');
    Route::post('/operations/ajax/companies/verific_email', 'CompaniesController@verific_email')->name('companies.verific_email');
  
    Route::post('/operations/ajax/companies/verific_email_edit', 'CompaniesController@verific_email_edit')->name('companies.verific_email_edit');
  
    Route::post('/operations/ajax/contacts/verific_contact_email_edit', 'ContactsController@verific_contact_email_edit')->name('contacts.verific_contact_email_edit');
    Route::post('/operations/ajax/contacts/verific_contact_email', 'ContactsController@verific_contact_email')->name('contacts.verific_contact_email');
  
    Route::post('/operations/ajax/connections/verific_companies', 'ConnectionsController@verific_companies')->name('connections.verific_companies');
  
    Route::post('/operations/ajax/status_job/verific_jobs', 'StatusJobController@verific_jobs')->name('status_job.verific_jobs');
   //Route::post('/operations/ajax/login/verificar_type', 'LoginController@verificar_type')->name('login.verificar_type');
    /**************  Termina operaciones AJAX  ***************/

    /**
     * Rutas solo para administradores
     */
    Route::group(['middleware'=>['access:1']], function(){
        /***************************************************
         *  Rutas para control de los usuarios del sistema *
         ***************************************************/
        //Ver el listado de usuarios
        Route::get('/users', 'UserController@index')->name('users.list');

        //Mostrar los detalles del usuario mandado usuario
        Route::get('/users/{id}', 'UserController@show')->where('id', '[0-9]+')->name('users.show');

        //Crear un usuario
        Route::get('/users/new', 'UserController@create')->name('users.create');

        //Editar un usuario
        Route::get('/users/{user}/edit', 'UserController@edit')->where('id', '[0-9]+')->name('users.edit');

        //Almacenar los datos del usuario
        Route::post('/users', 'UserController@store')->name('users.store');

        //Eliminar un usuario
        Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

        //Actualizar un usuario
        Route::put('/users/{user}', 'UserController@update')->name('users.update');

        //Restaurar un usuario
        Route::post('/users/restore', 'UserController@restore')->name('users.restore');
        /**************  Termina usuarios  ***************/


        Route::get('/skills', 'SkillsController@index')->name('skills.list');
        Route::get('/skills/new', 'SkillsController@create')->name('skills.create');
        Route::post('/skills', 'SkillsController@store');
        Route::get('/skills/{id}', 'SkillsController@show')->where('id', '[0-9]+')->name('skills.show');
        Route::get('/skills/{skill}/edit', 'SkillsController@edit')->where('id', '[0-9]+')->name('skills.edit');
        Route::put('/skills/{skill}', 'SkillsController@update')->name('skills.update');
        Route::delete('/skills/{skill}', 'SkillsController@destroy')->name('skills.destroy');
        Route::post('/skills/restore', 'SkillsController@restore')->name('skills.restore');

        Route::get('/skill/{id}/edit', 'SkillsController@editStudentSkill')->where('id', '[0-9]+')->name('skill.edit');
        Route::put('/skill/{id}', 'SkillsController@updateStudentSkill')->name('skill.update');
        Route::delete('/skill/{skill}', 'SkillsController@destroyStudentSkill')->name('skill.destroy');
        Route::post('/skill/restore', 'SkillsController@restoreStudentSkill')->name('skill.restore');

        Route::get('/skills/asignar/{id}', 'SkillsController@asignar')->name('skills.asignar');
        Route::post('/skills/asignar/{id}','SkillsController@guardarAsignaciones')->name('skills.guardarAsignaciones');


        Route::get('/competences/new', 'CompetencesController@create')->name('competences.create');
        Route::post('/competences', 'CompetencesController@store');
        Route::get('/competences/{id}', 'CompetencesController@show')->where('id', '[0-9]+')->name('competences.show');
        Route::get('/competences/{competence}/edit', 'CompetencesController@edit')->where('id', '[0-9]+')->name('competences.edit');
        Route::put('/competences/{competence}', 'CompetencesController@update')->name('competences.update');
        Route::delete('/competences/{competence}', 'CompetencesController@destroy')->name('competences.destroy');
        

        Route::get('/sectors', 'SectorController@index')->name('sectors.list');
        Route::get('/sectors/new', 'SectorController@create')->name('sectors.create');
        Route::post('/sectors', 'SectorController@store');
        Route::get('/sectors/{id}', 'SectorController@show')->where('id', '[0-9]+')->name('sectors.show');
        Route::get('/sectors/{sector}/edit', 'SectorController@edit')->where('id', '[0-9]+')->name('sectors.edit');
        Route::put('/sectors/{sector}', 'SectorController@update')->name('sectors.update');
        Route::delete('/sectors/{sector}', 'SectorController@destroy')->name('sectors.destroy');
        Route::post('/sectors/restore', 'SectorController@restore')->name('sectors.restore');

        Route::get('/medals/new', 'MedalsController@create')->name('medals.create');
        Route::post('/medals', 'MedalsController@store');
        Route::get('/medals/{medal}/edit', 'MedalsController@edit')->where('id', '[0-9]+')->name('medals.edit');
        Route::put('/medals/{medal}', 'MedalsController@update')->name('medals.update');
        Route::delete('/medals/{medal}', 'MedalsController@destroy')->name('medals.destroy');
        Route::post('/medals/restore', 'MedalsController@restore')->name('medals.restore');

        Route::get('/projects', 'ProjectsController@index')->name('projects.list');
        Route::get('/projects/new', 'ProjectsController@create')->name('projects.create');
        Route::post('/projects', 'ProjectsController@store');
        Route::get('/projects/{project}/edit', 'ProjectsController@edit')->where('id', '[0-9]+')->name('projects.edit');
        Route::put('/projects/{project}', 'ProjectsController@update')->name('projects.update');
        Route::delete('/projects/{project}', 'ProjectsController@destroy')->name('projects.destroy');
        Route::post('/projects/restore', 'ProjectsController@restore')->name('projects.restore');

        Route::get('/acknowledgments', 'AcknowledgmentsController@index')->name('acknowledgments.list');
        Route::get('/acknowledgments/new', 'AcknowledgmentsController@create')->name('acknowledgments.create');
        Route::post('/acknowledgments', 'AcknowledgmentsController@store');
        Route::get('/acknowledgments/{acknowledgment}/edit', 'AcknowledgmentsController@edit')->where('id', '[0-9]+')->name('acknowledgments.edit');
        Route::put('/acknowledgments/{acknowledgment}', 'AcknowledgmentsController@update')->name('acknowledgments.update');
        Route::delete('/acknowledgments/{acknowledgment}', 'AcknowledgmentsController@destroy')->name('acknowledgments.destroy');
        Route::post('/acknowledgments/restore', 'AcknowledgmentsController@restore')->name('acknowledgments.restore');

        Route::get('/work_experiences', 'WorkExperiencesController@index')->name('work_experiences.list');
        Route::get('/work_experiences/new', 'WorkExperiencesController@create')->name('work_experiences.create');
        Route::post('/work_experiences', 'WorkExperiencesController@store');
        Route::get('/work_experiences/{work_experience}/edit', 'WorkExperiencesController@edit')->where('id', '[0-9]+')->name('work_experiences.edit');
        Route::put('/work_experiences/{work_experience}', 'WorkExperiencesController@update')->name('work_experiences.update');
        Route::delete('/work_experiences/{work_experience}', 'WorkExperiencesController@destroy')->name('work_experiences.destroy');
        Route::post('/work_experiences/restore', 'WorkExperiencesController@restore')->name('work_experiences.restore');


        Route::get('/companies', 'CompaniesController@index')->name('companies.list');
        Route::get('/companies/new', 'CompaniesController@create')->name('companies.create');
        Route::post('/companies', 'CompaniesController@store');
        Route::get('/companies/{id}', 'CompaniesController@show')->where('id', '[0-9]+')->name('companies.show');
        Route::get('/companies/{company}/edit', 'CompaniesController@edit')->where('id', '[0-9]+')->name('companies.edit');
        Route::put('/companies/{company}', 'CompaniesController@update')->name('companies.update');
        Route::delete('/companies/{company}', 'CompaniesController@destroy')->name('companies.destroy');
        Route::post('/companies/restore', 'CompaniesController@restore')->name('companies.restore');

        Route::get('/jobs', 'JobsController@index')->name('jobs.list');
        Route::get('/jobs/select', 'JobsController@select_company')->name('jobs.select_company');
        Route::get('/jobs/{id}/new', 'JobsController@create')->where('id', '[0-9]+')->name('jobs.create');
        Route::post('/jobs', 'JobsController@store');
        Route::get('/jobs/{id}', 'JobsController@show')->where('id', '[0-9]+')->name('jobs.show');
        Route::get('/jobs/{job}/edit', 'JobsController@edit')->where('id', '[0-9]+')->name('jobs.edit');
        Route::put('/jobs/{job}', 'JobsController@update')->name('jobs.update');
        Route::delete('/jobs/{job}', 'JobsController@destroy')->name('jobs.destroy');
        Route::post('/jobs/restore', 'JobsController@restore')->name('jobs.restore');

        Route::get('/contacts', 'ContactsController@index')->name('contacts.list');
        Route::get('/contacts/new', 'ContactsController@create')->name('contacts.create');
        Route::post('/contacts', 'ContactsController@store');
        Route::get('/contacts/{id}', 'ContactsController@show')->where('id', '[0-9]+')->name('contacts.show');
        Route::get('/contacts/{contact}/edit', 'ContactsController@edit')->where('id', '[0-9]+')->name('contacts.edit');
        Route::put('/contacts/{contact}', 'ContactsController@update')->name('contacts.update');
        Route::delete('/contacts/{contact}', 'ContactsController@destroy')->name('contacts.destroy');
        Route::post('/contacts/restore', 'ContactsController@restore')->name('contacts.restore');
      
        Route::get('/connections', 'ConnectionsController@index')->name('connections.list');
        Route::get('/connections/new', 'ConnectionsController@create')->name('connections.create');
        Route::post('/connections', 'ConnectionsController@store');
        Route::get('/connections/{id}', 'ConnectionsController@show')->where('id', '[0-9]+')->name('connections.show');
        Route::get('/connections/{connection}/edit', 'ConnectionsController@edit')->where('id', '[0-9]+')->name('connections.edit');
        Route::put('/connections/{connection}', 'ConnectionsController@update')->name('connections.update');
        Route::delete('/connections/{connection}', 'ConnectionsController@destroy')->name('connections.destroy');
        Route::post('/connections/restore', 'ConnectionsController@restore')->name('connections.restore');
      
        Route::get('/evidences', 'EvidencesController@index')->name('evidences.list');
        Route::get('/evidences/new/{id}', 'EvidencesController@create')->where('id', '[0-9]+')->name('evidences.create');
        Route::post('/evidences/cargar/{id}', 'EvidencesController@store')->name('evidences.cargarEvidencia');
        Route::delete('/evidences/{evidence}', 'EvidencesController@destroy')->name('evidences.destroy');
        
        Route::get('/status_job', 'StatusJobController@index')->name('status_job.list');
        Route::get('/status_job/new', 'StatusJobController@create')->name('status_job.create');
  
        Route::get('/status_job/postulaciones/{job}', 'StatusJobController@answerAccepted')->name('status_job.answerAccepted');
        Route::get('/status_job/postulaciones/answer/{job}', 'StatusJobController@answerRejected')->name('status_job.answerRejected');
        
        Route::get('/status_job/postular/{id}', 'StatusJobController@guardarPostulacion')->name('status_job.guardarPostulacion');
        Route::get('/status_job/postular/cancelar/{id}', 'StatusJobController@cancelarPostulacion')->name('status_job.cancelarPostulacion');
        
        /***************************************************
         *  Rutas para importar CSV al sistema *
         ***************************************************/

        //Permite acceder a la vista de importar
        Route::get('/import', 'ImportController@index')->name('imports.list');

        //Permite acceder a la vista para crear una neuva importacion
        Route::get('/import/new', 'ImportController@create')->name('imports.create');

        //Permite obtener los estudiantes que estan asignados al profesor seleccionado
        Route::post('/import', 'ImportController@store')->name('imports.store');
        /**************  Termina IMPORTAR  ***************/
    });

    /**
     * Rutas para: Administradores, Usuarios, Estudiantes, Tutores, Depto. Salud, Depto. Psicologia
     */
    Route::group(['middleware'=>['access:1,2,5,6,7']], function(){
      //Ver el listado de tutorias
      Route::get('/tutorias', 'TutoriaController@index')->name('tutorias.list');

      //Mostrar los detalles de un tutoria
      Route::get('/tutorias/{id}', 'TutoriaController@show')->where('id', '[0-9]+')->name('tutorias.show');
    });

  
    /**
     * Rutas solo para administradores o tutores o estudiantes
     */
    Route::group(['middleware'=>['access:1,2,5']], function(){
        
        Route::get('/competences', 'CompetencesController@index')->name('competences.list');
        Route::get('/competences/not_evaluated', 'CompetencesController@not_evaluated')->name('competences.not_evaluated');
        Route::get('/competences/{id}', 'CompetencesController@show')->where('id', '[0-9]+')->name('competences.show');
        Route::post('/competences/restore', 'CompetencesController@restore')->name('competences.restore');
        Route::get('/competence/{competence}/edit', 'CompetencesController@editStudentCompetence')->where('id', '[0-9]+')->name('competence.edit');
        Route::put('/competence/{competence}', 'CompetencesController@updateStudentCompetence')->name('competence.update');
        Route::delete('/competence/{competence}', 'CompetencesController@destroyStudentCompetence')->name('competence.destroy');
        Route::post('/competence/restore', 'CompetencesController@restoreStudentCompetence')->name('competence.restore');


        Route::get('/competences/solicitudes', 'CompetencesController@solicitudes')->name('competences.solicitudes');
        Route::get('/competences/solicitudes/{competence}', 'CompetencesController@answerAccepted')->name('competences.answerAccepted');
        Route::get('/competences/solicitudes/answer/{competence}', 'CompetencesController@answerRejected')->name('competences.answerRejected');
      
        Route::get('/competences/asignar/{id}', 'CompetencesController@asignar')->name('competences.asignar');
        Route::post('/competences/asignar/{id}','CompetencesController@guardarAsignaciones')->name('competences.guardarAsignaciones');
      
        Route::get('/evidences/download/{id}','EvidencesController@download');
        
        Route::get('/medals', 'MedalsController@index')->name('medals.list');
        Route::get('/medals/asignar/{id}', 'MedalsController@asignar')->name('medals.asignar');
        Route::post('/medals/asignar/{id}','MedalsController@guardarAsignaciones')->name('medals.guardarAsignaciones');
        
        Route::get('/medals/{id}', 'MedalsController@show')->where('id', '[0-9]+')->name('medals.show');
        Route::delete('/medal/{medal}', 'MedalsController@destroyStudentMedal')->name('medal.destroy');
        Route::post('/medal/restore', 'MedalsController@restoreStudentMedal')->name('medal.restore');
      
        Route::get('/projects/{id}', 'ProjectsController@show')->where('id', '[0-9]+')->name('projects.show');
      
        Route::get('/acknowledgments/{id}', 'AcknowledgmentsController@show')->where('id', '[0-9]+')->name('acknowledgments.show');
      
        Route::get('/work_experiences/{id}', 'WorkExperiencesController@show')->where('id', '[0-9]+')->name('work_experiences.show');
      
      Route::get('/movements', 'LogController@indexMovements')->name('log.movementslist');
    });

    Route::group(['middleware'=>['access:1,3,8']], function(){
        Route::get('/states/{id}', 'WorkExperiencesController@getStates');
        Route::get('/cities/{id}', 'WorkExperiencesController@getCities');

    });

    

    /******************************************
     * Rutas para estudiantes                 *
     ******************************************/
    Route::group(['middleware'=>['access:1,2,5']],function(){
        //Mostrar los detalles de un estudiante
        Route::get('/students/{id}', 'StudentController@show')->where('id', '[0-9]+')->name('students.show');

        //Ver el listado de estudiantes
        Route::get('/students', 'StudentController@index')->name('students.list');
    });

    Route::group(['middleware'=>['access:1,2,5']],function(){
        //Reportes de tutorias
        Route::get('/reports/tutorias', 'ReportController@indexTutorias')->name('reports.tutorias');

        //Reportes de jtg tutorias
        Route::get('/reports/tutorias_jtg', 'ReportController@indexJtgTutorias')->name('reports.jtg_tutorias');

        //Reportes de jtg tutorias
        Route::get('/reports/analytics', 'ReportController@indexAnalytics')->name('reports.analytics');
    });

    Route::group(['middleware'=>['access:6,7']],function(){
        //Reportes de Solicitudes
        Route::get('/reports/solicitudes', 'ReportController@indexSolicitudes')->name('reports.solicitudes');
    });

    Route::group(['middleware'=>['access:1,2,4,5']],function(){
        //Reportes de asesorias
        Route::get('/reports/asesorias', 'ReportController@indexAsesorias')->name('reports.asesorias');

        //Ver el listado de horas
        Route::get('/available_hours', 'AvailableHoursController@index')->name('ahours.list');

        //Mostrar los detalles de la hora
        Route::get('/available_hours/{id}', 'AvailableHoursController@show')->where('id', '[0-9]+')->name('ahours.show');

        //Añadair una hora
        Route::get('/available_hours/new', 'AvailableHoursController@create')->name('ahours.create');

        //Editar una horas
        Route::get('/available_hours/{user}/edit', 'AvailableHoursController@edit')->where('id', '[0-9]+')->name('ahours.edit');

        //Almacenar los datos de la hora
        Route::post('/available_hours', 'AvailableHoursController@store')->name('ahours.store');

        //Eliminar una hora
        Route::delete('/available_hours/{user}', 'AvailableHoursController@destroy')->name('ahours.destroy');

        //Actualizar una hora
        Route::put('/available_hours/{user}', 'AvailableHoursController@update')->name('ahours.update');

        //Restaurar una hora
        Route::post('/available_hours/restore', 'AvailableHoursController@restore')->name('ahours.restore');
    });

    Route::group(['middleware'=>['access:1,2']], function(){
        //Ver el listado de materias
        Route::get('/classes', 'ClassesController@index')->name('classes.list');

        //Mostrar los detalles de una materia
        Route::get('/classes/{id}', 'ClassesController@show')->where('id', '[0-9]+')->name('classes.show');

        //Añadair una materia
        Route::get('/classes/new', 'ClassesController@create')->name('classes.create');

        //Editar una materia
        Route::get('/classes/{user}/edit', 'ClassesController@edit')->where('id', '[0-9]+')->name('classes.edit');

        //Almacenar los datos de la materia
        Route::post('/classes', 'ClassesController@store')->name('classes.store');

        //Eliminar una materia
        Route::delete('/classes/{user}', 'ClassesController@destroy')->name('classes.destroy');

        //Actualizar una materia
        Route::put('/classes/{user}', 'ClassesController@update')->name('classes.update');

        //Restaurar una materia
        Route::post('/classes/restore', 'ClassesController@restore')->name('classes.restore');


        //Ver el listado de problemas
        Route::get('/problems', 'ProblemsController@index')->name('problems.list');

        //Mostrar los detalles de un problema
        Route::get('/problems/{id}', 'ProblemsController@show')->where('id', '[0-9]+')->name('problems.show');

        //Añadair un problema
        Route::get('/problems/new', 'ProblemsController@create')->name('problems.create');

        //Editar un problema
        Route::get('/problems/{user}/edit', 'ProblemsController@edit')->where('id', '[0-9]+')->name('problems.edit');

        //Almacenar los datos del problema
        Route::post('/problems', 'ProblemsController@store')->name('problems.store');

        //Eliminar un problema
        Route::delete('/problems/{user}', 'ProblemsController@destroy')->name('problems.destroy');

        //Actualizar un problema
        Route::put('/problems/{user}', 'ProblemsController@update')->name('problems.update');

        //Restaurar un problema
        Route::post('/problems/restore', 'ProblemsController@restore')->name('problems.restore');

        /******************************************
         * Rutas para el mantenimiento de tutores *
         ******************************************/

        //Ver el listado de tutores
        Route::get('/tutors', 'TeacherController@index')->name('tutors.list');

        //Ver el listado de profesores
        Route::get('/teachers', 'TeacherController@indexTeachers')->name('teachers.list');

        //Editar un tutor
        Route::get('/tutors/{tutor}/edit', 'TeacherController@edit')->where('id', '[0-9]+')->name('tutors.edit');

        //Editar un profesor
        Route::get('/teachers/{tutor}/edit', 'TeacherController@editTeacher')->where('id', '[0-9]+')->name('teachers.edit');

        //Mostrar tutorados de un tutor
        Route::get('/tutors/{tutor}/tutorados', 'TeacherController@showTutorados')->where('id', '[0-9]+')->name('tutors.tutorados');

        //Mostrar los detalles de un tutor
        Route::get('/tutors/{tutor}', 'TeacherController@show')->where('tutor', '[0-9]+')->name('tutors.show');

        //Mostrar los detalles de un profesor
        Route::get('/teachers/{tutor}', 'TeacherController@showTeacher')->where('tutor', '[0-9]+')->name('teachers.show');

        //Crear un tutor
        Route::get('/tutors/new', 'TeacherController@create')->name('tutors.create');

        //Crear un profesor
        Route::get('/teachers/new', 'TeacherController@createTeacher')->name('teachers.create');

        //// Ruta para almacenar los datos de un tutor  ****////
        //En caso de que ya exista el profesor:
        Route::post('/tutors/create/asign_tutor', 'TeacherController@store')->name('tutors.asign_tutor');
        //En caso de que se cree el tutor desde cero(agregando usuario)
        Route::post('/tutors/create/create_new', 'TeacherController@storeTutor')->name('tutors.create_new');
        ////***             Termina agregar tutor       ****////

        //Agregando un nuevo profesor
        Route::post('/teachers/new', 'TeacherController@storeTeacher')->name('teachers.store');

        //Eliminar un tutor
        Route::delete('/tutors/{tutor}', 'TeacherController@destroy')->name('tutors.destroy');

        //Eliminar un profesor
        Route::delete('/teachers/{tutor}', 'TeacherController@destroyTeacher')->name('teachers.destroy');

        //Actualizar un tutor
        Route::put('/tutors/{tutor}', 'TeacherController@update');

        //Actualizar un profesor
        Route::put('/teachers/{tutor}', 'TeacherController@updateTeacher');

        //Recuperar el tutor borrado
        Route::post('/tutors/restore', 'TeacherController@restore')->name('tutors.restore');

        //Recuperar el profesor borrado
        Route::post('/teachers/restore', 'TeacherController@restoreTeacher')->name('teachers.restore');

        /*------------- Validaciones AJAX para teachers ---------------*/
        //Permite la consulta de los detalles de un profesor mediante su id
        Route::post('/operations/ajax/teachers/getDetailsFromTeacher', 'TeacherController@getDetailsFromTeacher')->name('teachers.get_details');

        //Permite le obtener los profesores que pertenezcan a una carrera mediante el id de la carrera
        Route::post('/operations/ajax/teachers/getTeachersFromCurrentCareer', 'TeacherController@getTeachersFromCurrentCareer')->name('teachers.get_career_teachers');
        /**************  Termina tutores  ***************/

        /***********************************************
         * Rutas para el mantenimiento de los usuarios *
         ***********************************************/

        //Editar un estudiante
        Route::get('/students/{student}/edit', 'StudentController@edit')->where('id', '[0-9]+')->name('students.edit');

        //Crear un estudiante
        Route::get('/students/new', 'StudentController@create')->name('students.create');

        //Almacenar los datos de un estudiante
        Route::post('/students/new', 'StudentController@store')->name('students.store');

        //Eliminar un estudiante
        Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');

        //Actualizar un estudiante
        Route::put('/students/{student}', 'StudentController@update');

        //Restaurar un estudiante
        Route::post('/students/restore', 'StudentController@restore')->name('students.restore');
        /**************  Termina estudiantes  ***************/

        //Reasignacion de un alumno
        Route::get('/assignations/remove/{id}', 'AssignationController@removeTutor')->where('id', '[0-9]+')->name('assignations.remove_tutor');

        //Asignaciones de tutorados
        Route::get('/assignations/new', 'AssignationController@create')->name('assignations.create');

        //Nueva asignacion alamcenada
        Route::post('/assignations/new', 'AssignationController@store')->name('assignations.store');

        //Lista de Assignaciones
        Route::get('/assignations', 'AssignationController@index')->name('assignations.list');

        //Reasignacion de un alumno
        Route::get('/assignations/reassignation/{student}', 'AssignationController@reassignation')->where('id', '[0-9]+')->name('assignations.reassignation');

        //Cambiar el tutor en la reasignacion
        Route::post('/assignations/reassignation/{student}', 'AssignationController@changeTutor')->where('id', '[0-9]+')->name('assignations.changeTutor');

        //Obtener los estudiantes sin tutor que pertenecen a una cierta carrera
        Route::post('/operations/ajax/assignations/getStudents', 'AssignationController@getStudents')->name('assignations.get_students');

        //Lista de Log de sesiones
        Route::get('/sessions', 'LogController@indexSessions')->name('log.sessionlist');

        //Mostrar Perfil del Usuario
        Route::get('/sessions/{id}', 'LogController@showSession')->where('id', '[0-9]+')->name('sessions.show');

        //Lista de Log de movimientos
        

        //Mostrar Perfil del Usuario
        Route::get('/movements/{id}', 'LogController@showMovement')->where('id', '[0-9]+')->name('movements.show');
    });
});

Route::group(['middleware'=>['access:3']], function(){
  //RUTAS DE EGRESADOS
Route::get('/agregar_habilidades/{users}','EgresadosController@addskills');
 
Route::get('/editar_habilidades/{users}','EgresadosController@editskills');
  
Route::PATCH('/editar_habilidades/{users}','EgresadosController@update_skill');
  
Route::get('/eliminar_habilidades/{users}','EgresadosController@deleteskills');
  
Route::DELETE('/eliminar_habilidades/{users}','EgresadosController@destroy_skill');
  
Route::POST('/agregar_habilidades/{users}','EgresadosController@store_addskills');

Route::get('/ofertas_trabajo','EgresadosController@ofertas_trabajo');

Route::get('/lista_egresados','EgresadosController@lista_egresados')->name('students_upv');

//Route::get('/lista_egresados/ajax','EgresadosController@lista_egresados_ajax');//

Route::get('/perfil_egresado/{users}','EgresadosController@perfil_egresado')->name('profile_student');
  
Route::get('/agregar_proyectos/{users}','EgresadosController@addprojects');

Route::post('/agregar_proyectos/{users}','EgresadosController@store_addprojects');

Route::get('/editar_proyectos/{users}','EgresadosController@editproject');
  
Route::PATCH('/editar_proyectos/{users}','EgresadosController@update_project');

Route::PATCH('/perfil_egresado/{users}','EgresadosController@delete_project');

Route::get('/editar_egresado/{users}','EgresadosController@editprofile');

Route::PATCH('/editar_egresado/{users}','EgresadosController@update_profile');

Route::get('/perfil_usuario/{users}','EgresadosController@perfil_usuario');

Route::get('/egresado_perfil_empresa/{comapnies}','EgresadosController@egresado_perfil_empresa');

Route::get('/conexiones_egresado/{users}','EgresadosController@conexiones_egresado');
  

Route::get('/vacante/{jobs}','EgresadosController@vacante');

Route::post('/vacante/{jobs}','EgresadosController@sendjob');

Route::DELETE('/vacante/{jobs}','EgresadosController@destroy_sendjob');
  

Route::get('/agregar_competencias/{users}','EgresadosController@addcompetence');

Route::post('/agregar_competencias/{competences}','EgresadosController@store_addcompetences');
  

  
Route::get('/agregar_experiencias/{users}','EgresadosController@addworkexperiences');
  
Route::post('/agregar_experiencias/{users}','EgresadosController@store_workexperiences');
  
Route::get('/editar_experiencias/{users}','EgresadosController@editworkexperience');
  
Route::PATCH('/editar_experiencias/{users}','EgresadosController@update_workexperience');
  
Route::get('/eliminar_experiencias/{users}','EgresadosController@deleteworkexperiences');
  
Route::PATCH('/eliminar_experiencias/{users}','EgresadosController@destroy_workexperience');
  

Route::get('/agregar_reconocimientos/{users}','EgresadosController@addacknowledgments');
  
Route::post('/agregar_reconocimientos/{users}','EgresadosController@store_acknowledgments');
  
Route::get('/editar_reconocimientos/{users}','EgresadosController@editacknowledgment');
  
Route::PATCH('/editar_reconocimientos/{users}','EgresadosController@update_acknowledgment');
  
Route::get('/eliminar_reconocimientos/{users}','EgresadosController@deleteacknowledgments');
  
Route::PATCH('/eliminar_reconocimientos/{users}','EgresadosController@destroy_acknowledgment');
  

Route::get('/agregar_evidencias/{users}','EgresadosController@addevidences');
  
Route::post('/agregar_evidencias/{users}','EgresadosController@store_evidences');
  
Route::get('/eliminar_evidencias/{users}','EgresadosController@deleteevidences');
  
Route::PATCH('/eliminar_evidencias/{users}','EgresadosController@destroy_evidence');
  
  
  
Route::get('user/download/{id}','EgresadosController@download');
  

});

Route::get('type/{type}', 'SweetAlertController@notification');

Route::group(['middleware'=>['access:8']], function(){
 //------------------------------------------
//RUTAS DE EMPRESA
//Route::get('/inicio_empresa','EmpresasController@inicio_empresa');

Route::get('/tus_trabajos','EmpresasController@tus_trabajos');

Route::get('/egresados','EmpresasController@egresados')->name('users');

Route::get('/perfil_empresa/{companies}','EmpresasController@perfil_empresa')->name('profile');

Route::PATCH('/perfil_empresa/{companies}','EmpresasController@update_status_job');

Route::get('/agregar_contacto/{companies}','EmpresasController@addcontact');

Route::post('/agregar_contacto/{companies}','EmpresasController@store_addcontact');
  


Route::get('/editar_contacto/{companies}','EmpresasController@editcontact');

Route::PATCH('/editar_contacto/{contacts}','EmpresasController@update_contact');

Route::get('/agregar_vacante/{companies}','EmpresasController@addjob');

Route::get('/editar_vacante/{companies}','EmpresasController@editjob');

Route::PATCH('/editar_vacante/{jobs}','EmpresasController@update_job');

Route::get('/editar_perfil/{companies}','EmpresasController@editprofile');

Route::PATCH('/editar_perfil/{companies}','EmpresasController@update_profile');

Route::post('/agregar_vacante/{companies}','EmpresasController@store_addjob');

Route::get('/conexiones_empresa/{companies}','EmpresasController@conexiones_empresa');

Route::get('/egresado/{users}','EmpresasController@egresado');

Route::get('/empresa_vacante','EmpresasController@empresa_vacante');
});



