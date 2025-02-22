@extends('layouts.app')

{{-- Titre de la page --}}
@section('titre', 'Dashboard')

{{-- Importation styles --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layouts/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/utilisateur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/formulaire.css') }}">
@endpush

{{-- Contenu --}}
@section('content')

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main --}}
    <main>
        {{-- Information utilisateur --}}
        <div class="utilisateur">
            <h1>Salut Alexandre !</h1>
            <p>Ravi de te revoir sur le dashboard de Hippobel.</p>
        </div>

        {{-- Contenu --}}
        <div class="contenu">
            <div class="contenu-header">
                <h1>Consulter la Séance</h1>
            </div>

            <p><strong>Client :</strong> {{ $seance->client->nom_client }} {{ $seance->client->prenom_client }}</p>
            <p><strong>Type de Séance :</strong> {{ $seance->typeSeance->nom_type_seance }}</p>
            <p><strong>Nombre de Chevaux :</strong> {{ $seance->nb_chevaux }}</p>
            <p><strong>Date de Début :</strong> {{ Carbon\Carbon::parse($seance->debut_seance)->format('d-m-Y H:i') }}</p>
            <p><strong>Date de Fin :</strong> {{ Carbon\Carbon::parse($seance->fin_seance)->format('d-m-Y H:i') }}</p>
            <p><strong>Moniteur :</strong> {{ $seance->moniteur->nom_moniteur }} {{ $seance->moniteur->prenom_moniteur }}</p>
            <p><strong>Secrétaire :</strong> {{ $seance->secretaire->nom_secretaire }} {{ $seance->secretaire->prenom_secretaire }}</p>

            <h2>Chevaux associés</h2>
            <ul>
                @foreach($seance->chevaux as $cheval)
                    <li>{{ $cheval->nom_cheval }}</li>
                    <!-- Ajoutez d'autres informations sur le cheval si nécessaire -->
                @endforeach
            </ul>

            <a href="{{ route('seances.index', ['date' => Carbon\Carbon::parse($seance->debut_seance)->format('Y-m-d')]) }}">Retour à la liste</a>        </div>
    </main>
@endsection