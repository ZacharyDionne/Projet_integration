<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fiche</title>
</head>
<body>
    
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form method="post" action="{{ route('fiches.store') }}">

@csrf
    <!-- Formulaire Fiche -->
    <div class="form-group">
        <!-- Cycle Fiche -->
        <input type="radio" id="cycle" name="cycle" value="1" checked="Yes">
        <label for="cycle">Cycle 1</label><br>
    </div>   
    <div class="form-group">
        <!-- Date Fiche -->
        <label for="date">date</label>
        <input type="text" class="form-control" id="date" placeholder="date" name="date" value="{{ old('date') }}">
    </div>
    <div class="form-group">
        <!-- Observation Fiche -->
        <label for="observation">observation</label>
        <input type="text" class="form-control" id="observation" placeholder="observation" name="observation" value="{{ old('observation') }}">
    </div>
    <!-- Nom conducteur possédant la fiche -->
    <label for="conducteur_id">Choisir un conducteur</label>
  <select class="form-control" id="conducteur_id" name="conducteur_id">
    @foreach($conducteurs as $conducteur)
    <option value="{{ $conducteur->id }}">{{ $conducteur-> prenom }}</option>
    @endforeach
  </select>
  <br><br>

        
    <button type="submit" class="btn btn-primary"> Enregistrer</button>

</form>

    </body>
</html>
