@extends('layouts.app')

@section('Content')
<div class="w-full sm:w-3/6 mx-auto mb-4">
<a href="{{ route('index') }}" class="text-blue-600 hover:underline inline-block">Volver</a>
</div>
<ul>
<x-notes.note-container>
    <x-notes.note
    :note="$note->id"
    :title="$note->title"
    :description="$note->description"
    :created="$note->created_at"
    :image="$note->image"
    :username="$note->user->name ?? 'Usuario eliminado'"
    :user="$note->user"
    :comments="$note->comments"
    :category="$note->category"
    :group="$note->group"
    :likes="$note->likes"
    :liked="$hasLiked">
    </x-notes.note>
</x-notes.note-container>
</ul>

@endsection

