<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>conduteurs.index</h1>
    
    <h3>Voici la liste des conducteurs!</h3>
    <a class="btn btn-default" href="{{ route('conducteurs.create') }}">Ajouter</a> 

    @if (count($conducteurs))
        @foreach($conducteurs as $conducteur)

        <ul>
            <li>{{ $conducteur->id }}</li>
            <li>{{ $conducteur->prenom }}, {{ $conducteur->nom }}</li>
            <li>{{ $conducteur->matricule }}</li>
            <li>{{ $conducteur->adresseCourriel }}</li>
            <li>{{ $conducteur->motDePasse }}</li>
            <li>{{ $conducteur->actif }}</li>
        </ul>

        @endforeach
    @else
        <p>Il n'y a aucun conducteur.</p>

    @endif

</body>
</html>