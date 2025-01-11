@extends('layouts.guest-app')

@section('Content')
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
