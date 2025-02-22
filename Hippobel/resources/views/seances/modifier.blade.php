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

        {{-- Modifier une séance --}}
        <div class="contenu">
            <div class="contenu-header">
                <h1>Modifier la Séance</h1>
            </div>
        
            <form method="POST" action="">
                @csrf
                {{-- Type de séance --}}
                <label for="type_seance">Type de séance :</label>
                <select id="type_seance" name="type_seance">
                    <option value="" disabled>Sélectionner un type de séance</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id_type_seance }}" {{ $seance->id_type_seance == $type->id_type_seance ? 'selected' : '' }}>{{ $type->nom_type_seance }}</option>
                    @endforeach
                </select>
        
                {{-- Nombre de chevaux --}}
                <label for="nb_chevaux">Nombre de chevaux :</label>
                <input type="number" id="nb_chevaux" name="nb_chevaux" value="{{ $seance->nb_chevaux }}">
        
                {{-- Date et heure début --}}
                <label for="date_debut">Date de début :</label>
                <input type="datetime-local" id="debut_seance" name="debut_seance" value="{{ Carbon\Carbon::parse($seance->debut_seance)->format('Y-m-d\TH:i') }}">
        
                {{-- Date et heure fin --}}
                <label for="date_fin">Date de fin :</label>
                <input type="datetime-local" id="fin_seance" name="fin_seance" value="{{ Carbon\Carbon::parse($seance->fin_seance)->format('Y-m-d\TH:i') }}">
        
                {{-- Moniteur --}}
                <label for="moniteur">Moniteur :</label>
                <select id="moniteur" name="moniteur">
                    <option value="" disabled>Sélectionner un moniteur</option>
                    @foreach($moniteurs as $moniteur)
                        <option value="{{ $moniteur->id_moniteur }}" {{ $seance->id_moniteur == $moniteur->id_moniteur ? 'selected' : '' }}>{{ $moniteur->nom_moniteur }} {{ $moniteur->prenom_moniteur }}</option>
                    @endforeach
                </select>

                {{-- Chevaux --}}
                <label for="chevaux">Chevaux :</label>
                @for ($i = 0; $i < $seance->nb_chevaux; $i++)
                    <select id="chevaux_{{ $i }}" name="chevaux[]">
                        <option value="" disabled {{ !isset($seance->chevaux[$i]) ? 'selected' : '' }}>Sélectionner un cheval</option>
                        @foreach($chevauxDisponibles as $cheval)
                            <option value="{{ $cheval->id_cheval }}" {{ isset($seance->chevaux[$i]) && $seance->chevaux[$i]->id_cheval == $cheval->id_cheval ? 'selected' : '' }}>{{ $cheval->nom_cheval }}</option>
                        @endforeach
                    </select>
                @endfor
        
                {{-- Bouton --}}
                <div class="formulaire-actions">
                    <button type="submit">Sauvegarder</button>
                    <button type="button" onclick="window.history.back()">Retour</button>
                </div>
            </form>
        </div>

    </main>

@endsection