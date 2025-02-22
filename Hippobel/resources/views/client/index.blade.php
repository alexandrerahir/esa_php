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

        {{-- Clients --}}
        <div class="contenu">

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Liste des Clients</h1>

                {{-- Actions --}}
                <div class="contenu-actions">
                    {{-- Ajouter un client --}}
                    <form action="{{ route('clients.ajouter')}}" method="GET">
                        @csrf
                        <button type="submit">Nouveau client</button>
                    </form>     
                </div>
            </div>

            {{-- Tableau des clients --}}
            <table class="liste clients-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->nom_client }}</td>
                            <td>{{ $client->email_client }}</td>
                            <td>{{ $client->telephone_client }}</td>
                            <td>
                                {{-- Modifier --}}
                                <a href="{{ route('clients.modifier', $client->id_client) }}" class="btn-modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                
                                {{-- Supprimer --}}
                                <form action="{{ route('clients.supprimer', $client->id_client) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-supprimer"><i class="fa-solid fa-trash"></i></button>
                                </form>   
                            </td>
                        </tr>
                    @endforeach
                </tbody>

        </div>
    </main>