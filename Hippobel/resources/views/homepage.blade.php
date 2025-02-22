@extends('layouts.app')

{{-- Titre de la page --}}
@section('titre', 'Dashboard')

{{-- Importation styles --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layouts/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/utilisateur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/liste.css') }}">
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
        <div class="contenu homepage">
            <div class="card-statistique">
                <h2>Les séances prévues aujourd'hui</h2>
                <p>{{ $nombreSeancesAujourdhui }}</p>
            </div>

            <div class="card-statistique">
                <h2>Les séances prévues demain</h2>
                <p>{{ $nombreSeancesDemain }}</p>
            </div>

            <div class="card-statistique">
                <h2>Toutes les séances réalisées</h2>
                <p>{{ $nombreSeancesRealise }}</p>
            </div>
        </div>

    </main>

@endsection