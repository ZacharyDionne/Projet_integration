<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src=""></script>
</head>
<body>
    <h1>Informations personnelles</h1>
    @if(isset($errors) && $errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    <form method="post" action="{{ route('conducteurs.updateAdmin', [$conducteur->id]) }}">
        @csrf
        @method("patch")
            <label for="nom">Nom</label><input type="text" id="nom" name="nom" value="{{ $conducteur->nom }}"><br>
            <label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom" value="{{ $conducteur->prenom }}"><br>
            <label for="matricule">matricule</label><input type="text" id="matricule" name="matricule" value="{{ $conducteur->matricule }}"><br>
            <label for="adresseCourriel">Courriel</label><input type="email" id="adresseCourriel" name="adresseCourriel" value="{{ $conducteur->adresseCourriel }}"><br>
            <label for="motDePasse">Mot de passe</label><input type="password" id="motDePasse" name="motDePasse"><br>
            <label for="active">Activé</label><input type="radio" id="active" name="actif" value="1" @checked($conducteur->actif === 1)><br>
            <label for="desactive">Désactivée</label><input type="radio" id="desactive" name="actif" value="0" @checked($conducteur->actif === 0)><br>
            <button>Sauvegarder</button>
        </form>
</body>
</html>