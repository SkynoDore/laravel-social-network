@extends('layouts.app')
@section('Content')
<div class="flex justify-center items-center flex-col gap-4">
<h1>Error 500 - Problema interno del servidor. Por favor, inténtelo más tarde o vaya a la página de inicio.
</h1>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded">
        <a href="{{ route('index') }}">Volver al inicio</a>
    </button>
</div>
    @endsection
