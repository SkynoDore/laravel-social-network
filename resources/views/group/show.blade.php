@extends('layouts.app')

@section('Content')
    <h1 class="text-2xl font-bold mb-4">{{ $group->title }}</h1>
    <p class="mb-4 text-gray-700 text-center">{{ $group->street_address }}, {{ $group->locality }}, {{ $group->country }}</p>
    <div class="flex flex-col justify-center items-center text-center m-8 gap-8">
        <a href="https://www.google.com/maps/search/?api=1&query={{ $group->latitude }},{{ $group->longitude }}"
            target="_blank" class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Ver en Google Maps
        </a>
        <a href="{{ route('note.create', ['group' => $group->id]) }}"
            class="inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Crear nota
        </a>
        <h2 class="text-xl font-bold mt-6 mb-2">Publicaciones en este grupo</h2>
    </div>
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
                :category="$note->category"
                :group="$note->group"
                :likes="$note->likes"
                :liked="in_array($note->id, $likedNoteIds ?? [])" />
            </x-notes.note-container>
        @empty
            <p>No hay datos</p>
        @endforelse
    </ul>
@endsection
