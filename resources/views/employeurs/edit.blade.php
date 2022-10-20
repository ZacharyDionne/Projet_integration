<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Employeur</title>
</head>
<body>
    <h1>Informations personnelles</h1>
    @if(isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ route('employeurs.update', [$employeur->id]) }}">
        @csrf
        @method("patch")
        <!-- Nom Employeur -->
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" value="{{ $employeur->nom }}">
        <br>
        <!-- Prénom Employeur -->
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="{{ $employeur->prenom }}">
        <br>
        <!-- Adresse Courriel Employeur -->
        <label for="adresseCourriel">Courriel</label>
        <input type="email" id="adresseCourriel" name="adresseCourriel" value="{{ $employeur->adresseCourriel }}">
        <br>
        <!-- Actif Employeur -->
        <label for="actif">Actif</label><br>
        <input type="radio" id="actif" name="actif" value="1" checked>
        <br>
        <label for="actif">Non Actif</label>
        <input type="radio" id="actif" name="actif" value="0">

        <!-- Type Employeur -->
        
      <button>Sauvegarder</button>
    </form>
    <hr>
    <h2>Modification de mot de passe</h2>
    <form method="post" action="{{ route('employeurs.updatePassword', [$employeur->id]) }}">
        @csrf
        @method("patch")
        <label for="motDePasse">Confirmer mot de passe</label>
        <input type="password" id="motDePasse" name="motDePasse">
        <br>
        <button>Modifier</button>
    </form>
</body>
</html>