@extends('layouts.app')

@section('Content')
    <div class="flex flex-row justify-center items-center gap-4">
        <div class="flex flex-col justify-center items-center text-center m-8 gap-4">
            <h1>
                {{ $user->user_name }}
            </h1>
            <h2>
                {{ $user->name }}
            </h2>
        </div>
        <div class="flex flex-col justify-center items-center text-center m-8 gap-8">
            <x-profile-pic :user="$user" size="w-60 h-60 center" />
        </div>
    </div>

        @if ($user->id === Auth::id())
        <div class="flex flex-col justify-center items-center text-center">
            <a href="{{ route('note.create') }}"
                class="inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Crear nota
            </a>
            </div>
        @endif

    <ul>

        @forelse ($notes as $note)
            <x-notes.note-container>
                <x-notes.note :note="$note->id" :title="$note->title" :description="Str::words($note->description, 40)" :created="$note->created_at" :image="$note->image"
                    :username="$note->user->name" :user="$note->user" :comments="$note->comments" :category="$note->category" :group="$note->group" :likes="$note->likes"
                    :liked="in_array($note->id, $likedNoteIds ?? [])">
                </x-notes.note>
            </x-notes.note-container>
        @empty
            <p>No hay datos</p>
        @endforelse
    </ul>
@endsection
