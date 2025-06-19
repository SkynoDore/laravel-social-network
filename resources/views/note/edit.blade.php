@extends('layouts.app')

@section('Content')
<!-- Botón de vuelta -->
<a href="{{ route('index') }}" class="text-blue-600 hover:underline mb-4 inline-block">Volver</a>

<!-- Formulario para editar la nota -->
<form method="POST" action="{{ route('note.update', $note->id) }}" class="w-3/6 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
    @method('put') <!-- Establece el método HTTP como PUT para actualizar -->
    @csrf <!-- Token CSRF para la seguridad -->

    <!-- Título -->
    <div>
        <label for="title" class="block text-gray-700 font-medium">Título:</label>
        <input type="text" name="title" id="title" value="{{ $note->title }}"
               class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
               placeholder="Escribe el título..." required>
        @error('title') <!-- Muestra errores si los hay -->
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Descripción -->
    <div>
        <label for="description" class="block text-gray-700 font-medium">Descripción:</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                  placeholder="Escribe la descripción..." required>{{ $note->description }}</textarea>
        @error('description') <!-- Muestra errores si los hay -->
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Botón de envío -->
    <div>
        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
            Actualizar Nota
        </button>
    </div>
</form>

@endsection
