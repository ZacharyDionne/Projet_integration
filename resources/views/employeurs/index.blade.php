<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employeur</title>

    <!-- CSS -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->	
	<link rel="stylesheet" href="css/styleTable.css">
    <!--===============================================================================================-->	
	<link rel="stylesheet" href="css/style.css">
    <!--===============================================================================================-->

</head>
<body>

    <!-- Tableau avec informations sur chaque employeurs -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-3 text-center mb-1 title-placement">
					<p class="top-small-title">LISTE DES EMPLOYEURS</p>
					<h2 class="heading-section list-title">EMPLOYEUR</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  	<thead class="bg-tr-up">
						    	<tr class="shadow p-3 mb-5">
                                    <!-- Titre -->
									<th class="font-tr">ID</th>
									<th class="font-tr">NOM</th>
									<th class="font-tr">MOT DE PASSE</th>
									<th class="font-tr">ADRESSE COURRIEL</th>
									<th class="font-tr">ACTIF</th>
                                    <!-- Bouton pour ajouter -->
									<th class="font-tr">
										<a type="button" title="Ajouter" class="btn btn-ajouter" href="{{ route('employeurs.create') }}">
											<i class="fa fa-plus" aria-hidden="true"></i>
											AJOUTER
										</a>
									</th>
						    	</tr>
						  	</thead>
						  	<tbody>
                                <!-- Information sur chaque employé (foreach) -->
						  	@if (count($employeurs))
								@foreach($employeurs as $employeur)
								<tr class="alert shadow p-3 mb-5 bg-white rounded" role="alert">
									<th class="font-rg" scope="row">{{ $employeur->id }}</th>
									<td class="font-rg">{{ $employeur->prenom }}, {{ $employeur->nom }}</td>
									<td class="font-rg">{{ $employeur->motDePasse }}</td>
									<td class="font-rg">{{ $employeur->adresseCourriel }}</td>
									<td class="font-rg">{{ $employeur->actif }}</td>
									<td>
										<!-- Bouton + Route pour aller dans la modification de l'employeur -->
									</td>
                                    <td>
										<a type="button" title="Modifier" class="btn btn-edit" href="{{ route('employeurs.edit', [$employeur->id]) }}">
											<i class="fa fa-pencil" aria-hidden="true"></i>
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

<!-- Scripts -->
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

    </body>
</html>