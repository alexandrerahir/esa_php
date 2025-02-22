<header>
    {{-- Navigation --}}
    <nav>
        <h1>Hippobel.</h1>
        <li><a href="{{ url('/') }}"><i class="fa-solid fa-chart-pie"></i>Statistiques</a></li>
        <li><a href="{{ url('/seances') }}"><i class="fa-solid fa-calendar"></i>Gestion des séances</a></li>
        <li><a href="{{ url('/chevaux') }}"><i class="fa-solid fa-horse"></i>Gestion des chevaux</a></li>
        <li><a href="{{ url('/clients') }}"><i class="fa-solid fa-user-tie"></i>Gestion des clients</a></li>
        <li><a href="{{ url('/factures') }}"><i class="fa-solid fa-wallet"></i>Gestion des factures</a></li>
    </nav>

    {{-- Déconnexion --}}
    <form id="logout-form" action="{{ route('auth.deconnexion') }}" method="POST">
        @csrf
        <button type="submit"><i class="fa-solid fa-sign-out-alt"></i> Déconnexion</button>
    </form>

</header>