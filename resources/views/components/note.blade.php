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
    @if ($image !== '')
    <div class="w-full h-full">

        <img src="{{ asset('storage/' . $image) }}" alt="Imagen principal" class="w-full object-cover rounded-t-lg">
    </div>
    @endif
    <!-- Meta info -->
    <div class="flex items-center gap-x-4 text-xs px-6 py-3">
        <time class="text-gray-500">{{ $created }}</time>
        <a href="#" class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200">Marketing</a>
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
        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Autor" class="w-12 h-12 rounded-full object-cover">
        <div class="text-sm">
            <p class="font-semibold text-gray-900">
                <a href="#">
                    <span></span>
                    Michael Foster
                </a>
            </p>
            <p class="text-gray-600">Co-Founder / CTO</p>
        </div>
    </div>

    <!-- Comentarios -->
    <div class="px-6 py-4">
        <p class="text-gray-500">No hay comentarios todavía.</p>
    </div>
</article>
