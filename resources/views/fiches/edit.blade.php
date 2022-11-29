@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />
<script type="module" src="{{ asset('js/fiches/edit.js') }}" defer></script>
@endsection

@section('contenu')
    <section class="ftco-section p-3">
		<div class="flex-container">
            <div class="card card-employes">
                <h1>{{ $fiche->date }}</h1>
                <h3>Nom du conducteur: {{ $conducteur->nom }}, {{ $conducteur->prenom }}</h3>
                <h4>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}</h4>
                <h4>Cycle suivi: {{ $fiche->cycle }}</h4>

                <table id="tableModification">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll">Tout sélectionner</label>
                            </th>
                            <th>Début de l'activité</th>
                            <th>Fin de l'activité</th>
                            <th>Type</th>
                            <th><button type="button" id="boutonAjouter">Ajouter</button><button type="button" id="boutonSupprimer">Supprimer</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($plagesDeTemps); $i++)
                            <tr>
                                <td>
                                    <input type="checkbox" class="select">
                                </td>
                                <td><input type="time" step="900" value="{{ $plagesDeTemps[$i]['heureDebut']}}"></td>
                                <td><input type="time" step="900" value="{{ $plagesDeTemps[$i]['heureFin'] }}"></td>
                                <td>
                                    <select>
                                        @for ($j = 0; $j < count($typesTemps); $j++)
                                            <option
                                                @if ($typesTemps[$j]["id"] == $plagesDeTemps[$i]["typetemps_id"])
                                                    selected
                                                @endif
                                            value="{{ $j + 1 }}">
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
                <form method="post" id="formModification" action="{{ route('fiches.update', [$fiche->conducteur_id]) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="plagesDeTemps" name="plagesDeTemps">
                    <input type="hidden" name="fiche_id" value="{{ $fiche->id }}">
                    <input type="text" name="observation" value="{{ $fiche->observation }}">
                    <button type="button">Enregistrer</button>
                </form>
                <h1>Journée précédente</h1>
                <a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->subDay()->format('Y-m-d')]) }}">Journée précédente</a>
                <h1>Journée suivante</h1>
                <a class="btn btn-primary" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->addDay()->format('Y-m-d')]) }}">Journée suivante</a>

                <h1>Retour à la liste des fiches</h1>
                <a class="btn btn-primary" href="{{ route('fiches.index', ['id' => $fiche->conducteur_id]) }}">Retour à la liste des fiches</a>
                <h1>Sauvegarder et marquer comme completer</h1>



                <!-- Cette partie donne à Javascript le format pour une colonne d'une plage de temps -->
                <table class="d-none">
                    <tbody>
                        <tr id="rowTemplate">
                            <td>
                                <input type="checkbox" step="900" class="select">
                            </td>
                            <td><input type="time"></td>
                            <td><input type="time"></td>
                            <td>
                                <select>
                                    @for ($j = 0; $j < count($typesTemps); $j++)
                                        <option
                                        value="{{ $j + 1 }}">
                                            {{ $typesTemps[$j]["type"] }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection