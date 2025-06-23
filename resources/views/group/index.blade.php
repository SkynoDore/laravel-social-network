@extends('layouts.app')

@section('Content')
<h1 class="text-2xl font-bold mb-4">Grupos</h1>
<form method="GET" action="{{ route('group.index') }}" class="mb-6 flex justify-center">
    <input type="text" name="search" placeholder="Buscar parque..."
        value="{{ request('search') }}"
        class="w-1/2 px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">
        Buscar
    </button>
</form>

<ul class="space-y-2">
    @foreach ($groups as $group)
        <li>
            <a href="{{ route('group.show', $group) }}" class="text-blue-600 hover:underline">
                {{ $group->title }} ({{ $group->notes_count }} publicaciones)
            </a>
        </li>
    @endforeach
</ul>

@endsection
