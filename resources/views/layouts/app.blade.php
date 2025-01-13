<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prueba</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Mostrar navegación según el estado de autenticación -->
    @auth
        @include('layouts.navigation') {{-- Navegación para usuarios autenticados --}}
    @else
        @include('layouts.guest-navigation') {{-- Navegación para invitados --}}
    @endauth

    @isset($header)
        <header>
                {{ $header }}
        </header>
    @endisset
    <div class="container w-7xl mx-auto p-3 pt-6 ">
        @yield('Content')
    </div>
</body>

</html>
