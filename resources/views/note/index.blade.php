@extends('layouts.app')

@section('Content')
    <a href="{{ route('note.create') }}">Crear nota</a>
    <ul>
        @forelse ($notes as $note)
            <li>
                <a href="{{ route('note.show', $note->id) }}">{{ $note->title }}
                </a> |
                <a href=" {{ route('note.edit', $note->id) }}" class="btn btn-primary">EDITAR
                </a> |
                <form method="POST" action="{{route('note.destroy', $note->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Borrar">
                </form>
        @empty
            <p>No hay datos</p>
        @endforelse
    </ul>
@endsection
