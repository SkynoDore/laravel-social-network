@extends('layouts.app')

@section('Content')
<a href="{{ route('note.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">Volver</a>
<ul>
<x-notes.note-container>
    <x-notes.note
    :title="$note->title"
    :description="$note->description"
    :created="$note->created_at"
    :image="$note->image"
    :username="$note->user->name"
    :user="$note->user">
    </x-notes.note>
</x-notes.note-container>
</ul>
@endsection

