<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mi Aplicación')</title>
    <meta name="description" content="@yield('description', 'Descripción predeterminada de mi aplicación')">
    <meta name="keywords" content="@yield('keywords', 'blog, Laravel, aplicación')">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Mostrar navegación según el estado de autenticación -->
    @auth
        @include('layouts.navigation') {{-- Navegación para usuarios autenticados --}}
    @else
        @include('layouts.guest-navigation') {{-- Navegación para invitados --}}
    @endauth

    <div class="container w-7xl mx-auto p-3 pt-6 ">

        @yield('Content')
    </div>
</body>

</html>
