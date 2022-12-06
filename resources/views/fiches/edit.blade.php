@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="stylesheet" href="{{ asset('css/styleTable.css') }}">
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />
<script type="module" src="{{ asset('js/fiches/edit.js') }}" defer></script>
@endsection

@section('contenu')
    <section class="ftco-section p-3">
		<div class="flex-container">
            <div class="card card-employes">
                <div class="card-header cardheader-employes">
					<h4 class="heading-section text-left list-title float-left">Nom du conducteur : {{ $conducteur->nom }}, {{ $conducteur->prenom }}
                        <br>Cycle suivi: {{ $fiche->cycle }}
                    </h4>
                    <h4 class="heading-section text-right list-title float-right">{{ $fiche->date }}
                        <br>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}
                    </h4>
				</div>
                <div class="d-flex justify-content-around p-4">
                    <a class="btn btn-primary button-page font-tr w-100 mr-2" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->subDay()->format('Y-m-d')]) }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Journée précédente
                    </a>
                    <a class="btn btn-primary button-list font-tr w-100 ml-2 mr-2" href="{{ route('fiches.index', ['id' => $fiche->conducteur_id]) }}">
                        <i class="fa fa-list" aria-hidden="true"></i> Retour à la liste des fiches
                    </a>
                    <a class="btn btn-primary button-page font-tr w-100 ml-2" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->addDay()->format('Y-m-d')]) }}">
                        Journée suivante <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="grid-placement ml-4 mr-4">
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-primary button-add font-tr w-100 mr-2" id="boutonAjouter">
                            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter
                        </a>
                        <a class="btn btn-primary button-delete font-tr w-100 ml-2" id="boutonSupprimer">
                            <i class="fa fa-trash" aria-hidden="true"></i> Supprimer
                        </a>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-wrap">
								<table class="table flex-container" id="tableModification">
									<thead class="bg-tr-up">
										<tr class="shadow-sm">
                                            <th class="font-tr">
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th class="font-tr">Début de l'activité</th>
                                            <th class="font-tr">Fin de l'activité</th>
                                            <th class="font-tr">Type</th>
										</tr>
									</thead>
									<tbody>
                                        @for ($i = 0; $i < count($plagesDeTemps); $i++)
											<tr class="shadow-sm">
                                                <td class="font-rg">
                                                    <input type="checkbox" class="select">
                                                </td>
                                                <td class="font-rg"><input type="time" step="900" class="heureDebut" value="{{ $plagesDeTemps[$i]['heureDebut'] }}"></td>
                                                <td class="font-rg"><input type="time" step="900" class="heureFin"   value="{{ $plagesDeTemps[$i]['heureFin']   }}"></td>
                                                <td class="font-rg">
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
											</tr>
										@endfor
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                <form method="post" id="formModification" action="{{ route('fiches.update', [$fiche->conducteur_id]) }}">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="plagesDeTemps" name="plagesDeTemps">
                    <input type="hidden" name="fiche_id" value="{{ $fiche->id }}">
                    <input type="text" id="observation" name="observation" maxlength="300" value="{{ $fiche->observation }}">
                    <input type="hidden" id="fini" name="fini" value="0">
                    <button type="button" id="boutonEnregistrer">Enregistrer</button>
                    <button type="button" id="boutonTerminer">Terminer</button>
                </form>

                <p id="erreurChevauche" class="text-danger d-none">Des temps se chevauchent.</p>
                <p id="erreurVide" class="text-danger d-none">Des temps ne sont pas rempli.</p>
                <p id="erreurTempsRetour" class="text-danger d-none">Des temps finaux sont plus petit que les temps initiales.</p>


                <!-- Cette partie donne à Javascript le format pour une colonne d'une plage de temps -->
                <table class="d-none">
                    <tbody>
                        <tr class="shadow-sm" id="rowTemplate">
                            <td class="font-rg">
                                <input type="checkbox" class="select">
                            </td>
                            <td class="font-rg"><input type="time" step="900" class="heureDebut"></td>
                            <td class="font-rg"><input type="time" step="900" class="heureFin"></td>
                            <td class="font-rg">
                                <select>
                                    @for ($j = 0; $j < count($typesTemps); $j++)
                                        <option
                                            value="{{ $j + 1 }}">
                                                {{ $typesTemps[$j]["type"] }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection