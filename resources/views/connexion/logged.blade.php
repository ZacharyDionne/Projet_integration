<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion réussi</title>
</head>
<body>
    <h1>Connexion réussi à
        <span>
            @if (auth()->guard("conducteur")->user())
                {{ auth()->guard("conducteur")->user()->adresseCourriel; }}
            @elseif (auth()->guard("employeur")->user())
                {{ auth()->guard("employeur")->user()->adresseCourriel; }}
            @endif
        </span>
    </h1>
    <a href="{{ route('connexion.logout') }}">Déconnexion</a>
</body>
</html>