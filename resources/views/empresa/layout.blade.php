<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('titulo')</title>

<!-- Fonts Online -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="icon" href="../assets/images/upv.ico" type="image/x-icon" sizes="32x32">

<!-- Style Sheet -->
<link rel="stylesheet" href="/css_bolsa/owl.carousel.css">
<link rel="stylesheet" href="/css_bolsa/main-style.css">
<link rel="stylesheet" href="/css_bolsa/style.css">
<link rel="stylesheet" href="/sweetalert/sweetalert.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<style type="text/css">
    textarea { border: none; }
</style>
<div id="main-wrapper"> 
   <div class="box-shadow-for-ui">
        <div class="uou-block-2b">
          <div class="container"> <a href="/dashboard"><img src="/assets/images/logoupv.png" alt="" width="200px" height="100px"></a> <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
            <nav class="nav">
              <ul class="sf-menu">
                <li><a href="/dashboard" style="color:white;"><i class="fas fa-home"></i> Inicio</a></li>
                <li> <a href="/tus_trabajos" style="color:white;"><i class="fas fa-clipboard-list"></i> Tus Trabajos</a> </li>
                <li> <a href="/egresados" style="color:white;"><i class="fas fa-user-graduate"></i> Egresados</a> </li>
                <li> <a href="/perfil_empresa/{{auth()->user()->id}}" style="color:white;"><i class="fas fa-building"></i>  Tu perfil</a></li>
                <li><a href="/conexiones_empresa/{{auth()->user()->id}}" style="color:white;"><i class="fab fa-connectdevelop"></i> Conexiones</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </ul>
               <div align="right"><label style="color:white;">Sesión actual: {{auth()->user()->first_name}}  {{auth()->user()->last_name}}</label></div>
            </nav>
           
          </div>
        </div>
        <!-- end .uou-block-2b --> 
      </div>
   @yield('contenido')
</div>
 <!-- Footer -->
  <div class="uou-block-4a secondary dark">
        <div class="container">
          <ul class="links">
            <p>Versión 1.0</p>
          </ul>
          <p>Desarollo: Equipo del M.S.I. Mario Humberto Rodríguez Chávez - Dirección de Tecnologías de la Información</p>
        </div>
      </div>
    <!-- end .uou-block-4a --> 
    
    <div class="uou-block-11a">
      <h5 class="title">Menu</h5>
      <a href="#" class="mobile-sidebar-close">&times;</a>
      <nav class="main-nav">
        <ul>
          <li><a href="/dashboard" style="color:white;"><i class="fas fa-home"></i> Inicio</a></li>
                <li> <a href="/tus_trabajos" style="color:white;"><i class="fas fa-clipboard-list"></i> Tus Trabajos</a> </li>
                <li> <a href="/egresados" style="color:white;"><i class="fas fa-user-graduate"></i> Egresados</a> </li>
                <li> <a href="/perfil_empresa/{{auth()->user()->id}}" style="color:white;"><i class="fas fa-building"></i>  Tu perfil</a></li>
                <li><a href="/conexiones_empresa/{{auth()->user()->id}}" style="color:white;"><i class="fab fa-connectdevelop"></i> Conexiones</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
        </ul>
      </nav>
      <hr>

<!-- Scripts --> 
<script src="https://maps.googleapis.com/maps/api/js"></script> 
<script src="/js_bolsa/jquery-2.1.3.min.js"></script> 
<script src="/js_bolsa/bootstrap.js"></script> 
<script src="/js_bolsa/plugins/superfish.min.js"></script> 
<script src="/js_bolsa/jquery.ui.min.js"></script> 
<script src="/js_bolsa/plugins/rangeslider.min.js"></script> 
<script src="/js_bolsa/plugins/jquery.flexslider-min.js"></script> 
<script src="/js_bolsa/uou-accordions.js"></script> 
<script src="/js_bolsa/uou-tabs.js"></script> 
<script src="/js_bolsa/plugins/select2.min.js"></script> 
<script src="/js_bolsa/owl.carousel.min.js"></script> 
<script src="/js_bolsa/gmap3.min.js"></script> 
<script src="/js_bolsa/scripts.js"></script>
<script src="/assets/js/dropdown.js"></script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="/sweetalert/sweetalert.min.js"></script>
@include('sweet::alert')
</body>
</html>