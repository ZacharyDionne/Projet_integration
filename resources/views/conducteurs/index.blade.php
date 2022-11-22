@extends('layouts.app')

@section('titre', 'Conducteurs')

@section('cssSupplementaire')
	<link rel="stylesheet" href="{{ asset('css/styleTable.css') }}">
	<script defer type="module" src="{{ asset('js/conducteurs/index.js') }}"></script>
	<script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<script defer src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script defer src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script defer src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
	@endsection

	@section('contenu')
		<section class="ftco-section p-3">
			<div class="flex-container">
				<div class="card card-employes">
					<div class="card-header cardheader-employes">
						Conducteurs
					</div>
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-md-3 text-center mb-1 title-placement">
								<p class="top-small-title">LISTE DES USAGERS</p>
								<h2 class="heading-section list-title">CONDUCTEURS</h2>
							</div>
						</div>
						<div class="grid-placement">
							<div class="row">
								<div class="col-md-12">
									<div class="table-wrap">
										<table class="table">
											<thead class="bg-tr-up">
												<tr class="shadow-sm">
													<th class="font-tr">NOM</th>
													<th class="font-tr">MATRICULE</th>
													<th class="font-tr">ADRESSE COURRIEL</th>
													<th class="font-tr">ACTIF</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@if (isset($conducteurs) && count($conducteurs))
													@foreach($conducteurs as $conducteur)
														<tr class="alert shadow-sm" role="alert">
															<td class="font-rg">{{ $conducteur->prenom }}, {{ $conducteur->nom }}</td>
															<td class="font-rg">{{ $conducteur->matricule }}</td>
															<td class="font-rg">{{ $conducteur->adresseCourriel }}</td>
															<td class="font-rg">
																<form class="d-flex align-items-center" conducteur="{{ $conducteur->id }}">
																	@csrf
																	@method("patch")
																	<div class="form-check form-switch">
																		<input type="checkbox" class="form-check-input xmlCheckbox" role="switch" id="actif" name="actif" @checked($conducteur->actif)>
																		<label class="form-check-label" for="actif">Actif</label>
																	</div>
																</form>
															</td>
															<td>
																<a type="button" title="Fiches" class="button button-list" href="{{ route('fiches.index') }}">
																	<i class="fa fa-list" aria-hidden="true"></i>
																	FICHES
																</a>
															</td>
														</tr>
													@endforeach
												@else
													<p style="color: red;">Il n'y a aucun conducteurs.</p>
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection