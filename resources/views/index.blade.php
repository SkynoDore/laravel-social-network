@extends('layouts.app')
@section('title', 'Bienvenido a Mi Blog')
@section('description', 'Este es un blog de ejemplo creado con Laravel.')
@section('keywords', 'blog, Laravel, ejemplo, tutorial')
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
