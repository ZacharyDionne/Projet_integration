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
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-3 text-center title-placement">
					<p class="top-small-title">LISTE DES EMPLOYÉS</p>
					<h2 class="heading-section list-title">EMPLOYÉS</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
							<thead class="bg-tr-up">
								<tr class="shadow">
									<th class="font-tr">NOM</th>
									<th class="font-tr">MATRICULE</th>
									<th class="font-tr">ADRESSE COURRIEL</th>
									<th class="font-tr">ACTIF</th>
									<th class="font-tr"></th>
								</tr>
							</thead>
							<tbody>
								<!-- Affichage des employes s'il y en a -->
								@if (count($employes))
									@foreach($employes as $employe)
										<tr class="alert shadow p-3 mb-5 bg-white rounded" role="alert">
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








											<!-- Modifier un employe précis (BOUTON) -->
											<td>
												<a type="button" title="Modifier" class="button button-edit" href="{{ route('employes.edit', [$employe->id]) }}">
													<i class="fa fa-pencil" aria-hidden="true"></i>
													MODIFIER
												</a>
											</td>
										</tr>
									@endforeach
								@else
									<p style="color: red;">Il n'y a aucun employe.</p>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection