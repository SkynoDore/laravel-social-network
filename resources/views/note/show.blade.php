@extends('layouts.app')

@section('Content')
<a href=" {{ route('note.index')}}">Volver </a>
<h1>{{ $note->title}}</h1>
<p>{{ $note->description}}</p>
@endsection
