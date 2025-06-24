@extends('layouts.app')
@section('title', 'Toca Cesped')
@section('description', 'Red social de amantes de la activididad fisica y el aire libre.')
@section('keywords', 'Social, deporte, actividad fisica, aire libre, comunidad, notas, comentarios')
@section('Content')
    @auth
        <div class="flex flex-col justify-center items-center text-center pb-3">
            <a href="{{ route('note.create') }}"
                class="inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Crear nota
            </a>
        </div>
    @endauth
    <ul>
        @forelse ($notes as $note)
            <x-notes.note-container>
                <x-notes.note :note="$note->id" :title="$note->title" :description="Str::words($note->description, 40)" :created="$note->created_at" :image="$note->image"
                    :username="$note->user->name ?? 'Usuario eliminado'" :user="$note->user" :comments="$note->comments" :category="$note->category" :group="$note->group"
                    :likes="$note->likes" :liked="in_array($note->id, $likedNoteIds ?? [])" />
            </x-notes.note-container>
        @empty
            <p>No hay publicaciones</p>
        @endforelse
    </ul>

@endsection
