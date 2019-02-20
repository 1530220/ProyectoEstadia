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

    //Permite obtener los estudiantes que estan asignados al profesor seleccionado
    Route::post('/operations/ajax/tutorias/getStudentsFromTeacher', 'TutoriaController@getStudentsFromTeacher')->name('tutorias.get_students');

    //Permite obtener los estudiantes que estan asignados al profesor seleccionado
    Route::post('/operations/ajax/tutorias/getProblemsOfTypeAttention', 'TutoriaController@getProblemsOfTypeAttention')->name('tutorias.get_problems_of_type_attention');

    //Permite obtener los estudiantes que estan asignados al profesor seleccionado
    Route::post('/operations/ajax/tutorias/getStudentDetails', 'TutoriaController@getStudentDetails')->name('tutorias.get_student_details');

    //Permite obtener los estudiantes que estan asignados al profesor seleccionado
    Route::post('/operations/ajax/asesorias/getStudentsFromTeacher', 'AsesoriaController@getStudentsFromTeacher')->name('asesorias.get_students');

    //Permite obtener los estudiantes que estan asignados al profesor seleccionado
    Route::post('/operations/ajax/asesorias/getProblemsOfTypeAttention', 'AsesoriaController@getProblemsOfTypeAttention')->name('asesorias.get_problems_of_type_attention');

    //Permite obtener los detalles de los estudiantes
    Route::post('/operations/ajax/asesorias/getStudentDetails', 'AsesoriaController@getStudentDetails')->name('asesorias.get_student_details');

    //Permite obtener las horas de disponibilidad de algun profesor
    Route::post('/operations/ajax/schedule/getAvailableHours', 'ScheduleController@getAvailableHours')->name('schedule.get_available_hours');

    //Permite obtener todas las horas de disponibilidad asignadas al profesor
    Route::post('/operations/ajax/schedule/getAllAvailableHours', 'ScheduleController@getAllAvailableHours')->name('schedule.get_all_available_hours');

    //Permite obtener los id de las horas de disponbilidad
    Route::post('/operations/ajax/schedule/getListOfAvailableHoursId', 'ScheduleController@getListOfAvailableHoursId')->name('schedule.get_list_of_available_hours_id');

    //Permite obtener el reporte de asesoria
    Route::post('/operations/ajax/reports/get_asesoria_report', 'ReportController@get_asesoria_report')->name('reports.get_asesoria_report');

    //Permite obtener el reporte de tutoria
    Route::post('/operations/ajax/reports/get_tutoria_report', 'ReportController@get_tutoria_report')->name('reports.get_tutoria_report');

    //Permite obtener el reporte de tutoria
    Route::post('/operations/ajax/reports/get_jtg_tutoria_report', 'ReportController@get_jtg_tutoria_report')->name('reports.get_jtg_tutoria_report');

    //Permite obtener el reporte de tutoria
    Route::post('/operations/ajax/reports/get_solicitud_report', 'ReportController@get_solicitud_report')->name('reports.get_solicitud_report');

    //Permite obtener el valor de una grafica
    Route::post('/operations/ajax/reports/get_value_for_chart', 'ReportController@get_value_for_chart')->name('reports.get_value_for_chart');


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

        /*******************************************
         * Rutas para el mantenimiento de carreras *
         *******************************************/

        //Ver el listado de carreras
        Route::get('/careers', 'CareerController@index')->name('careers.list');

        //Mostrar los detalles de una carrera
        Route::get('/careers/{ca}', 'CareerController@show')->where('ca', '[0-9]+')->name('careers.show');

        //Crear una carrera
        Route::get('/careers/new', 'CareerController@create')->name('careers.create');

        //Editar una carrera
        Route::get('/careers/{career}/edit', 'CareerController@edit')->where('id', '[0-9]+')->name('careers.edit');

        //Almacenar los datos de una carrera
        Route::post('/careers', 'CareerController@store');

        //Eliminar una carrera
        Route::delete('/careers/{career}', 'CareerController@destroy')->name('careers.destroy');

        //Actualizar una carrera
        Route::put('/careers/{career}', 'CareerController@update')->name('careers.update');

        //Restaurar una carrera
        Route::post('/careers/restore', 'CareerController@restore')->name('careers.restore');
        /**************  Termina carreras  ***************/

        Route::get('/skills', 'SkillsController@index')->name('skills.list');
        Route::get('/skills/new', 'SkillsController@create')->name('skills.create');
        Route::post('/skills', 'SkillsController@store');
        Route::get('/skills/{id}', 'SkillsController@show')->where('id', '[0-9]+')->name('skills.show');
        Route::get('/skills/{skill}/edit', 'SkillsController@edit')->where('id', '[0-9]+')->name('skills.edit');
        Route::put('/skills/{skill}', 'SkillsController@update')->name('skills.update');
        Route::delete('/skills/{skill}', 'SkillsController@destroy')->name('skills.destroy');
        Route::post('/skills/restore', 'SkillsController@restore')->name('skills.restore');

        Route::get('/competences', 'CompetencesController@index')->name('competences.list');
        Route::get('/competences/new', 'CompetencesController@create')->name('competences.create');
        Route::post('/competences', 'CompetencesController@store');
        Route::get('/competences/{id}', 'CompetencesController@show')->where('id', '[0-9]+')->name('competences.show');
        Route::get('/competences/{competence}/edit', 'CompetencesController@edit')->where('id', '[0-9]+')->name('competences.edit');
        Route::put('/competences/{competence}', 'CompetencesController@update')->name('competences.update');
        Route::delete('/competences/{competence}', 'CompetencesController@destroy')->name('competences.destroy');
        Route::post('/competences/restore', 'CompetencesController@restore')->name('competences.restore');

        Route::get('/competence/{competence}/edit', 'CompetencesController@editStudentCompetence')->where('id', '[0-9]+')->name('competence.edit');
        Route::put('/competence/{competence}', 'CompetencesController@updateStudentCompetence');
        
        Route::delete('/competence/{competence}', 'CompetencesController@destroyStudentCompetence')->name('competence.destroy');
        Route::post('/competence/restore', 'CompetencesController@restoreStudentCompetence')->name('competence.restore');

        Route::get('/sectors', 'SectorController@index')->name('sectors.list');
        Route::get('/sectors/new', 'SectorController@create')->name('sectors.create');
        Route::post('/sectors', 'SectorController@store');
        Route::get('/sectors/{id}', 'SectorController@show')->where('id', '[0-9]+')->name('sectors.show');
        Route::get('/sectors/{sector}/edit', 'SectorController@edit')->where('id', '[0-9]+')->name('sectors.edit');
        Route::put('/sectors/{sector}', 'SectorController@update')->name('sectors.update');
        Route::delete('/sectors/{sector}', 'SectorController@destroy')->name('sectors.destroy');
        Route::post('/sectors/restore', 'SectorController@restore')->name('sectors.restore');

        Route::get('/medals', 'MedalsController@index')->name('medals.list');
        Route::get('/medals/new', 'MedalsController@create')->name('medals.create');
        Route::post('/medals', 'MedalsController@store');
        Route::get('/medals/{id}', 'MedalsController@show')->where('id', '[0-9]+')->name('medals.show');
        Route::get('/medals/{medal}/edit', 'MedalsController@edit')->where('id', '[0-9]+')->name('medals.edit');
        Route::put('/medals/{medal}', 'MedalsController@update')->name('medals.update');
        Route::delete('/medals/{medal}', 'MedalsController@destroy')->name('medals.destroy');
        Route::post('/medals/restore', 'MedalsController@restore')->name('medals.restore');
        
        Route::get('/projects', 'ProjectsController@index')->name('projects.list');
        Route::get('/projects/new', 'ProjectsController@create')->name('projects.create');
        Route::post('/projects', 'ProjectsController@store');
        Route::get('/projects/{id}', 'ProjectsController@show')->where('id', '[0-9]+')->name('projects.show');
        Route::get('/projects/{project}/edit', 'ProjectsController@edit')->where('id', '[0-9]+')->name('projects.edit');
        Route::put('/projects/{project}', 'ProjectsController@update')->name('projects.update');
        Route::delete('/projects/{project}', 'ProjectsController@destroy')->name('projects.destroy');
        Route::post('/projects/restore', 'ProjectsController@restore')->name('projects.restore');

        Route::get('/acknowledgments', 'AcknowledgmentsController@index')->name('acknowledgments.list');
        Route::get('/acknowledgments/new', 'AcknowledgmentsController@create')->name('acknowledgments.create');
        Route::post('/acknowledgments', 'AcknowledgmentsController@store');
        Route::get('/acknowledgments/{id}', 'AcknowledgmentsController@show')->where('id', '[0-9]+')->name('acknowledgments.show');
        Route::get('/acknowledgments/{acknowledgment}/edit', 'AcknowledgmentsController@edit')->where('id', '[0-9]+')->name('acknowledgments.edit');
        Route::put('/acknowledgments/{acknowledgment}', 'AcknowledgmentsController@update')->name('acknowledgments.update');
        Route::delete('/acknowledgments/{acknowledgment}', 'AcknowledgmentsController@destroy')->name('acknowledgments.destroy');
        Route::post('/acknowledgments/restore', 'AcknowledgmentsController@restore')->name('acknowledgments.restore');

        Route::get('/work_experiences', 'WorkExperiencesController@index')->name('work_experiences.list');
        Route::get('/work_experiences/new', 'WorkExperiencesController@create')->name('work_experiences.create');
        Route::post('/work_experiences', 'WorkExperiencesController@store');
        Route::get('/work_experiences/{id}', 'WorkExperiencesController@show')->where('id', '[0-9]+')->name('work_experiences.show');
        Route::get('/work_experiences/{work_experience}/edit', 'WorkExperiencesController@edit')->where('id', '[0-9]+')->name('work_experiences.edit');
        Route::put('/work_experiences/{work_experience}', 'WorkExperiencesController@update')->name('work_experiences.update');
        Route::delete('/work_experiences/{work_experience}', 'WorkExperiencesController@destroy')->name('work_experiences.destroy');
        Route::post('/work_experiences/restore', 'WorkExperiencesController@restore')->name('work_experiences.restore');

        Route::get('/states/{id}', 'WorkExperiencesController@getStates');
        Route::get('/states/{id}/flag', 'WorkExperiencesController@getFlag');
        Route::get('/cities/{id}', 'WorkExperiencesController@getCities');
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
    Route::group(['middleware'=>['access:1,2,3,5,6,7']], function(){
      //Ver el listado de tutorias
      Route::get('/tutorias', 'TutoriaController@index')->name('tutorias.list');

      //Mostrar los detalles de un tutoria
      Route::get('/tutorias/{id}', 'TutoriaController@show')->where('id', '[0-9]+')->name('tutorias.show');
    });

    /**
     * Rutas para: Depto. Salud, Depto. Psicologia
     */
    Route::group(['middleware'=>['access:6,7']], function(){
      //Mostrar los detalles de un tutoria
      Route::get('/tutorias/{id}/update', 'TutoriaController@updateCanalizationState')->where('id', '[0-9]+')->name('tutorias.updateCanalizationState');

      //Actualizar el estado de canalizacion de una tutoria
      Route::put('/tutorias/updateCanalizationState/{tutoria}', 'TutoriaController@storeUpdateCanalizationState')->name('tutorias.storeUpdateCanalizationState');
    });

    /**
     * Rutas para: Estudiantes
     */
    Route::group(['middleware'=>['access:3']], function(){
        //Aprobar una tutoria
        Route::get('/tutorias/{id}/aproved', 'TutoriaController@tutoriaAproved')->name('tutorias.aproved');

        //Rechazar una tutoria
        Route::get('/tutorias/{id}/cancelled', 'TutoriaController@tutoriaCancelled')->name('tutorias.cancelled');

        //Aprobar una asesoria
        Route::get('/asesorias/{id}/aproved', 'AsesoriaController@asesoriaAproved')->name('asesorias.aproved');

        //Rechazar una asesoria
        Route::get('/asesorias/{id}/cancelled', 'AsesoriaController@asesoriaCancelled')->name('asesorias.cancelled');
    });

    /**
     * Rutas para: Administradores, Usuarios, Estudiantes, Profesores, Tutores, Depto. Salud, Depto. Psicologia
     */
    Route::group(['middleware'=>['access:1,2,3,4,5,6,7']], function(){
      //Ver el listado de asesorias
      Route::get('/asesorias', 'AsesoriaController@index')->name('asesorias.list');

      //Mostrar los detalles de un asesoria
      Route::get('/asesorias/{asesoria}', 'AsesoriaController@show')->where('asesoria', '[0-9]+')->name('asesorias.show');
    });

    /**
     * Rutas para: Administradores, Usuarios, Profesores, Tutores
     */
    Route::group(['middleware'=>['access:1,2,4,5']], function(){
        //Modificar una asesoria
        Route::get('/asesorias/{id}/edit', 'AsesoriaController@edit')->where('id', '[0-9]+')->name('asesorias.edit');

        //Crear una asesoria(siendo tutor)
        Route::get('/asesorias/new', 'AsesoriaController@create')->name('asesorias.create');

        //Almacenar los datos de una asesoria
        Route::post('/asesorias/new', 'AsesoriaController@store')->name('asesorias.store');

        //Actualizar un asesoria
        Route::put('/asesorias/{id}', 'AsesoriaController@update');

        //Eliminar un asesoria
        Route::delete('/asesorias/{asesoria}', 'AsesoriaController@destroy')->name('asesorias.destroy');

        //Recuperar las asesorias borradas
        Route::post('/asesorias/restore', 'AsesoriaController@restore')->name('asesorias.restore');
    });

    /**
     * Rutas solo para administradores o tutores o estudiantes
     */
    Route::group(['middleware'=>['access:1,2,5']], function(){
        /*******************************************
         * Rutas para el mantenimiento de tutorias *
         *******************************************/

        //Editar un tutoria
        Route::get('/tutorias/{id}/edit', 'TutoriaController@edit')->where('id', '[0-9]+')->name('tutorias.edit');

        //Crear una tutoria
        Route::get('/tutorias/new', 'TutoriaController@create')->name('tutorias.create');

        //Almacenar los datos de una tutoria
        Route::post('/tutorias/new', 'TutoriaController@store')->name('tutorias.store');

        //Eliminar un tutoria
        Route::delete('/tutorias/{tutoria}', 'TutoriaController@destroy')->name('tutorias.destroy');

        //Restaurar una tutoria
        Route::post('/tutorias/restore', 'TutoriaController@restore')->name('tutorias.restore');

        //Actualizar un tutoria
        Route::put('/tutorias/{tutoria}', 'TutoriaController@update')->name('tutorias.update');

        //Actualizar un tutoria
        Route::get('/tutorias/{tutoria}/do', 'TutoriaController@do')->name('tutorias.do');

        //Mostrar los detalles de un tutoria(jtg)
        Route::get('/tutorias/jtg/{id}', 'JtgTutoriaController@show')->where('id', '[0-9]+')->name('tutorias.jtg.show');

        //Ver el listado de tutorias(jtg)
        Route::get('/tutorias/jtg', 'JtgTutoriaController@index')->name('tutorias.jtg.list');

        //Crear una tutoria(jtg)
        Route::get('/tutorias/jtg/new', 'JtgTutoriaController@create')->name('tutorias.jtg.create');

        //Almacenar los datos de una tutoria(jtg)
        Route::post('/tutorias/jtg/new', 'JtgTutoriaController@store')->name('tutorias.jtg.store');

        //Eliminar un tutoria(jtg)
        Route::delete('/tutorias/jtg/{tutoria}', 'JtgTutoriaController@destroy')->name('tutorias.jtg.destroy');

        //Restaurar una tutoria(jtg)
        Route::post('/tutorias/jtg/restore', 'JtgTutoriaController@restore')->name('tutorias.jtg.restore');

        //Editar un tutoria(jtg)
        Route::get('/tutorias/jtg/{id}/edit', 'JtgTutoriaController@edit')->where('id', '[0-9]+')->name('tutorias.jtg.edit');

        //Actualizar un tutoria(jtg)
        Route::put('/tutorias/jtg/{tutoria}', 'JtgTutoriaController@update')->name('tutorias.jtg.update');
        /**************  Termina tutorias  ***************/
    });

    Route::group(['middleware'=>['access:1,2,3,4,5']], function(){
        /*******************************************
         *Rutas para schedule*
         *******************************************/

         //Permite acceder al listado de citas de asesorias
         Route::get('/schedule/asesoria', 'ScheduleController@indexCitasAsesorias')->name('schedule.asesoria.list');

         //Editar un cita
         Route::get('/schedule/asesoria/{id}/edit', 'ScheduleController@editCitaAsesoria')->where('id', '[0-9]+')->name('schedule.asesoria.edit');

         //Permite acceder a la vista de schedule cita de asesorias
         Route::get('/schedule/new/asesoria', 'ScheduleController@createCitaAsesoria')->name('schedule.asesoria.create');

         //Permite almacenar la cita de asesorias en la BD
         Route::post('/schedule/new/asesoria', 'ScheduleController@storeCitaAsesoria')->name('schedule.storeAsesoria');

         //Eliminar un cita de asesoria
         Route::delete('/schedule/{asesoria}', 'ScheduleController@destroyCitaAsesoria')->name('schedule.asesoria.destroy');

         //Actualizar un cita de asesoria
         Route::put('/schedule/{id}', 'ScheduleController@updateCitaAsesoria')->name('schedule.asesoria.update');

         //Recuperar las citas de asesorias borradas
         Route::post('/schedule/restore', 'ScheduleController@restoreCitaAsesoria')->name('schedule.asesoria.restore');
         /**************  Termina schedule  ***************/

    });

    Route::group(['middleware'=>['access:1,2,3,5']], function(){
        /*******************************************
         *Rutas para schedule*
         *******************************************/

        //Editar una cita de tutoria
        Route::get('/schedule/editTutoria/{id}', 'ScheduleController@editCitaTutoria')->where('id', '[0-9]+')->name('schedule.tutoria.edit');

        //Eliminar una cita tutoria
        Route::delete('/schedule/delete/{id}', 'ScheduleController@destroyCitaTutoria')->name('schedule.tutoria.destroy');

        //Actualizar un cita de tutoria
        Route::put('/schedule/updateTutoria/{id}', 'ScheduleController@updateCitaTutoria');

        //Recuperar las tutorias borradas
        Route::post('/schedule/restore/tutorias', 'ScheduleController@restoreCitaTutoria')->name('schedule.tutoria.restore');

        //Permite acceder al listado de citas de tutorias
        Route::get('/schedule/tutoria', 'ScheduleController@indexCitasTutorias')->name('schedule.tutoria.list');

        //Permite acceder a la vista de schedule cita de tutorias
        Route::get('/schedule/new/tutoria', 'ScheduleController@createCitaTutorias')->name('schedule.tutoria.create');

        //Permite almacenar la cita de tutorias en la BD
        Route::post('/schedule/new/tutoria', 'ScheduleController@storeCitaTutorias')->name('schedule.storeTutoria');
        /**************  Termina schedule  ***************/
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
        Route::get('/movements', 'LogController@indexMovements')->name('log.movementslist');

        //Mostrar Perfil del Usuario
        Route::get('/movements/{id}', 'LogController@showMovement')->where('id', '[0-9]+')->name('movements.show');
    });
});

Route::get('type/{type}', 'SweetAlertController@notification');
