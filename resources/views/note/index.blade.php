@extends('layouts.app')

@section('Content')
    <h1>
        Mis publicaciones
    </h1>

    <div class="flex flex-col justify-center items-center text-center m-8 gap-8">
        <x-profile-pic :user="Auth::user()" size="w-60 h-60 center" />

        <a href="{{ route('note.create') }}"
            class="inline-block px-6 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Crear nota
        </a>
    </div>


    <ul>
        @forelse ($notes as $note)
            <x-notes.note-container>
                <x-notes.note
                :title="$note->title"
                :description="Str::words($note->description, 40)"
                :created="$note->created_at"
                :image="$note->image"
                :usuario="$note->user->name"
                :profileIMG="$note->user">
                    <!-- Botones pasados como slot -->
                    <a href="{{ route('note.show', $note->id) }}" class="text-blue-500 hover:underline">Ver</a> |
                    <a href="{{ route('note.edit', $note->id) }}" class="text-yellow-500 hover:underline">Editar</a> |
                    <form method="POST" action="{{ route('note.destroy', $note->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"
                            onclick="return confirm('¿Estás seguro de eliminar esta nota?')">Borrar</button>
                    </form>
                </x-notes.note>
            </x-notes.note-container>
        @empty
            <p>No hay datos</p>
        @endforelse
    </ul>
@endsection
