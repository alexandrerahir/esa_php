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

        {{-- Séances --}}
        <div class="contenu">
            @php
                $currentDateTime = Carbon\Carbon::now()->format('Y-m-d\TH:i');
            @endphp

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Ajouter une séance</h1>
            </div>

            {{-- Formulaire --}}
            <form action="{{ route('seances.ajouter') }}" method="POST">
                @csrf
                {{-- Client --}}
                <label for="client">Client :</label>
                <select id="client" name="client">
                    <option value="" disabled selected>Sélectionner un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id_client }}">{{ $client->nom_client }} {{ $client->prenom_client }}</option>
                    @endforeach
                </select>

                {{-- Type séance --}}
                <label for="type_seance">Type de séance :</label>
                <select id="type_seance" name="type_seance">
                    <option value="" disabled selected>Sélectionner un type de séance</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id_type_seance }}">{{ $type->nom_type_seance }}</option>
                    @endforeach
                </select>

                {{-- Nombre de chevaux --}}
                <label for="nb_chevaux">Nombre de chevaux :</label>
                <input type="number" id="nb_chevaux" name="nb_chevaux">

                {{-- Date et heure début --}}
                <label for="date_debut">Date de début :</label>
                <input type="datetime-local" id="debut_seance" name="debut_seance" value="{{ $currentDateTime }}">

                {{-- Date et heure fin --}}
                <label for="date_fin">Date de fin :</label>
                <input type="datetime-local" id="fin_seance" name="fin_seance" value="{{ $currentDateTime }}">

                {{-- Moniteur --}}
                <label for="moniteur">Moniteur :</label>
                <select id="moniteur" name="moniteur">
                    <option value="" disabled selected>Sélectionner un moniteur</option>
                    @foreach($moniteurs as $moniteur)
                        <option value="{{ $moniteur->id_moniteur }}">{{ $moniteur->nom_moniteur }} {{ $moniteur->prenom_moniteur }}</option>
                    @endforeach
                </select>

                {{-- Bouton --}}
                <div class="formulaire-actions">
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="window.history.back()">Retour</button>
                </div>
            </form>
        </div>
    </main>

@endsection