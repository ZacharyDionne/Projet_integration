<!doctype html>
<html lang="fr">
  <head>
  	<title>Conducteurs Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" href="css/styleTable.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" href="css/style.css">
<!--===============================================================================================-->

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Table #02</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="bg-tr-up">
						    <tr>
						      <th class="font-tr">ID</th>
						      <th class="font-tr">NOM</th>
						      <th class="font-tr">MATRICULE</th>
						      <th class="font-tr">ADRESSE COURRIEL</th>
							  <th class="font-tr">MOT DE PASSE</th>
							  <th class="font-tr">ACTIF</th>
						      <th class="font-tr">&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
						  @if (count($conducteurs))
        					@foreach($conducteurs as $conducteur)
						    <tr class="alert shadow p-3 mb-5 bg-white rounded" role="alert">
						      <th class="font-rg" scope="row">{{ $conducteur->id }}</th>
						      <td class="font-rg">{{ $conducteur->prenom }}, {{ $conducteur->nom }}</td>
						      <td class="font-rg">{{ $conducteur->matricule }}</td>
						      <td class="font-rg">{{ $conducteur->adresseCourriel }}</td>
							  <td class="font-rg">{{ $conducteur->motDePasse }}</td>
							  <td class="font-rg">{{ $conducteur->actif }}</td>
						      <td>
						      	<a href="#" class="close" data-dismiss="alert" aria-label="Close">
				            	<span aria-hidden="true"><i class="fa fa-close"></i></span>
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

	</body>
</html>


    
    <!-- <h3>Voici la liste des conducteurs!</h3>
    @if (count($conducteurs))
        @foreach($conducteurs as $conducteur)

        <ul>
            <li>{{ $conducteur->id }}</li>
            <li>{{ $conducteur->prenom }}, {{ $conducteur->nom }}</li>
            <li>{{ $conducteur->matricule }}</li>
            <li>{{ $conducteur->adresseCourriel }}</li>
            <li>{{ $conducteur->motDePasse }}</li>
            <li>{{ $conducteur->actif }}</li>
        </ul>

        @endforeach
    @else
        <p>Il n'y a aucun conducteur.</p>

    @endif -->