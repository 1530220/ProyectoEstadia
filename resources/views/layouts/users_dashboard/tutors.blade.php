<ul class="pcoded-item pcoded-left-item">
    <li id="dashboard_li" class="">
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
    <li class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='schedule' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon" style="background-color:#004E64;"><i class="fas fa-business-time"></i><b>AG</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Agendar</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('schedule.tutoria.list') ? 'active' : '' }}">
                <a href="{{ route('schedule.tutoria.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Citas Agendadas Tutoría</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('schedule.tutoria.create') ? 'active' : '' }}">
                <a href="{{ route('schedule.tutoria.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Agendar Cita Tutoría</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('schedule.asesoria.list') ? 'active' : '' }}">
                <a href="{{ route('schedule.asesoria.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Citas Agendadas Asesoría</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('schedule.asesoria.create') ? 'active' : '' }}">
                <a href="{{ route('schedule.asesoria.create') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Agendar Cita Asesoría</span>
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
</ul>
</div>
</nav>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                @yield('bodyTutor')
            </div>
        </div>
    </div>
</div>
