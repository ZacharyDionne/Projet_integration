<!doctype html>
<html lang="fr">
  <head>
  	<title>@yield('titre')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->
	<link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" href=" {{ asset('css/style.css') }}">
<!--===============================================================================================-->

        @yield('cssSupplementaire')
	</head>
    <body>
        @include('includes.banniere')

        @yield('contenu')


        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>