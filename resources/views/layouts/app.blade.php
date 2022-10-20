<!doctype html>
<html lang="fr">
  <head>
  	<title>@yield('titre')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="fonts\font-awesome-4.7.0\css\font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/styleCalendar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/styleModal.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/style.css">
<!--===============================================================================================-->
	</head>
    <body>
        <nav class="navbar navbar-dark bg-tr">
            <a class="navbar-brand font-tr" href="{{ route('fiches.index') }}">
                <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
                Fiches
            </a>
            
            <a class="font-tr" href="
                @if (auth()->user())
                    {{ route('conducteurs.edit', [auth()->user()->id]) }}
                @else
                    {{ route('employeurs.edit', [auth()->guard('employeur')->user()->id]) }}
                @endif
            ">
                <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
                paramètres
            </a>
            <a class="font-tr" href="{{ route('connexion.logout') }}">
                <img src="images\logo_BLANC.png" width="50" height="50" class="d-inline-block align-center" alt="">
                Déconnexion
            </a>

        </nav>

        @yield('contenu')

    </body>
</html>