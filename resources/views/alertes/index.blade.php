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
                    <button type="button" class="btn-close" aria-label="Close" onclick="changeAlerte({{ $alerte->id }})"></button>
                </div>
                @elseif ($alerte->type == 1)
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="{{ $alerte->id }}">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" aria-label="Close" onclick="changeAlerte({{ $alerte->id }})"></button>
                </div>
                @elseif ($alerte->type == 2)
                <div class="alert alert-info alert-dismissible fade show" role="alert" id="{{ $alerte->id }}">
                    <strong>Alerte!</strong></br>
                    {{ $alerte->conducteur_id }} :
                    {{ $alerte->message }}
                    <button type="button" class="btn-close" aria-label="Close" onclick="changeAlerte({{ $alerte->id }})"></button>
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

        @else
        <p>Il n'y a aucune alerte.</p>
        @endif
    </div>
</section>

<script>
    function changeAlerte(id) {
        var alerte = document.getElementById(id);
        alerte.classList.remove("alert-danger");
        alerte.classList.add("alert-dark");

        var button = alerte.getElementsByTagName("button")[0];
        button.remove();
    }
</script>

@endsection