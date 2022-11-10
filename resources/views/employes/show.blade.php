<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employé</title>
</head>
<body>
    <h1>employes.index</h1>
    
    <h3>Voici le conducteur!</h3>
    @if ($employe)

        <ul>
            <li>{{ $employe->id }}</li>
            <li>{{ $employe->prenom }}, {{ $employe->nom }}</li>
            <li>{{ $employe->adresseCourriel }}</li>
            <li>{{ $employe->motDePasse }}</li>
            <li>{{ $employe->actif }}</li>  
        </ul>

    @else
        <p>Employé invalide.</p>

    @endif

</body>
</html>