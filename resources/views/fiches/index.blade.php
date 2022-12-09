@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="stylesheet" href="{{ asset('css/styleCalendar.css') }}">
<link rel="stylesheet" href="{{ asset('css/styleModal.css') }}">
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />

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
				<h3 class="text-center onlyFontTr ttlFiche">Fiches des 14 derniers jours :</h3>
				<p class="text-center">Heures de travail cumulées : {{ $totalHeures }}
					</br>Heures de repos cumulées : {{ $totalHeuresRepos }}</p>

				@foreach($lastFiches as $lastFiche)
				<div class="baniere-body-fiche">
					@if($lastFiche->fini == 0)
					<i class="fa fa-square-o fa-lg baniere-body-fiche-icon"></i>
					@else
					<i class="fa fa-check-square fa-lg baniere-body-fiche-icon"></i>
					@endif
					<h3 class="heading-section mt-2">Fiche du {{ \Carbon\Carbon::parse($lastFiche->date)->locale('fr')->isoFormat('dddd, D MMMM YYYY') }}</h3>
					<div class="baniere-body-left text-center">

						<div class="pl-text text-left mb-2">
							<!-- si heures de travail == 00:00, C'est qui na pas d<heures de travail -->
							@if($lastFiche->heures != '00:00')
							<p class="mb-1">Début du poste de travail : {{ $lastFiche->heureDebut }}</p>
							<p class="mb-1">Fin du poste de travail : {{ $lastFiche->heureFin }}</p>
							<p class="mb-1">Heures de travail : {{ $lastFiche->heures }}</p>
							@else
							<p class="mb-1">Heures de travail : 00:00 - Repos</p>
							@endif


							@if($lastFiche->fini == 0)
							<p class="mb-1">État : Non complété</p>
							@else
							<p class="mb-1">État : Complété</p>
							@endif
						</div>

						@if($lastFiche->observation != null)
						<p class="mb-1">Commentaire : {{ $lastFiche->observation }}</p>
						@endif

						<a class="btn btn-primary btnFiche" href="{{ route('fiches.edit', [$lastFiche->conducteur_id, $lastFiche->date]) }}">Voir la fiche</a>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content rounded-0">
			<div class="modal-body py-0">


				<div class="d-flex main-content">
					<div class="bg-image promo-img mr-3" style="background-image: url('images/img_1.jpg');">
					</div>
					<div class="content-text p-4">
						<h3 class="modal-title text-center"></h3>
						<p class="text-center">Entrez les heures pour ce jour seulement.
							<br>Pour les heures après minuit, veuillez utiliser la fiche du lendemain.
						</p>

						<form action="#">
							<div class="form-group text-center">
								<label class="modalLabel" for="heureDebut">Heure commencé</label>
								<br />
								<input type="time" id="heureDebut" name="appt" min="09:00" max="18:00" required>
							</div>
							<div class="form-group text-center">
								<label class="modalLabel" for="heureDebut">Heure finis</label>
								<br />
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
</div> -->

@endsection