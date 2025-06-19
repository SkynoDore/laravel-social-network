@extends('layouts.app')
@section('title', 'Toca Cesped')
@section('description', 'Red social de amantes de la activididad fisica y el aire libre.')
@section('keywords', 'Social, deporte, actividad fisica, aire libre, comunidad, notas, comentarios')
@section('Content')
<h1>Toca Cesped!</h1>

<ul>
    @forelse ($notes as $note)
    <x-notes.note-container>
        <x-notes.note
                :note="$note->id"
                :title="$note->title"
                :description="Str::words($note->description, 40)"
                :created="$note->created_at"
                :image="$note->image"
                :username="$note->user->name ?? 'Usuario eliminado'"
                :user="$note->user"
                :comments="$note->comments"
            />
    </x-notes.note-container>
    @empty
        <p>No hay datos</p>
    @endforelse
</ul>

@endsection
