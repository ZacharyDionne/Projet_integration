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
    <section class="paddingCard">
		<div class="flex-container">
            <div class="card card-employes">
                <div class="card-header cardheader-employes">
					<h4 class="heading-sectionbigleft">Nom du conducteur : {{ $conducteur->nom }}, {{ $conducteur->prenom }}
                        <br>Cycle suivi: {{ $fiche->cycle }}
                    </h4>
                    <h4 class="heading-sectionbigright">{{ $fiche->date }}
                        <br>Date: {{ \Carbon\Carbon::parse($fiche->date)->locale('fr')->isoFormat('LL') }}
                    </h4>
				</div>
                <div class="d-flex justify-content-around p-4">
                    <a class="btn btn-primary button-page font-tr w-100 mr-2" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->subDay()->format('Y-m-d')]) }}">
                        <i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="item-label">Journée précédente</span>
                    </a>
                    <a class="btn btn-primary button-page font-tr w-100 ml-2 mr-2" href="{{ route('fiches.index', ['id' => $fiche->conducteur_id]) }}">
                        <i class="fa fa-list fa-fw" aria-hidden="true"></i><span class="item-label">Retour à la liste des fiches</span>
                    </a>
                    <a class="btn btn-primary button-page font-tr w-100 ml-2" href="{{ route('fiches.edit', ['id' => $fiche->conducteur_id, 'date' => \Carbon\Carbon::parse($fiche->date)->addDay()->format('Y-m-d')]) }}">
                        <span class="item-label">Journée suivante</span><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="grid-placement marginGrid">
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-primary button-add font-tr w-100 mr-2" id="boutonAjouter">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i><span class="item-label">Ajouter</span>
                        </a>
                        <a class="btn btn-primary button-delete font-tr w-100 ml-2" id="boutonSupprimer">
                            <i class="fa fa-trash fa-fw" aria-hidden="true"></i><span class="item-label">Supprimer</span>
                        </a>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-wrap">
								<table class="tableFiche flex-container" id="tableModification">
									<thead class="bg-tr-up">
										<tr class="shadow-sm">
                                            <th class="font-tr">
                                                <input type="checkbox" class="checkSize" id="selectAll">
                                            </th>
                                            <th class="font-tr">Début<span class="item-label"> de l'activité</span></th>
                                            <th class="font-tr">Fin<span class="item-label"> de l'activité</span></th>
                                            <th class="font-tr">Type</th>
										</tr>
									</thead>
									<tbody class="spacingTable">
                                        @for ($i = 0; $i < count($plagesDeTemps); $i++)
											<tr class="shadow-sm colorTableContent">
                                                <td class="font-rg">
                                                    <input type="checkbox" class=" checkSize select">
                                                </td>
                                                <td class="font-rg"><input type="time" step="900" class="heureDebut" value="{{ $plagesDeTemps[$i]['heureDebut'] }}"></td>
                                                <td class="font-rg"><input type="time" step="900" class="heureFin"   value="{{ $plagesDeTemps[$i]['heureFin']   }}"></td>
                                                <td class="font-rg">
                                                    <select class="selectSize">
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
                    <div class="grid-placement marginGrid mt-4">
                        <h6 class="heading-sectionsmall text-left list-title float-left">Commentaire(s)</h6>
                        <input type="hidden" id="plagesDeTemps" name="plagesDeTemps">
                        <input type="hidden" name="fiche_id" value="{{ $fiche->id }}">
                        <textarea id="observation" rows="4" class="w-100" name="observation">{{ $fiche->observation }}</textarea>                    
                        <input type="hidden" id="fini" name="fini" value="0">
                    </div>
                    <div class="d-flex justify-content-around p-4">
                        <button type="button" class="btn btn-primary button-page font-tr w-100 mr-2" id="boutonEnregistrer">
                            <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i><span class="item-label">Enregistrer</span>
                        </button>
                        <button type="button" class="btn btn-primary button-list font-tr w-50 ml-2" id="boutonTerminer">
                            <i class="fa fa-paper-plane fa-fw" aria-hidden="true"></i><span class="item-label">Compléter</span>
                        </button>
                    </div>
                </form>

                <p id="erreurChevauche" class="text-danger d-none">Des temps se chevauchent.</p>
                <p id="erreurVide" class="text-danger d-none">Des temps ne sont pas rempli.</p>
                <p id="erreurTempsRetour" class="text-danger d-none">Des temps finaux sont plus petit que les temps initiales.</p>
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach

                <!-- Cette partie donne à Javascript le format pour une colonne d'une plage de temps -->
                <table class="d-none">
                    <tbody>
                        <tr class="shadow-sm colorTableContent" id="rowTemplate">
                            <td class="font-rg">
                                <input type="checkbox" class="checkSize select">
                            </td>
                            <td class="font-rg"><input type="time" step="900" class="heureDebut"></td>
                            <td class="font-rg"><input type="time" step="900" class="heureFin"></td>
                            <td class="font-rg">
                                <select class="selectSize">
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