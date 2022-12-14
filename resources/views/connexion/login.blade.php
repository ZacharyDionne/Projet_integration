<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <script defer src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- JQuery -->
    <script defer src="{{ asset('vendor/jquery/jquery-3.6.1.min.js') }}"></script>


<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script defer src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script defer src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script defer src="vendor/daterangepicker/moment.min.js"></script>
	<script defer src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script defer src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script defer src="js/main.js"></script>



</head>
<body class="background-img">
	<div class="limiter">
		<div class="container-login100 bg-transparent">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-150" method="post" action="{{ route('connexion.login') }}">
					@csrf
					<span class="login100-form-title">
                    	<img src="images/logo_BLANC.png" alt="logo" class="login100-form-logo">
                    	Ouvrir une session
					</span>

					@if (isset($errors) && $errors->any())
						@foreach ($errors->all() as $error)

							<div class="messageErreur">{{ $error }}&nbsp;<span style="background-color:#c80000;border-radius:50px;color:white;padding:0px 5px;">!</span></div>

						@endforeach

						@endif

					<div class="wrap-input100 validate-input m-b-16" data-validate="Veuillez saisir votre adresse courriel">
						<input class="input100" type="email" name="adresseCourriel" placeholder="Adresse courriel" value="{{ old('adresseCourriel') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-t-25" data-validate = "Veuillez saisir votre mot de passe">
						<input class="input100" type="password" name="motDePasse" placeholder="Mot de passe">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn p-t-25 p-b-25">
						<button class="login100-form-btn">
							Se connecter
						</button>
					</div>
				</form>

				<!-- choose an image randomly in the folder "Background" from 1 to 5" -->
				<!-- <img src="images/Background/{{ rand(1,3) }}.jpg" alt="background" class="login100-more"> -->
			
			</div>
		</div>
	</div>
	
	


</body>
</html>