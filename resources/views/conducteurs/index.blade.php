@extends('layouts.app')

	@section('titre', 'Conducteurs')

	@section('cssSupplementaire')
	<link rel="stylesheet" href="{{ asset('css/styleTable.css') }}">
	@endsection

	@section('contenu')
			<section class="ftco-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-3 text-center mb-1 title-placement">
							<p class="top-small-title">LISTE DES USAGERS</p>
							<h2 class="heading-section list-title">CONDUCTEURS</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-wrap">
								<table class="table">
									<thead class="bg-tr-up">
										<tr class="shadow p-3 mb-5">
											<th class="font-tr">NOM</th>
											<th class="font-tr">MATRICULE</th>
											<th class="font-tr">ADRESSE COURRIEL</th>
											<th class="font-tr">ACTIF</th>
											<th class="font-tr">
												<a type="button" title="Ajouter" class="button button-ajouter" href="{{ route('conducteurs.create') }}">
													<i class="fa fa-plus" aria-hidden="true"></i>
													AJOUTER
												</a>
											</th>
										</tr>
									</thead>
									<tbody>
									@if (count($conducteurs))
										@foreach($conducteurs as $conducteur)
										<tr class="alert shadow p-3 mb-5 bg-white rounded" role="alert">
											<td class="font-rg">{{ $conducteur->prenom }}, {{ $conducteur->nom }}</td>
											<td class="font-rg">{{ $conducteur->matricule }}</td>
											<td class="font-rg">{{ $conducteur->adresseCourriel }}</td>
											<td class="font-rg">{{ $conducteur->actif ? 'Actif': 'Inactif' }}</td>
											<td>
												<a type="button" title="Fiches" class="button button-list" href="{{ route('fiches.index') }}">
													<i class="fa fa-list" aria-hidden="true"></i>
												</a>
												<a type="button" title="Modifier" class="button button-edit" href="{{ route('conducteurs.edit', [$conducteur->id]) }}">
													<i class="fa fa-pencil" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										@endforeach
									@else
									<p>Il n'y a aucun conducteur.</p>
									@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>

		<!--===============================================================================================-->
			<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
			<script src="vendor/bootstrap/js/popper.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
			<script src="vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
			<script src="vendor/daterangepicker/moment.min.js"></script>
			<script src="vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
			<script src="vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
			<script src="js/mainTable.js"></script>
		<!--===============================================================================================-->
	@endsection