<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowEmployeur</title>
</head>
<body>
    <h1>employeurs.index</h1>
    
    <h3>Voici le conducteur!</h3>
    @if ($employeur)

        <ul>
            <li>{{ $employeur->id }}</li>
            <li>{{ $employeur->prenom }}, {{ $employeur->nom }}</li>
            <li>{{ $employeur->adresseCourriel }}</li>
            <li>{{ $employeur->motDePasse }}</li>
            <li>{{ $employeur->actif }}</li>  
        </ul>

    @else
        <p>employeur invalide.</p>

    @endif

</body>
</html>