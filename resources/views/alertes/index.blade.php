@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.utf8', 'fr-FR', 'fra');
@endphp
@extends('layouts.app')

@section('titre', 'Fiches')

@section('cssSupplementaire')
<link rel="stylesheet" href="{{ asset('css/styleCalendar.css') }}">
<link rel="stylesheet" href="{{ asset('css/styleModal.css') }}">
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleAlerte.css') }}">

<script defer src="{{ asset('js/mainCalendar.js') }}"></script>
@endsection

@section('contenu')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h1 class="heading-section">Alertes</h1>
            </div>
        </div>

        @if (count($alertes))
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                @foreach ($alertes as $alerte)
                @if ($alerte->type == 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif ($alerte->type == 1)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif ($alerte->type == 2)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @endforeach

                //Vu pour un contre-maitre
                @foreach ($alertes as $alerte)
                @if ($alerte->actif == 1)
                @if ($alerte->type == 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="{{ $alerte->id }}">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                @elseif ($alerte->type == 1)
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="{{ $alerte->id }}">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                @elseif ($alerte->type == 2)
                <div class="alert alert-info alert-dismissible fade show" role="alert" id="{{ $alerte->id }}">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                @endif
                @endif
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-3">
                <h1 class="heading-section">Historique</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                @foreach ($alertes as $alerte)
                @if ($alerte->actif == 0)
                <div class="alert alert-dark fade show" role="alert" id="{{ $alerte->id }}">
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <p class="text-muted mb-0">{{ strftime('%A %d %B %Y', strtotime($alerte->date)) }}</p>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <form id="form" class="d-none">
            @csrf
            @method("patch")
        </form>

        @else
        <p>Il n'y a aucune alerte.</p>
        @endif
    </div>
</section>

<script type="module">
    import {
        UI
    } from "{{ asset('js/modules/UI.js') }}";


    let buttons = document.getElementsByTagName("section")[0].querySelectorAll("button");

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", changeAlerte);
    }

    function changeAlerte(e) {
        // Get id user in a variable using php
        @php
        try {
            $conducteur = auth() -> user();
            $employe = auth() -> guard('employe') -> user();
        } catch (Throwable $e) {
            $conducteur = null;
            $employe = null;
        }
        @endphp

        @if($conducteur)
        var idUser = {{ $conducteur -> id }};
        @elseif($employeur)
        var idUser = {{ $employeur -> id }};
        @endif

        // Get id alerte in a variable
        var id = e.target.parentNode.id;

        var button = e.target;
        button.classList.add("d-none");

        var spinner = UI.createSpinner();

        try {
            var form = document.getElementById("form");
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            // Give id (alerte), idUser
            xhr.open("POST", "/alertes/" + id + "/" + idUser + "/update");

            // Gestion du retour de la requête (load, error, loadend)
            xhr.addEventListener("load", function() {
                if (xhr.status === 200) {
                    // Success
                    console.log("ok");

                    var alerte = document.getElementById(id);
                    alerte.classList.remove("alert-danger");
                    alerte.classList.add("alert-dark");
                } else {
                    // Error
                    console.log("Refused");

                    // Remove d-none class
                    button.classList.remove("d-none");

                    var alerte = UI.createAlerte();

                    // put on the parent of the button
                    button.parentNode.appendChild(alerte);
                }
            });

            xhr.addEventListener("error", function() {
                // Error
                console.log("Error");

                button.classList.remove("d-none");


                var alerte = UI.createAlerte();
                // put on the parent of the button
                button.parentNode.appendChild(alerte);
            });

            xhr.addEventListener("loadend", function() {
                // Always
                console.log("End");

                // Remove spinner
                spinner.remove();
            });

            xhr.send(formData);

            // put on the parent of the button
            button.parentNode.appendChild(spinner);


        } catch (error) {}



    }
</script>

@endsection