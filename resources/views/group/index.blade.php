@extends('layouts.app')

@section('Content')
    <h1 class="text-2xl font-bold mb-4">Parques</h1>
    <form method="GET" action="{{ route('group.index') }}" class="mb-6 flex justify-center">
        <input type="text" name="search" placeholder="Buscar parque..." value="{{ request('search') }}"
            class="w-1/2 px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">
            Buscar
        </button>
    </form>
    <div class="flex justify-center mb-4 space-x-2">
        <a href="{{ route('group.index', array_merge(request()->query(), ['sort' => 'popular'])) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Ver más populares
        </a>

        <a href="{{ route('group.index', array_merge(request()->except('sort'), ['sort' => 'distance'])) }}"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Ver por cercanía
        </a>
    </div>

    <ul class="space-y-2">
        @foreach ($groups as $group)
            <li>
                <a href="{{ route('group.show', $group) }}" class="text-blue-600 hover:underline">
                    {{ $group->title }}
                </a>
                <p>
                    ({{ $group->notes_count }} publicaciones)
                    @if (isset($group->distance))
                        - {{ number_format($group->distance, 2) }} km
                    @endif
                </p>
            </li>
        @endforeach
    </ul>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const url = new URL(window.location.href);
                url.searchParams.set('lat', lat);
                url.searchParams.set('lng', lng);
                if (!window.location.search.includes('lat')) {
                    window.location.href = url.toString();
                }
            });
        }
    </script>
@endsection
