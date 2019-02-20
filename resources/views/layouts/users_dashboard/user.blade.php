<ul class="pcoded-item pcoded-left-item">
    <li class=" ">
        <a href="{{ route('dashboard') }}">
            <span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i><b>D</b></span>
            <span class="pcoded-mtext" data-i18n="nav.chat.main">Dashboard</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>

    <li  id="students_li" class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='students' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fa fa-user"></i><b>A</b></span>
            <span class="pcoded-mtext" data-i18n="nav.social.main">Alumnos</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('students.list') ? 'active' : '' }}">
                <a href="{{ route('students.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Listado Alumnos</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('students.create') ? 'active' : '' }}">
                <a href="{{ route('students.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Alumno</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='tutors' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fas fa-user-graduate"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Tutores y Profesores</span>
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
                    <span class="pcoded-mtext" data-i18n="nav.task.task-board">Agregar Tutor</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('teachers.list') ? 'active' : '' }}">
                <a href="{{ route('teachers.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.task-board">Listado de Profesores</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('teachers.create') ? 'active' : '' }}">
                <a href="{{ route('teachers.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.task.task-board">Agregar Profesor</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='tutorias' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#39adb5;"><i class="fa fa-assistive-listening-systems"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.search.main">Tutorías</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('tutorias.list') ? 'active' : '' }}">
                <a href="{{ route('tutorias.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.simple-search">Listado de Tutorías</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('tutorias.create') ? 'active' : '' }}">
                <a href="{{ route('tutorias.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.grouping-search">Agregar Tutoría</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('tutorias.jtg.list') ? 'active' : '' }}">
                <a href="{{ route('tutorias.jtg.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.simple-search">Listado de Tutorías(JTG)</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('tutorias.jtg.create') ? 'active' : '' }}">
                <a href="{{ route('tutorias.jtg.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.search.grouping-search">Agregar Tutoría(JTG)</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='asesorias' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#7c4dff;"><i class="fa fa-book"></i><b>AS</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Asesorías</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ Route::currentRouteNamed('asesorias.list') ? 'active' : '' }}">
              <a href="{{ route('asesorias.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.card-view">Listado de Asesorías</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('asesorias.create') ? 'active' : '' }}">
                <a href="{{ route('asesorias.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Agregar Asesoría</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='assignations' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#5e1287;"><i class="fas fa-link"></i><b>T</b></span>
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
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='reports' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:gray;"><i class="fa fa-download"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Reportes</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('reports.tutorias') ? 'active' : '' }}">
                <a href="{{ route('reports.tutorias') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Reportes de Tutorías</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('reports.jtg_tutorias') ? 'active' : '' }}">
                <a href="{{ route('reports.jtg_tutorias') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Reportes de Tutorías JTG</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('reports.asesorias') ? 'active' : '' }}">
                <a href="{{ route('reports.asesorias') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Reportes de Asesorías</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('reports.analytics') ? 'active' : '' }}">
                <a href="{{ route('reports.analytics') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Graficas de Información de Tutorías y Asesorías</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='ahours' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#052a63;"><i class="fas fa-clock"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Horas de Disponibilidad</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('ahours.list') ? 'active' : '' }}">
                <a href="{{ route('ahours.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Lista de Horas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('ahours.create') ? 'active' : '' }}">
                <a href="{{ route('ahours.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Hora</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='classes' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#351d33;"><i class="fas fa-boxes"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Materias</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('classes.list') ? 'active' : '' }}">
                <a href="{{ route('classes.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Listado de Materias</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('classes.create') ? 'active' : '' }}">
                <a href="{{ route('classes.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Materia</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='problems' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#295933;"><i class="fas fa-exclamation-circle"></i><b>T</b></span>
            <span class="pcoded-mtext" data-i18n="nav.task.main">Problemas</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('problems.list') ? 'active' : '' }}">
                <a href="{{ route('problems.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Listado de Problemas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('problems.create') ? 'active' : '' }}">
                <a href="{{ route('problems.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.messages">Agregar Problema</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
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

                @yield('bodyUsuario')
            </div>
        </div>
    </div>
</div>
