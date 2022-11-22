@php
	setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

	@section('titre', 'Fiches')

	@section('cssSupplementaire')
		<link rel="stylesheet" href="{{ asset('css/styleCalendar.css') }}">
		<link rel="stylesheet" href="{{ asset('css/styleModal.css') }}">
		<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>

		<script defer src="{{ asset('js/mainCalendar.js') }}"></script>
	@endsection

	@section('contenu')
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 text-center mb-5">
						<h2 class="heading-section">{{ session('user_name') }}</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="elegant-calencar d-md-flex">
							<div class="wrap-header d-flex align-items-center img" style="background-image: url({{ asset('images/bgCalendar.png') }});">
						<p id="reset">Aujourd'hui</p>
						<div id="header" class="p-0">
									<!-- <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div> -->
						<div class="head-info">
							<div class="head-month"></div>
							<div class="head-day"></div>
						</div>
						<!-- <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div> -->
						</div>
					</div>
					<div class="calendar-wrap">
						<div class="w-100 button-wrap">
							<div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
							<div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
						</div>
						<table id="calendar">
						<thead>
							<tr>
							<th>Dim</th>
							<th>Lun</th>
							<th>Mar</th>
							<th>Mer</th>
							<th>Jeu</th>
							<th>Ven</th>
							<th>Sam</th>
							</tr>
						</thead>
						<tbody>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						</tbody>
						</table>
					</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<h3 class="text-center onlyFontTr ttlFiche">Fiches des 7 derniers jours :</h3>
							<p class="text-center">Heures cumulées : 72<span id="totalHours"></span> | · | Heures de repos : 102</p>

							<!-- if $lastFiches[0] exist -->
							<div class="baniere-body-1">
								<!-- show date from ($lastFiches[0]->date) which is a 'yyyy-mm-dd' format, using the local language 
								ex in french: lundi, 1 novembre
								using strftime -->
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[0]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[0]->observation != null)
										<p>Observation : {{ $lastFiches[0]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-2">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[1]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[1]->observation != null)
										<p>Observation : {{ $lastFiches[1]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-3">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[2]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[2]->observation != null)
										<p>Observation : {{ $lastFiches[2]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-4">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[3]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[3]->observation != null)
										<p>Observation : {{ $lastFiches[3]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-5">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[4]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[4]->observation != null)
										<p>Observation : {{ $lastFiches[4]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-6">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[5]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[5]->observation != null)
										<p>Observation : {{ $lastFiches[5]->observation }}</p>
									@endif
								</div>
							</div>

							<div class="baniere-body-7">
								<h3 class="heading-section">Fiche du {{ strftime('%A %d %B', strtotime($lastFiches[6]->date)) }}</h3>
								<div class="baniere-body-left text-center">
									<p>Aucune donnée existante</p>

									@if($lastFiches[6]->observation != null)
										<p>Observation : {{ $lastFiches[6]->observation }}</p>
									@endif 
								</div>
							</div>
						
					</div>
				</div>
			</div>
		</section>

			<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content rounded-0">
			<div class="modal-body py-0">

				
				<div class="d-flex main-content">
				<div class="bg-image promo-img mr-3" style="background-image: url('images/img_1.jpg');">
				</div>
				<div class="content-text p-4">
					<h3 class="modal-title text-center"></h3>
					<p class="text-center">Entrez les heures pour ce jour seulement. 
					<br>Pour les heures après minuit, veuillez utiliser la fiche du lendemain.</p>

					<form action="#">
					<div class="form-group text-center">
						<label class="modalLabel" for="heureDebut">Heure commencé</label>
						<br/>
						<input type="time" id="heureDebut" name="appt" min="09:00" max="18:00" required>
					</div>
					<div class="form-group text-center">
						<label class="modalLabel" for="heureDebut">Heure finis</label>
						<br/>
						<input type="time" id="heureFin" name="appt" min="09:00" max="18:00" required>
					</div>
					<div class="form-group text-center">
						<label class="modalLabel" for="name">Raison du retard / Commentaire (facultatif)</label>
						<input type="text" class="form-control" id="password">
					</div>
					<div class="form-group text-center">
						<input type="submit" value="Sauvegarder" class="btn btn-primary btn-block">
					</div>
					<div class="form-group text-center">
						<p class="custom-note"><small>Veuillez vous assurer que les informations fournies sont correctes..</small></p>
					</div>
					</form>
				</div>
				</div>

			</div>
			</div>
		</div>
		</div>

	@endsection
