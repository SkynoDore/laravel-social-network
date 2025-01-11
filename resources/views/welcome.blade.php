@extends('layouts.app')

@section('Content')
<h1>Hola mundo </h1>

<ul>
    @forelse ($notes as $note)
        <li>
            <a href="{{ route('note.show', $note->id) }}">{{ $note->title }}
            </a>
        </li>
    @empty
        <p>No hay datos</p>
    @endforelse
</ul>
@endsection
