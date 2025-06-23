@extends('layouts.app')

@section('Content')
<h1 class="text-2xl font-bold mb-4">Grupos disponibles</h1>

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
