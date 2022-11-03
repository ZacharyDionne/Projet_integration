<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modification conducteur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="images/icons/favicon.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	@if(isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-create100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-142" method="post" action="{{ route('conducteurs.update', [$conducteur->id]) }}">
                    @csrf
                    @method("patch")
					<span class="login100-form-title">
                    <img src="../images/logo_BLANC.png" alt="logo" class="login100-form-logo">
                    Créer un conducteur
					</span>

                    <div class="container-row-create-c3 p-t-50">
                        <!-- Matricule -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="matricule">Matricule</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Veuillez saisir votre matricule">
                                <input class="input100" id="matricule" type="text" name="matriculeConducteur" placeholder="Insérer votre matricule" value="{{ $conducteur->matricule }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Prénom conducteur -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="prenom">Prénom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un prénom">
                                <input class="input100" id="prenom" type="text" name="prenomConducteur" placeholder="Insérer votre prénom" value="{{ $conducteur->prenom }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Nom conducteur-->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="nom">Nom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un nom">
                                <input class="input100" id="nom" type="text" name="nomConducteur" placeholder="Insérer votre nom" value="{{ $conducteur->nom }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>
                    <div class="container-row-create-c2 p-t-10">
                        <!-- Email -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="email">Adresse électronique</label>
                            </div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Saisissez une adresse électronique">
                                <input class="input100" id="email" type="email" name="adresseCourriel" placeholder="Insérer votre adresse électronique" value="{{ $conducteur->adresseCourriel }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Statut -->
                        <div>
                            <div class="header-font font-rg m-l-16">
                                <label for="email">Statut</label>
                            </div>
                            <!-- Actif -->              
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="actif" name="actifConducteur" value="1" checked="Yes">
                                <label for="actif">Actif</label>
                            </div>
                            <!-- Inactif -->
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="inactif" name="actifConducteur" value="0">
                                <label for="inactif">Inactif</label>
                            </div>
                        </div>
                    </div>
                    <div class="container-row-create-c2">
                    </form>
                    <form method="post" action="{{ route('conducteurs.updatePassword', [$conducteur->id]) }}">
                        @csrf
                        @method("patch")
                        <!-- Mot de passe -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="motdepasse">Mot de passe</label>
                            </div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Veuillez saisir votre mot de passe" value="{{ old('motDePasse') }}">
                                <input class="input100" id="motdepasse" type="password" name="motDePasse" placeholder="Insérer votre mot de passe">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Mot de passe vérification -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="vefMotdepasse">Vérification du mot de passe</label>
                            </div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Veuillez vérifier votre mot de passe">
                                <input class="input100" id="vefMotdepasse" type="password" name="motDePasseVef" placeholder="Vérifier votre mot de passe" value="{{ old('motDePasse') }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>

                        <div class="container-login100-form-btn p-t-16 p-b-23">
                            <button type="submit" class="login100-form-btn">
                                Créer
                            </button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>