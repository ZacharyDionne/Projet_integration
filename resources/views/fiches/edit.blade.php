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
                <th>
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll">Tout sélectionner</label>
                </th>
                <th>Début de l'activité</th>
                <th>Fin de l'activité</th>
                <th>Type</th>
                <th><button type="button">Ajouter</button></th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($plagesDeTemps); $i++)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td><input type="time" value="{{ $plagesDeTemps[$i]['heureDebut']}}"></td>
                    <td><input type="time" value="{{ $plagesDeTemps[$i]['heureFin'] }}"></td>
                    <td>
                        <select>
                            @for ($j = 0; $j < count($typesTemps); $j++)
                                <option
                                    @if ($typesTemps[$j]["id"] == $plagesDeTemps[$i]["typetemps_id"])
                                        selected
                                    @endif
                                >
                                    {{ $typesTemps[$j]["type"] }}
                                </option>
                            @endfor
                        </select>
                    </td>
                    <td></td>
                </tr>
            @endfor
            
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