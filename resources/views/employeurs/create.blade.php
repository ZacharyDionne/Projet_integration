<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création Employeur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
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
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->

</head>
<body>
	@if (isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post" action="{{ route('employeurs.store') }}">
                    @csrf
					<span class="login100-form-title">
                    <img src="images/logo_BLANC.png" alt="logo" class="login100-form-logo">
                    Créer un employeur
					</span>

                    <!-- Prénom employeur  -->
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Saisissez un prénom">
                        <input class="input100" type="text" name="prenomEmployeur" placeholder="Prénom">
						<span class="focus-input100"></span>
                    </div>
                    <!-- Nom employeur -->
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Saisissez un nom">
                        <input class="input100" type="text" name="nomEmployeur" placeholder="Nom">
						<span class="focus-input100"></span>
                    </div>
                    <!-- Adresse courriel employeur -->
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Saisissez une adresse courriel">
                        <input class="input100" type="email" name="adresseCourriel" placeholder="Adresse courriel">
						<span class="focus-input100"></span>
                    </div>

                    <!-- Mot de passe employeur -->
					<div class="wrap-input100 validate-input " data-validate = "Veuillez saisir votre mot de passe">
						<input class="input100" type="password" name="motDePasse" placeholder="Mot de passe">
						<span class="focus-input100"></span>
					</div>

                    <!-- Type Employeur -->
                    <label for="type_id">Choisir un type</label>
                        <select class="form-control" id="type_id" name="type_id">
                            @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->typeEmp }}</option>
                            @endforeach
                        </select>

					<div class="container-login100-form-btn p-t-16 p-b-23">
						<button class="login100-form-btn">
							Créer
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- SCRIPTS -->
    <!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>















<!--     
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form method="post" action="{{ route('employeurs.store') }}">

@csrf-->
    <!-- Formulaire Employeur -->
   <!-- <div class="form-group">-->
        <!-- Prénom Employeur -->
       <!-- <label for="prenom">prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="{{ old('prenom') }}">-->
        <!-- Nom Employeur -->
        <!--<label for="nom">nom</label>
        <input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="{{ old('nom') }}">
    </div>   
    <div class="form-group">-->
        <!-- AdresseCourriel Employeur -->
        <!--<label for="adresseCourriel">adresseCourriel</label>
        <input type="text" class="form-control" id="adresseCourriel" placeholder="adresseCourriel" name="adresseCourriel" value="{{ old('adresseCourriel') }}">
    </div>
    <div class="form-group">-->
        <!-- MotDePasse Employeur -->
       <!-- <label for="motDePasse">motDePasse</label>
        <input type="password" class="form-control" id="motDePasse" placeholder="motDePasse" name="motDePasse" value="{{ old('motDePasse') }}">
    </div>-->
    <!-- Type Employeur -->
   <!-- <label for="type_id">Choisir un type</label>
  <select class="form-control" id="type_id" name="type_id">
    @foreach($types as $type)
    <option value="{{ $type->id }}">{{ $type->typeEmp }}</option>
    @endforeach
  </select>
  <br><br>-->
    <!-- Actif Ou Non Employeur -->
  <!--<input type="radio" id="actif" name="actif" value="1" checked>
    <label for="actif">Actif</label><br>
    <input type="radio" id="actif" name="actif" value="0">
    <label for="actif">Non Actif</label>
        
    <button type="submit" class="btn btn-primary"> Enregistrer</button>

</form>-->

    
