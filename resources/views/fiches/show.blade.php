<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fiche</title>
</head>
<body>
    
<!-- h1 show the date of {fiche} -->
<h1>{{ $fiche->date }}</h1>

<!-- Make a table with 5 rows -->
<table>
    <tr>
        <!-- nom complet du conducteur dans la session stocker dans user_name -->
        <h3>Nom du conducteur: {{ session('user_name') }}</h3>
        <!-- Show user id in the session -->
        <h4>Id du conducteur: {{ Auth::user()->id }}</h4>
        <!-- get conducteur id inside the fiche -->
        <h4>Id du conducteur dans la fiche: {{ $fiche->conducteur_id }}</h4>
        <h4>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}</h4>
        <h4>Cycle suivi: 1</h4>
    </tr>
    <tr>
        <th>Début de l'activité</th>
        <th>Fin de l'activité</th>
        <th>Repos</th>
        <th>Conduite</th>
        <th>Travail (sauf conduite)</th>
    </tr>
    <!-- Make a loop to create 5 rows -->
    @for($i = 0; $i < 5; $i++)
    <tr>
        <!-- Make a loop to create 5 columns -->
        @for($j = 0; $j < 5; $j++)
        <td>
            <input type="text" name="heure" value="{{ $fiche->heure }}">
        </td>
        @endfor
    </tr>
    @endfor
</table>

<h1>Journée précédente</h1>
<h1>Journée suivante</h1>

<h1>Sauvegarder</h1>
<h1>Sauvegarder et marquer comme completer</h1>


    </body>
</html>
