<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Conducteur</title>
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
    <!-- Formulaire ajout Conducteur -->
    <div class="form-group">
        <!-- Prénom conducteur -->
        <label for="prenom">prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="{{ old('prenom') }}">
        <!-- Nom conducteur-->
        <label for="nom">nom</label>
        <input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="{{ old('nom') }}">
    </div>   
    <div class="form-group">
        <!-- AdresseCourriel conducteur-->
        <label for="adresseCourriel">adresseCourriel</label>
        <input type="text" class="form-control" id="adresseCourriel" placeholder="adresseCourriel" name="adresseCourriel" value="{{ old('adresseCourriel') }}">
        <!-- Matricule conducteur-->
        <label for="matricule">matricule</label>
        <input type="text" class="form-control" id="matricule" placeholder="matricule" name="matricule" value="{{ old('matricule') }}">
    </div>
    <div class="form-group">
        <!-- Mot de passe conducteur-->
        <label for="motDePasse">motDePasse</label>
        <input type="password" class="form-control" id="motDePasse" placeholder="motDePasse" name="motDePasse" value="{{ old('motDePasse') }}">
    </div>

    <!-- Actif Ou non conducteur-->
    <input type="radio" id="actif" name="actif" value="0">
    <label for="actif">Actif</label><br>
    <input type="radio" id="actif" name="actif" value="1">
    <label for="actif">Non Actif</label>
        
    <button type="submit" class="btn btn-primary"> Enregistrer</button>

</form>

    </body>
</html>
