<!doctype html>
<html lang="fr">
  <head>
  	<title>@yield('titre')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->
	<link rel="stylesheet" href="fonts\font-awesome-4.7.0\css\font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/style.css">
<!--===============================================================================================-->

        @yield('cssSupplementaire')
	</head>
    <body>
        @include('includes.banniere')

        @yield('contenu')

    </body>
</html>