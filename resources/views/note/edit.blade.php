@extends('layouts.app')

@section('Content')
    <!-- Botón de vuelta -->
    <div class="space-x-2 flex gap-x-4 w-full sm:w-3/6 mx-auto mb-4">
        <a href="{{ route('index') }}" class="text-blue-600 hover:underline inline-block"><x-heroicon-o-arrow-uturn-left class="h-5 w-5 inline-block" />Volver</a>
        <form method="POST" action="{{ route('note.destroy', $note) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline"
                onclick="return confirm('¿Estás seguro de eliminar esta nota?')">Borrar nota</button>
        </form>
    </div>
    <!-- Formulario para editar la nota -->
    <form method="POST" action="{{ route('note.update', $note->id) }}" enctype="multipart/form-data"
        class="w-full sm:w-3/6 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
        @method('put') <!-- Establece el método HTTP como PUT para actualizar -->
        @csrf <!-- Token CSRF para la seguridad -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Editar Nota</h2>
        <!-- Título -->
        <div>
            <label for="title" class="block text-gray-700 font-medium">Título:</label>
            <input type="text" name="title" id="title" value="{{ $note->title }}"
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Escribe el título..." required>
            @error('title')
                <!-- Muestra errores si los hay -->
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Escribe la descripción..." required>{{ $note->description }}</textarea>
            @error('description')
                <!-- Muestra errores si los hay -->
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Categoría -->
        <select name="category" id="category" class="...">
            @foreach (['General', 'Deporte', 'Cultura', 'Social'] as $cat)
                <option value="{{ $cat }}" @selected(old('category', $note->category ?? '') == $cat)>
                    {{ $cat }}
                </option>
            @endforeach
        </select>

        <!-- Imagen -->
        @if (!empty($note->image))
            <!-- Verifica que la imagen no esté vacía ni nula -->
            <div class="w-full h-full">
                <img src="{{ asset('storage/' . $note->image) }}" alt="Imagen principal"
                    class="w-full object-cover rounded-t-lg">
            </div>
        @endif
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="delete_image" class="form-checkbox text-red-600">
                <span class="ml-2 text-sm text-gray-700">Eliminar imagen actual</span>
            </label>
        </div>
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
                Actualizar
            </button>
        </div>
    </form>
@endsection
