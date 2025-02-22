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
                <h1>Modifier le cheval</h1>
            </div>
        
            <form method="POST" action="">
                @csrf
                {{-- Nom --}}
                <label for="nom_cheval">Nom :</label>
                <input type="text" id="nom_cheval" name="nom_cheval" value="{{ $cheval->nom_cheval }}" required>
        
                {{-- Date de naissance --}}
                <label for="naissance_cheval">Date de naissance :</label>
                <input type="date" id="naissance_cheval" name="naissance_cheval" value="{{ $cheval->naissance_cheval }}" required>
        
                {{-- Heure maximum --}}
                <label for="heure_max_cheval">Heure maximum :</label>
                <input type="number" id="heure_max_cheval" name="heure_max_cheval" value="{{ $cheval->heure_max_cheval }}" required>
                
                {{-- Bouton --}}
                <div class="formulaire-actions">
                    <button type="submit">Sauvegarder</button>
                    <button type="button" onclick="window.history.back()">Retour</button>
                </div>
            </form>
        </div>

    </main>

@endsection