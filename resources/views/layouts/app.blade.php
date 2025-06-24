<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toca Cesped')</title>
    <meta name="description" content="@yield('description', 'Red social de amantes de la actividad física y el aire libre.')">
    <meta name="keywords" content="@yield('keywords', 'Social, deporte, actividad fisica, aire libre, comunidad, notas, comentarios')">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta property="og:title" content="@yield('title', 'Toca Cesped')">
    <meta property="og:description" content="@yield('description', 'Red social de amantes de la actividad física y el aire libre.')">
    <meta property="og:image" content="{{ asset('og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">

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
<script>
    function toggleLike(noteId) {
        fetch(`/notes/${noteId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al dar/quitar like');
                return response.json();
            })
            .then(data => {
                const countEl = document.getElementById(`like-count-${noteId}`);
                const btnEl = document.getElementById(`like-btn-${noteId}`);

                countEl.textContent = data.likes;

                btnEl.classList.remove('text-red-600', 'text-gray-400');
                if (data.hasLiked) {
                    btnEl.classList.add('text-red-600');
                } else {
                    btnEl.classList.add('text-gray-400');
                }
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>

</html>
