<!DOCTYPE html>
<html lang="fr">

{{-- Head --}}
<head>

    {{-- Informations --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Fontawesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    {{-- Titre --}}
    <title>Hippobel - @yield('titre')</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/global/reset.css') }}">
    @stack('styles')

</head>

{{-- Body --}}
<body>

    {{-- Contenu --}}
    @yield('content')

</body>

</html>