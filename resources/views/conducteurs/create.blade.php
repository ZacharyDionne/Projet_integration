<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="post" action="{{ route('conducteurs.store') }}">

@csrf
    <div class="form-group">
        <label for="prenom">prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom" value="{{ old('prenom') }}">

        <label for="nom">nom</label>
        <input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="{{ old('nom') }}">
    </div>   
    <div class="form-group">
        <label for="adresseCourriel">adresseCourriel</label>
        <input type="text" class="form-control" id="adresseCourriel" placeholder="adresseCourriel" name="adresseCourriel" value="{{ old('adresseCourriel') }}">
        
        <label for="matricule">matricule</label>
        <input type="text" class="form-control" id="matricule" placeholder="matricule" name="matricule" value="{{ old('matricule') }}">
    </div>
    <div class="form-group">
        <label for="motDePasse">motDePasse</label>
        <input type="password" class="form-control" id="motDePasse" placeholder="motDePasse" name="motDePasse" value="{{ old('motDePasse') }}">
    </div>

    <input type="radio" id="0" name="actif" value="0">
    <label for="0">Actif</label><br>
    <input type="radio" id="1" name="actif" value="1">
    <label for="1">Non Actif</label>
        
    <button type="submit" class="btn btn-primary"> Enregistrer</button>

</form>

    </body>
</html>
