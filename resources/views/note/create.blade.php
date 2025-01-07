@extends('layouts.app')

@section('Content')
<a href=" {{ route('note.index')}}">Volver </a>
<form method="POST" action="{{ route('note.store') }}">
    @csrf
    <label>titulo:</label>
    <input type="text" name="title">

    <label> Descripción:</label>
    <input type="text" name="description">
    <input type="submit" value="Crear">
</form>
@endsection
