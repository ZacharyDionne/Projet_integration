<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modification employe</title>
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
            @$error
        @endforeach
        <script>
            alert("{{ $error }}");
        </script>
    @endif
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-create100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-142" method="post" action="{{ route('employes.update', [$employe->id]) }}">
                    @csrf
                    @method("patch")
					<span class="login100-form-title">
                    <img src="{{ asset('images/logo_BLANC.png') }}" alt="logo" class="login100-form-logo">
                    Modifier un employe
					</span>

                    <div class="container-row-create-c2 p-t-78">
                        <!-- Prénom employe -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="prenom">Prénom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un prénom">
                                <input class="input100" id="prenom" type="text" name="prenomEmploye" placeholder="Insérer votre prénom" value="{{ $employe->prenom }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Nom employe-->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="nom">Nom</label>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate="Saisissez un nom">
                                <input class="input100" id="nom" type="text" name="nomEmploye" placeholder="Insérer votre nom" value="{{ $employe->nom }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>

                    <div class="container-row-create-c2 p-t-38">
                        <!-- Email -->
                        <div>
                            <div class="header-font font-rg m-l-20">
                                <label for="email">Adresse électronique</label>
                            </div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Saisissez une adresse électronique">
                                <input class="input100" id="email" type="email" name="adresseCourriel" placeholder="Insérer votre adresse électronique" value="{{ $employe->adresseCourriel }}">
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                        <!-- Information nécessaire, mais non modifiable -->

    
                        <!-- Mot de passe -->
                        <div>
                            <div class="w-100 wrap-input100 validate-input" data-validate="Veuillez saisir votre mot de passe" value="{{ $employe->motDePasse }}">
                                <input  id="motdepasse" type="password" name="motDePasse" placeholder="Insérer votre mot de passe">
                            </div>
                        </div>


                        <!-- Statut -->
                        <div>
                            <div class="header-font font-rg m-l-16">
                                <label for="email">Statut</label>
                            </div>
                            <!-- Actif -->              
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="actif" name="actifEmploye" value="1" checked="Yes">
                                <label for="actif">Actif</label>
                            </div>
                            <!-- Inactif -->
                            <div class="wrap-input100 validate-input">
                                <input type="radio" id="inactif" name="actifEmploye" value="0">
                                <label for="inactif">Inactif</label>
                            </div>
                        </div>
                    </div>
                    <div class="container-row-create-c2 p-t-20 p-b-20">
                        <div class="container-login100-form-btn p-t-20 p-b-20">
                            <a type="button" class="cancel100-form-btn" href="{{ route('employes.index') }}">
                                <i class="fa fa-ban p-r-5" aria-hidden="true"></i>
                                Annuler
                            </a>
                        </div>
                        <div class="container-login100-form-btn p-t-20 p-b-20">
                            <button type="submit" class="login100-form-btn">
                                <i class="fa fa-floppy-o p-r-5" aria-hidden="true"></i>
                                Sauvegarder
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Employe</title>
</head>
<body>
    <h1>Informations personnelles</h1>
    @if(isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ route('employes.update', [$employe->id]) }}">
        @csrf
        @method("patch")-->
        <!-- Nom Employe --><!--
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" value="{{ $employe->nom }}">
        <br>-->
        <!-- Prénom Employe --><!--
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="{{ $employe->prenom }}">
        <br>-->
        <!-- Adresse Courriel Employe --><!--
        <label for="adresseCourriel">Courriel</label>
        <input type="email" id="adresseCourriel" name="adresseCourriel" value="{{ $employe->adresseCourriel }}">
        <br>-->
        <!-- Actif Employe --><!--
        <label for="actif">Actif</label><br>
        <input type="radio" id="actif" name="actif" value="1" checked>
        <br>
        <label for="actif">Non Actif</label>
        <input type="radio" id="actif" name="actif" value="0">
-->
        <!-- Type Employe -->
     <!--   
      <button>Sauvegarder</button>
    </form>
    <hr>
    <h2>Modification de mot de passe</h2>
    <form method="post" action="{{ route('employes.updatePassword', [$employe->id]) }}">
        @csrf
        @method("patch")
        <label for="motDePasse">Confirmer mot de passe</label>
        <input type="password" id="motDePasse" name="motDePasse">
        <br>
        <button>Modifier</button>
    </form>
</body>
</html>
-->