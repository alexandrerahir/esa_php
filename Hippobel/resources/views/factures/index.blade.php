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
        <div class="utilisateur">
            <h1>Salut Alexandre !</h1>
            <p>Ravi de te revoir sur le dashboard de Hippobel.</p>
        </div>

        {{-- Liste factures --}}
        <div class="contenu">

            {{-- Header --}}
            <div class="contenu-header">
                <h1>Liste des factures</h1>

                {{-- Actions --}}
                <div class="contenu-actions">
                    <form method="GET" action="{{ route('factures.index') }}">
                        <input type="month" id="monthYear" name="monthYear" value="{{ $monthYear }}">
                        <button type="submit">Rechercher</button>
                    </form>
                </div>
            </div>

            {{-- Tableau des factures --}}
            <table class="liste facture-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Heure préstée</th>
                        <th>Nombre chevaux utilisée</th>
                        <th>Montant facture</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientsData as $data)
                        <tr>
                            <td>{{ $data['client']->nom_client }} {{ $data['client']->prenom_client }}</td>
                            <td>{{ $data['totalHours'] }}</td>
                            <td>{{ $data['totalChevaux'] }}</td>
                            <td>{{ $data['totalAmount'] }}€</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{ $totalMonthHours }}</th>
                        <th>{{ $totalMonthChevaux }}</th>
                        <th>{{ $totalMonthAmount }}€</th>
                    </tr>
                </tfoot>
            </table>
        </div>


    </main>
@endsection