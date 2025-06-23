@extends('layouts.app')

@section('Content')
    <a href="{{ route('note.profile') }}" class="text-blue-600 hover:underline mb-4 inline-block">Volver</a>

    <form method="POST" action="{{ route('note.store') }}" enctype="multipart/form-data"
        class="w-3/6 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
        @csrf
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Crear Nota</h2>
        <!-- Título -->
        <div>
            <label for="title" class="block text-gray-700 font-medium">Título:</label>
            <input type="text" name="title" id="title"
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Escribe el título..." required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Escribe la descripción..." required></textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
        <select name="category" id="category">
            @foreach (['General', 'Deporte', 'Cultura', 'Social'] as $cat)
                <option value="{{ $cat }}" @selected(old('category') == $cat)>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
         @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        <div>

        <!-- Imagen -->
        <div>
            <label for="image" class="block text-gray-700 font-medium">Subir Imagen:</label>
            <input type="file" name="image" id="image"
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md bg-gray-50 cursor-pointer focus:ring-2 focus:ring-blue-500 focus:outline-none"
                accept="image/*">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-400"> Peso maximo 2MB, formatos admitidos: jpeg, png, jpg, gif, svg</p>
        </div>
        <!-- Botón de envío -->
        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
                Crear
            </button>
        </div>
    </form>
@endsection
