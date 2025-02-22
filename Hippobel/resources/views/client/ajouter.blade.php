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

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Ajouter un client</h1>
            </div>

            <form action="" method="POST">
                @csrf
                {{-- Nom --}}
                <label for="nom_client">Nom :</label>
                <input type="text" id="nom_client" name="nom_client" required>

                {{-- Email --}}
                <label for="email_client">Email :</label>
                <input type="email" id="email_client" name="email_client" required>

                {{-- Téléphone --}}
                <label for="telephone_client">Téléphone :</label>
                <input type="tel" id="telephone_client" name="telephone_client" required>

                {{-- Bouton --}}
                <div class="formulaire-actions">
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="window.history.back()">Retour</button>
                </div>

                
            </form>
        </div>
    </main>

@endsection