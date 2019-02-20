<ul class="pcoded-item pcoded-left-item">
    <li id="dashboard_li" class="">
        <a href="{{ route('dashboard') }}">
            <span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i><b>D</b></span>
            <span class="pcoded-mtext" data-i18n="nav.chat.main">Dashboard</span>
            <span class="pcoded-mcaret"></span>
        </a>
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
</ul>
</div>
</nav>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                @yield('bodyStudent')
            </div>
        </div>
    </div>
</div>
