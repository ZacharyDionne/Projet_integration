@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />

@endsection

@section('contenu')
<!-- h1 show the date of {fiche} -->
<h1>{{ $fiche->date }}</h1>

<!-- Make a table with 5 rows -->
<table>
    <tr>
        <!-- nom complet du conducteur dans la session stocker dans user_name -->
        <h3>Nom du conducteur: {{ $conducteur->nom }}, {{ $conducteur->prenom }}</h3>
        <h4>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}</h4>
        <h4>Cycle suivi: {{ $fiche->cycle }}</h4>
    </tr>
    <tr>
        <th>Début de l'activité</th>
        <th>Fin de l'activité</th>
        <th>Repos</th>
        <th>Conduite</th>
        <th>Travail (sauf conduite)</th>
    </tr>
    <!-- Make a loop to create 5 rows -->
    @for($i = 0; $i < 5; $i++) <tr>
        <!-- Make a loop to create 5 columns -->
        @for($j = 0; $j < 5; $j++) <td>
            <input type="text" name="heure" value="{{ $fiche->heure }}">
            </td>
            @endfor
            </tr>
            @endfor
</table>

<h1>Journée précédente</h1>
<a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->subDay()->format('Y-m-d')]) }}">Journée précédente</a>
<h1>Journée suivante</h1>
<a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->addDay()->format('Y-m-d')]) }}">Journée suivante</a>

<h1>Retour à la liste des fiches</h1>
<a class="btn btn-primary" href="{{ route('fiches.index', ['id' => $fiche->conducteur_id]) }}">Retour à la liste des fiches</a>
<h1>Sauvegarder et marquer comme completer</h1>

@endsection