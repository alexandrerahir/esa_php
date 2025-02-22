@extends('layouts.app')

{{-- Titre de la page --}}
@section('titre', 'Connexion')

{{-- Importation styles --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/views/auth/connexion.css') }}">
@endpush

{{-- Contenu --}}
@section('content')

<main> 
    {{-- Connexion --}}
    <div class="connexion">
        <form action="{{ route('auth.connexion') }}" method="post">
            @csrf

            <h1>Connexion</h1>
            
            <label for="email_secretaire">Adresse email :</label>
            <input type="text" name="email_secretaire" id="email_secretaire" placeholder="Email" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            
            @error('email')
                <p>{{ $message }}</p>
            
                @enderror
            <button type="submit">Connexion</button>
        </form>
    </div>

    {{-- Informations --}}
    <div class="informations">
        <h1>Hippobel.</h1>
        <p>Optimisez votre centre d’hippothérapie avec une gestion fluide des séances et des chevaux.</p>
    </div>
</main>

@endsection