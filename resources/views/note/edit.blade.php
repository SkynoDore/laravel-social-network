@extends('layouts.app')

@section('Content')
<a href=" {{ route('note.index')}}">Volver </a>
<form method="POST" action=" {{route('note.update', $note->id)}}">
    @method('put')
    @csrf
    <label>titulo:</label>
    <input type="text" name="title" value=" {{ $note->title }}">

    <label> Descripción:</label>
    <input type="text" name="description" value="{{ $note->description }}">
    <input type="submit" value="Actualizar">
</form>


@endsection
