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
<h1>Voici les alertes!</h1>
@if (count($alertes))
<ul>
    @foreach ($alertes as $alerte)
    <li>id: $alerte->id</li>
    <li>date: $alerte->date</li>
    <li>état du compte: $alerte->active</li>
    <li>message: $alerte->message</li>
    <li>redirigé à: $alerte->idEmployeur</li>
    @endforeach
</ul>
@else
<p>Il n'y a aucune alerte.</p>
@endif
@endsection