<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informations personnelles</h1>
    @if(isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ route('conducteurs.update', [$conducteur->id]) }}">
        @csrf
        @method("patch")
        <label for="nom">Nom</label><input type="text" id="nom" name="nom" value="{{ $conducteur->nom }}"><br>
        <label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom" value="{{ $conducteur->prenom }}"><br>
        <label for="adresseCourriel">Courriel</label><input type="email" id="adresseCourriel" name="adresseCourriel" value="{{ $conducteur->adresseCourriel }}"><br>
        <button>Sauvegarder</button>
    </form>
    <hr>
    <h2>Modification de mot de passe</h2>
    <form method="post" action="{{ route('conducteurs.update', [$conducteur->id]) }}">
        @csrf
        @method("patch")
        <label for="ancienMotDePasse">Ancien mot de passe</label><input type="password" id="ancienMotDePasse" name="ancienMotDePasse"><br>
        <label for="nouveauMotDePasse">Nouveau mot de passe</label><input type="password" id="nouveauMotDePasse" name="nouveauMotDePasse"><br>
        <label for="confirmerMotDePasse">Confirmer mot de passe</label><input type="password" id="confirmerMotDePasse" name="confirmerMotDePasse"><br>
        <button>Modifier</button>
    </form>
</body>
</html>