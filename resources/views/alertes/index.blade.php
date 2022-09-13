<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Voici les alertes!</h1>
    @if (count($alertes))
        <ul>
        @foreach ($alertes as $alerte)
            <li>id: $alerte->id</li>
            <li>date: $alerte->date</li>
            <li>état du compte: $alerte->active</li>
            <li>message: $alerte->message</li>
            <li>redirigé à: $alerte->idEmployeur</li>
        @endforeach
        </ul>
    @else
        <p>Il n'y a aucune alerte.</p>
    @endif
</body>
</html>