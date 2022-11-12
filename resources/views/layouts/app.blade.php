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

    

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <script defer src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- JQuery -->
    <script defer src="{{ asset('vendor/jquery/jquery-3.6.1.min.js') }}"></script>
    


        @yield('cssSupplementaire')
	</head>

    <body>
        @include('includes.banniere')

        @yield('contenu')


    </body>

</html>