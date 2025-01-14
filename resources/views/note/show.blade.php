@extends('layouts.app')

@section('Content')
<x-notes.note-container>
    <x-notes.note
        title="{{ $note->title }}"
        description="{{ $note->description}}"
        created="{{$note->created_at}}"
        image="{{ $note->image}}">
    </x-notes.note>
</x-notes.note-container>
@endsection

