@extends('layouts.app')

@section('Content')
<h1 class="text-2xl font-bold mb-4">{{ $group->name }}</h1>
<p class="mb-4 text-gray-700">{{ $group->description }}</p>

<h2 class="text-xl font-semibold mt-6 mb-2">Publicaciones en este grupo</h2>

@forelse ($notes as $note)
    <x-notes.note :note="$note->id"
        :title="$note->title"
        :description="Str::words($note->description, 40)"
        :created="$note->created_at"
        :image="$note->image"
        :username="$note->user->name ?? 'Usuario eliminado'"
        :user="$note->user"
        :comments="$note->comments" />
@empty
    <p>No hay publicaciones aún.</p>
@endforelse
@endsection
