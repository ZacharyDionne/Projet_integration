<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employeur</title>
</head>
<body>
    <h1>employeurs.index</h1>

    <h3>Voici la liste des employeurs!</h3>

    @if (count($employeurs))
        @foreach($employeurs as $employeur)
        <ul>
            <li>{{ $employeur->id }}</li>
            <li>{{ $employeur->prenom }}, {{ $employeurs->nom }}</li>
            <li>{{ $employeur->adresseCourriel }}</li>
            <li>{{ $employeur->motDePasse }}</li>
            <li>{{ $employeur->actif }}</li>            
        </ul>
        
        @endforeach
    @else
        <p>Il n'y a aucun employeur.</p>

    @endif

</body>
</html>