@extends('layouts.app')

{{-- Titre de la page --}}
@section('titre', 'Liste des Chevaux')

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

        {{-- Liste des chevaux --}}
        <div class="contenu">

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Liste des Chevaux</h1>

                {{-- Actions --}}
                <div class="contenu-actions">
                    {{-- Ajouter un cheval --}}
                    <form action="{{ route('chevaux.ajouter')}}" method="GET">
                        @csrf
                        <button type="submit">Nouveau cheval</button>
                    </form>
                </div>
            </div>

            {{-- Tableau des chevaux --}}
            <table class="liste chevaux-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date de naissance</th>
                        <th>Heure maximum</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chevaux as $cheval)
                        <tr>
                            <td>{{ $cheval->nom_cheval }}</td>
                            <td>{{ \Carbon\Carbon::parse($cheval->naissance_cheval)->format('d/m/Y') }}</td>
                            <td>{{ $cheval->heure_max_cheval }}</td>
                            <td>
                                {{-- Modifier --}}
                                <a href="{{ route('chevaux.modifier', $cheval->id_cheval) }}" class="btn-modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                
                                {{-- Supprimer --}}
                                <form action="{{ route('chevaux.supprimer', $cheval->id_cheval) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-supprimer"><i class="fa-solid fa-trash"></i></button>
                                </form>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection