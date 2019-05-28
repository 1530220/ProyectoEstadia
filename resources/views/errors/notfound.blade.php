<!DOCTYPE html>

<html lang="en-us" class="no-js">

<head>
	<meta charset="utf-8">
	<title>Pagina no encontrada</title>
	<meta name="description" content="No se encontró la pagina ingresada">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="UPV">

	<!-- Favicon -->
	<link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}"  />
	</head>

<body>

	<canvas id="dotty"></canvas>

	<!-- Logo de la Universidad -->
	<a href="{{route('dashboard')}}" class="logo-link" title="back home">
        <img src="{{ asset('img/logoupv.png') }}" class="logo" style="width:150px;" alt="UPV" />
    </a>

	<div class="content">
		<div class="content-box">
			<div class="big-content">

				<!-- Lineas del fondo -->
				<div class="list-line">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</div>

				<!-- La lupa animada -->
				<i class="fa fa-search" aria-hidden="true"></i>

				<!-- div clearing the float -->
				<div class="clear"></div>

			</div>
			@yield('content')

		</div>

	</div>

	<footer class="blue">
		<ul>
			@yield('back')
		</ul>
	</footer>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- Mozaic plugin -->
	<script src="{{ asset('js/mozaic.js') }}"></script>
</body>
</html>
