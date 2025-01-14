<!--x-note
title
description
created
$image
-->
<!-- x-note -->
<?php
use Illuminate\Support\Str;
?>

<article class="w-3/6 mx-auto flex flex-col items-start justify-between bg-white shadow-md rounded-lg overflow-hidden">
    <!-- Imagen superior -->
    @if (!empty($image)) <!-- Verifica que la imagen no esté vacía ni nula -->
    <div class="w-full h-full">
        <img src="{{ asset('storage/' . $image) }}" alt="Imagen principal" class="w-full object-cover rounded-t-lg">
    </div>
@endif

    <!-- Meta info -->
    <div class="flex items-center gap-x-4 text-xs px-6 py-3">
        <time class="text-gray-500">{{ $created ?? 'no hay datos' }}</time>
        <a href="#" class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200">
            {{ $categoria ?? 'General' }}</a>

        @if (request()->is('my-feed'))
            <div class="px-6 py-3 bg-green-100 text-green-800 rounded-lg shadow-md">
                {{ $slot }}
            </div>
        @endif
    </div>

    <!-- Título y descripción -->
    <div class="px-6">
        <h3 class="mt-3 text-2xl font-semibold text-gray-900 hover:text-gray-600">
            <a href="#">
                <span></span>
                {{ $title }}
            </a>
        </h3>
        <p class="mt-4 text-sm text-gray-700">
            {{ $description }}
        </p>
    </div>

    <!-- Autor -->
    <div class="relative mt-6 flex items-center gap-x-4 px-6 pb-6">
        <!-- En tu componente x-note -->
        <x-profile-pic :user="$profileIMG" size="w-12 h-12" />
    <!-- Pasamos el usuario -->
        <div class="text-sm">
            <p class="font-semibold text-gray-900">
                <a href="#">
                    <span></span>
                    {{ $usuario ?? 'Usuario Desconocido' }} <!-- Usamos el nombre del usuario -->
                </a>
            </p>
            <p class="text-gray-600">{{ $CategoriaUsuarios ?? ' Nuevo ' }}</p>
        </div>
    </div>

    <!-- Comentarios -->
    <div class="px-6 py-4">
        <p class="text-gray-500">No hay comentarios todavía.</p>
    </div>
</article>
