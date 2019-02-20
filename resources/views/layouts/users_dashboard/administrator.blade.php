<ul class="pcoded-item pcoded-left-item">
    <li id="dashboard_li" class="">
        <a href="{{ route('dashboard') }}">
            <span class="pcoded-micon"><i class="fa fa-home"></i><b>D</b></span>
            <span class="pcoded-mtext" data-i18n="nav.chat.main">Inicio</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>

    <li  id="students_li" class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='students' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fas fa-user-graduate"></i><b>A</b></span>
            <span class="pcoded-mtext" data-i18n="nav.social.main">Alumnos</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('students.list') ? 'active' : '' }}">
                <a href="{{ route('students.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Listado de Alumnos</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('projects.create') ? 'active' : '' }}">
                <a href="{{ route('projects.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Registrar Proyecto</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('acknowledgments.create') ? 'active' : '' }}">
                <a href="{{ route('acknowledgments.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Registrar Reconocimiento</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('work_experiences.create') ? 'active' : '' }}">
                <a href="{{ route('work_experiences.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Registrar Experiencia Laboral</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <!--<li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='tutors' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fas fa-user"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Tutores</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('tutors.list') ? 'active' : '' }}">
                <a href="{{ route('tutors.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.task-list">Listado de Tutores</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('tutors.create') ? 'active' : '' }}">
                <a href="{{ route('tutors.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.task-board">Puntuaciones asignadas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>-->
    
    <!--<li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='users' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fa fa-users"></i><b>U</b></span>
            <span class="pcoded-mtext" data-i18n="nav.gallery.main">Usuarios</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('users.list') ? 'active' : '' }}">
                <a href="{{ route('users.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.gallery.gallery-grid">Listado de Usuarios</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('users.create') ? 'active' : '' }}">
                <a href="{{ route('users.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.gallery.masonry-gallery">Agregar Usuarios</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Importar Usuarios</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>-->
    <!--<li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='assignations' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:coral;"><i class="fas fa-link"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Asignación</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('assignations.list') ? 'active' : '' }}">
                <a href="{{ route('assignations.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Lista de Tutorados</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('assignations.create') ? 'active' : '' }}">
                <a href="{{ route('assignations.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Asignación de Tutor</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'asignation']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Importar Asignación</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>-->
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='tutorias' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"  style="background-color:lightseagreen;"><i class="fa fa-building"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.search.main">Empresas</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('tutorias.list') ? 'active' : '' }}">
                <a href="{{ route('tutorias.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.simple-search">Listado de Empresas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('tutorias.list') ? 'active' : '' }}">
                <a href="{{ route('tutorias.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.simple-search">Agregar Empresa</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Importar Empresas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Listado de Vacantes</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Agregar Vacante</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Importar Vacantes</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Listado de Contactos</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Agregar Contacto</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
                <a href="{{ route('imports.list',['type'=>'users']) }}">
                    <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.main">Importar Contactos</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='sectors' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:slateblue;"><i class="fa fa-bars"></i><b>AS</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Sectores</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ Route::currentRouteNamed('sectors.list') ? 'active' : '' }}">
              <a href="{{ route('sectors.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.card-view">Listado de Sectores</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('asesorias.create') ? 'active' : '' }}">
                <a href="{{ route('sectors.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Agregar Sector</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='competences' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:darkcyan;"><i class="fas fa-star"></i><b>AG</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Competencias</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('competences.list') ? 'active' : '' }}">
                <a href="{{ route('competences.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Listado de Competencias</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('competences.create') ? 'active' : '' }}">
                <a href="{{ route('competences.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Agregar Competencia</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='skills' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:firebrick;"><i class="fa fa-tag"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Habilidades</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('skills.list') ? 'active' : '' }}">
                <a href="{{ route('skills.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Listado de Habilidades</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('skills.create') ? 'active' : '' }}">
                <a href="{{ route('skills.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Habilidad</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='medals' ? 'active pcoded-trigger' : '' }}">
            <a href="javascript:void(0)">
                <span class="pcoded-micon" style="background-color:#5e1287;"><i class="fa fa-trophy"></i><b>T</b></span>
                <span class="pcoded-mtext" data-i18n="nav.task.main">Medallas</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class="{{ Route::currentRouteNamed('medals.list') ? 'active' : '' }}">
                    <a href="{{ route('medals.list') }}">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.social.messages">Listado de Medallas</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteNamed('medals.create') ? 'active' : '' }}">
                    <a href="{{ route('medals.create') }}">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Medalla</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                
            </ul>
        </li>
    <li class="{{ explode('.', $view_name)[0]=='imports.list' ? 'active pcoded-trigger' : '' }}">
        <a href="{{ route('imports.list') }}">
            <span class="pcoded-micon" style="background-color:#13a57c;"><i class="fas fa-file-import"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Importar</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>
    <li class="{{ Route::currentRouteNamed('log.sessionlist') ? 'active' : '' }}">
        <a href="{{ route('log.sessionlist') }}">
            <span class="pcoded-micon" style="background-color:#fc6100;"><i class="icofont icofont-sign-in"></i><b>HS</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Historial de Sesiones</span>
            <!--<span class="pcoded-badge label label-danger">NEW</span>-->
            <span class="pcoded-mcaret"></span>
        </a>
    </li>
    <li class="{{ Route::currentRouteNamed('log.movementslist') ? 'active' : '' }}">
        <a href="{{ route('log.movementslist') }}">
            <span class="pcoded-micon" style="background-color:#7f0000;"><i class="fa fa-history"></i><b>HM</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Historial de Movimientos</span>
            <!--<span class="pcoded-badge label label-danger">NEW</span>-->
            <span class="pcoded-mcaret"></span>
        </a>
    </li>
    
</ul>
</div>
</nav>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                @yield('body')
            </div>
        </div>
    </div>
</div>
