<!-- AFFICHAGE DES EMPLOYEURS -->

@extends('layouts.app')

@section('titre', 'Employeurs')

@section('cssSupplementaire')
<link rel="stylesheet" href="{{ asset('css/styleTable.css') }}">
@endsection

@section('contenu')
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-3 text-center mb-1 title-placement">
						<p class="top-small-title">LISTE DES EMPLOYEURS</p>
						<h2 class="heading-section list-title">EMPLOYEURS</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-wrap">
							<table class="table">
								<thead class="bg-tr-up">
									<tr class="shadow p-3 mb-5">
										<th class="font-tr">NOM</th>
										<th class="font-tr">ADRESSE COURRIEL</th>
										<th class="font-tr">ACTIF</th>

										<!-- Ajout d'un employeur (BOUTON) -->
										<th class="font-tr">
											<a type="button" title="Ajouter" class="button button-ajouter" href="{{ route('employeurs.create') }}">
												<i class="fa fa-plus" aria-hidden="true"></i>
												AJOUTER
											</a>
										</th>
									</tr>
								</thead>
								<tbody>
								
								<!-- Affichage des employeurs s'il y en a -->
								@if (count($employeurs))
										@foreach($employeurs as $employeur)
										<tr class="alert shadow p-3 mb-5 bg-white rounded" role="alert">
											<td class="font-rg">{{ $employeur->prenom }}, {{ $employeur->nom }}</td>
											<td class="font-rg">{{ $employeur->adresseCourriel }}</td>
											<td class="font-rg">{{ $employeur->actif ? 'Actif': 'Inactif' }}</td>

											<!-- Modifier un employeur précis (BOUTON) -->
											<td>
												<a type="button" title="Modifier" class="button button-edit" href="{{ route('employeurs.edit', [$employeur->id]) }}">
													<i class="fa fa-pencil" aria-hidden="true"></i>
													MODIFIER
												</a>
											</td>
										</tr>
										@endforeach
									@else
									<p style="color: red;">Il n'y a aucun employeur.</p>
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