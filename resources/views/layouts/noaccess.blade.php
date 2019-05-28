<!DOCTYPE html>

<html lang="en-us" class="no-js">

	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<meta name="description" content="Flat able 404 Error page design">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Codedthemes">
        <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/upv.ico">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head>

	<body>

        <canvas id="dotty"></canvas>

        <!-- Your logo on the top left -->
        <a href="#" class="logo-link" title="back home">

            <img src="/img/logoupv.png" class="logo" style="width:150px;" alt="UPV" />

        </a>

        @yield('content')

        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <!-- Mozaic plugin -->
        <script src="/js/mozaic.js"></script>

    </body>

</html>