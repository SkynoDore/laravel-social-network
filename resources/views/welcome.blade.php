@extends('layouts.app')

@section('Content')
<h1>Hola mundo </h1>

<ul>
    @forelse ($notes as $note)
    <x-notes.note-container>
        <x-notes.note
                :title="$note->title"
                :description="Str::words($note->description, 40)"
                :created="$note->created_at"
                :image="$note->image"
                :usuario="$note->user->name"
                :profileIMG="$note->user"
            />
    </x-notes.note-container>
    @empty
        <p>No hay datos</p>
    @endforelse
</ul>

@endsection
