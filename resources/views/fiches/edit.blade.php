@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />

@endsection

@section('contenu')
    <h1>{{ $fiche->date }}</h1>
    <h3>Nom du conducteur: {{ $conducteur->nom }}, {{ $conducteur->prenom }}</h3>
    <h4>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}</h4>
    <h4>Cycle suivi: {{ $fiche->cycle }}</h4>

    <table>
        <thead>
            <tr>
                <th>Début de l'activité</th>
                <th>Fin de l'activité</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plageDeTemps in $plagesDeTemps)
                <tr>
                    <td>{{ $plageDeTemps->heureDebut }}</td>
                    <td>{{ $plageDeTemps->heureFin }}</td>
                    <td>{{ $plageDeTemps->typetemps_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Journée précédente</h1>
    <a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->subDay()->format('Y-m-d')]) }}">Journée précédente</a>
    <h1>Journée suivante</h1>
    <a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->addDay()->format('Y-m-d')]) }}">Journée suivante</a>

    <h1>Retour à la liste des fiches</h1>
    <a class="btn btn-primary" href="{{ route('fiches.index', ['id' => $fiche->conducteur_id]) }}">Retour à la liste des fiches</a>
    <h1>Sauvegarder et marquer comme completer</h1>
@endsection