<ul class="pcoded-item pcoded-left-item">
    <li id="dashboard_li" class="">
        <a href="{{ route('dashboard') }}">
            <span class="pcoded-micon"><i class="fas fa-home"></i><b>D</b></span>
            <span class="pcoded-mtext" data-i18n="nav.chat.main">Inicio</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>

    <li  id="students_li" class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='students' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fa fa-user"></i><b>A</b></span>
            <span class="pcoded-mtext" data-i18n="nav.social.main">Tutorados</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('students.list') ? 'active' : '' }}">
                <a href="{{ route('students.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Lista de Tutorados</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
  
    <li  id="students_li" class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='competences' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fas fa-star"></i><b>A</b></span>
            <span class="pcoded-mtext" data-i18n="nav.social.main">Competencias</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('competences.list') ? 'active' : '' }}">
                <a href="{{ route('competences.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Lista de Competencias</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('competences.not_evaluated') ? 'active' : '' }}">
                <a href="{{ route('competences.not_evaluated') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Competencias por Rankear</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('competences.solicitudes') ? 'active' : '' }}">
                <a href="{{ route('competences.solicitudes') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.job-search.job-detailed">Solicitudes de Competencias</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
  
    <li  id="students_li" class="pcoded-hasmenu {{ explode('.', $view_name)[0]=='medals' ? 'active pcoded-trigger' : '' }}">
        <a href="javascript:void(0)">
            <span class="pcoded-micon"><i class="fa fa-trophy"></i><b>A</b></span>
            <span class="pcoded-mtext" data-i18n="nav.social.main">Medallas</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class="{{ Route::currentRouteNamed('medals.list') ? 'active' : '' }}">
                <a href="{{ route('medals.list') }}">
                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.social.fb-wall">Lista de Medallas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
  
    <li class="{{ Route::currentRouteNamed('log.movementslist') ? 'active' : '' }}">
        <a href="{{ route('log.movementslist') }}">
            <span class="pcoded-micon"><i class="fa fa-history"></i><b>HM</b></span>
            <span class="pcoded-mtext" data-i18n="nav.job-search.main">Historial</span>
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
                @yield('bodyTutor')
            </div>
        </div>
    </div>
</div>
