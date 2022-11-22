<!-- AFFICHAGE DES EMPLOYEURS -->

@extends('layouts.app')

@section('titre', 'Employes')

@section('cssSupplementaire')
	<link rel="stylesheet" href="{{ asset('css/styleTable.css') }}">
	<script type="module" defer src="{{ asset('js/employes/index.js') }}"></script>
	<script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<script defer src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script defer src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script defer src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
	<!-- <script defer src="{{ asset('js/mainTable.js') }}"></script> -->
@endsection

@section('contenu')
	<section class="ftco-section p-3">
		<div class="flex-container">
			<div class="card card-employes">
				<div class="card-header cardheader-employes">
					<h4 class="heading-section text-left list-title">EMPLOYÉS</h4>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-md-3 title-placement">
							<h2 class="heading-section text-left list-title">RECHERCHER</h2>
							<input class="employe-search" type="text" placeholder="Rechercher..">
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
											</tr>
										</thead>
										<tbody>
											<!-- Affichage des employes s'il y en a -->
											@if (isset($employes) && count($employes))
												@foreach($employes as $employe)
													<tr class="alert shadow-sm" role="alert">
														<td class="font-rg">{{ $employe->prenom }}, {{ $employe->nom }}</td>
														<td class="font-rg">{{ $employe->matricule }}</td>
														<td class="font-rg">{{ $employe->adresseCourriel }}</td>
														<td class="font-rg">
															<form class="d-flex align-items-center" employe="{{ $employe->id }}">
																@csrf
																@method("patch")
																<div class="form-check form-switch">
																	<input type="checkbox" class="form-check-input xmlCheckbox" role="switch" id="actif" name="actif" @checked($employe->actif)>
																	<label class="form-check-label" for="actif">Actif</label>
																</div>
															</form>
														</td>
													</tr>
												@endforeach
											@else
												<p style="color: red;">Il n'y a aucun employés.</p>
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