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
        <div class="contenu">

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Liste des Séances</h1>
        
                {{-- Actions --}}
                <div class="contenu-actions">
                    {{-- Rechercher des séances --}}
                    <form method="GET" action="{{ route('seances.index') }}">
                        @csrf
                        <input type="date" id="date" name="date" value="{{ $date }}">
                        <button type="submit">Rechercher</button>
                    </form>
        
                    {{-- Ajouter une séance --}}
                    <form action="{{ route('seances.ajouter') }}" method="GET">
                        @csrf
                        <button type="submit">Nouvelle séance</button>
                    </form>
                </div>
            </div>
        
            {{-- Tableau des séances --}}
            <table class="liste seances-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Heure</th>
                        <th>Durée</th>
                        <th>Moniteur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seances as $seance)
                        <tr>
                            <td>{{ $seance->client->nom_client}}</td>
                            <td>{{ Carbon\Carbon::parse($seance->debut_seance)->format('H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($seance->debut_seance)->diff(Carbon\Carbon::parse($seance->fin_seance))->format('%H:%I') }}</td>
                            <td>{{ $seance->moniteur->nom_moniteur}} {{ $seance->moniteur->prenom_moniteur}}</td>
                            <td>
                                {{-- Consulter --}}
                                <a href="{{ route('seances.consulter', $seance->id_seance) }}" class="btn-consulter"><i class="fa-solid fa-eye"></i></a>
                                @if (Carbon\Carbon::parse($seance->debut_seance)->isFuture())
                                
                                {{-- Modifier --}}
                                <a href="{{ route('seances.modifier', $seance->id_seance) }}" class="btn-modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                
                                {{-- Supprimer --}}
                                <form action="{{ route('seances.supprimer', $seance->id_seance) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-supprimer"><i class="fa-solid fa-trash"></i></button>
                                </form>                        
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>

@endsection