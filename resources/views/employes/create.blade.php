<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création Employeur</title>
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
    <!-- Affichage des erreurs s'il y a lieu -->
	@if (isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-create100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-142" method="post" action="{{ route('employeurs.store') }}">
                    @csrf
					<span class="login100-form-title">
                    <img src="../images/logo_BLANC.png" alt="logo" class="login100-form-logo">
                    Créer un Employeur
					</span>

                    <div class="container-row-create-c3 p-t-100">
                        <!-- Prénom employeur -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="prenom">Prénom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un prénom">
                                <input class="input100" id="prenom" type="text" name="prenomEmployeur" placeholder="Insérer votre prénom" value="{{ old('prenom') }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Nom employeur-->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="nom">Nom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un nom">
                                <input class="input100" id="nom" type="text" name="nomEmployeur" placeholder="Insérer votre nom" value="{{ old('nom') }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>
                    <div class="container-row-create-c2 p-t-10">
                        <!-- Email -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="email">Adresse courriel</label>
                            </div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Saisissez une adresse électronique">
                                <input class="input100" id="email" type="email" name="adresseCourriel" placeholder="Insérer votre adresse électronique" value="{{ old('adresseCourriel') }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Statut -->
                        <div>
                            <div class="header-font font-rg m-l-16">
                                <label for="actif">Statut</label>
                            </div>
                            <!-- Actif -->              
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="actif" name="actifEmployeur" value="1" checked="Yes">
                                <label for="actif">Actif</label>
                            </div>
                            <!-- Inactif -->
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="inactif" name="actifEmployeur" value="0">
                                <label for="inactif">Inactif</label>
                            </div>
                        </div>
                    </div>


                        <!-- Type Employeur -->
                        <div class="header-font font-rg m-l-16">
                            <label for="type_id">Choisir un type</label>
                            <select  class="input100" id="type_id" name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->typeEmp }}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>

                    <div class="container-row-create-c2">
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
                            <button class="login100-form-btn">
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





<!--
</head>
<body>
    
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="post" action="{{ route('conducteurs.store') }}">

@csrf
-->
    <!-- Formulaire ajout Conducteur -->
    <!--
    <div class="form-group">
    -->
        <!-- Prénom conducteur -->
        <!--
        <label for="prenom">prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="{{ old('prenom') }}">
        -->
        <!-- Nom conducteur-->
        <!--
        <label for="nom">nom</label>
        <input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="{{ old('nom') }}">
    </div>   
    <div class="form-group">
    -->
        <!-- AdresseCourriel conducteur-->
        <!--
        <label for="adresseCourriel">adresseCourriel</label>
        <input type="text" class="form-control" id="adresseCourriel" placeholder="adresseCourriel" name="adresseCourriel" value="{{ old('adresseCourriel') }}">
        -->
        <!-- Matricule conducteur-->
        <!--
        <label for="matricule">matricule</label>
        <input type="text" class="form-control" id="matricule" placeholder="matricule" name="matricule" value="{{ old('matricule') }}">
    </div>
    <div class="form-group">
    -->
        <!-- Mot de passe conducteur-->
        <!--
        <label for="motDePasse">motDePasse</label>
        <input type="password" class="form-control" id="motDePasse" placeholder="motDePasse" name="motDePasse" value="{{ old('motDePasse') }}">
    </div>
    -->

    <!-- Actif Ou non conducteur-->
    <!--
    <input type="radio" id="actif" name="actif" value="0" checked="Yes">
    <label for="actif">Actif</label><br>
    <input type="radio" id="actif" name="actif" value="1">
    <label for="actif">Non Actif</label>
        
    <button type="submit" class="btn btn-primary"> Enregistrer</button>

</form>

    </body>
</html>
-->


