@extends('layouts.app')

@section('Content')
<h1>Hola mundo </h1>

<ul>
    @forelse ($notes as $note)
        <div class="mx-auto grid grid-cols-1 border-gray-200 sm:mt-2 sm:pt-2 lg:mx-0 lg:max-w-none">
            <x-note
                title="{{ $note->title }}"
                description="{{ Str::words($note->description, 40)}}"
                created="{{$note->created_at}}"
                image="{{ $note->image}}">
            </x-note>
        </div>
    @empty
        <p>No hay datos</p>
    @endforelse
</ul>

@endsection
