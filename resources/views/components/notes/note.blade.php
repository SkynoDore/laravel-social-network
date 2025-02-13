<!--x-note
title
description
created
image
username
user
-->
<!-- x-note -->
<?php
use Illuminate\Support\Str;
?>
<li>
    <article
        class="w-3/6 mx-auto flex flex-col items-start justify-between bg-white shadow-md rounded-lg">
        <!-- Imagen superior -->
        @if (!empty($image))
            <!-- Verifica que la imagen no esté vacía ni nula -->
            <div class="w-full h-full">
                <img src="{{ asset('storage/' . $image) }}" alt="Imagen principal" class="w-full object-cover rounded-t-lg">
            </div>
        @endif

        <!-- Meta info -->
        <div class="flex items-center gap-x-4 text-xs px-6 py-3">
            <time class="text-gray-500">{{ $created ?? 'no hay datos' }}</time>
            <a href="#"
                class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200">
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
            <!-- compoente imagen de perfil -->
            <x-profile-pic :user="$user" size="w-12 h-12" />
            <!-- Pasamos el usuario -->
            <div class="text-sm">
                <p class="font-semibold text-gray-900">
                    <a href="#">
                        <span></span>
                        <!-- variable nombre de usuario-->
                        {{ $username ?? 'Usuario Desconocido' }} <!-- Usamos el nombre del usuario -->
                    </a>
                </p>
                <p class="text-gray-600">{{ $CategoriaUsuarios ?? ' Nuevo ' }}</p>
            </div>
        </div>

        <!-- Comentarios -->
<li class="w-full">
    <article>
        <div class="px-6 py-4">
            <h3 class="text-xl font-semibold mb-4">Comentarios</h3>

            @if ($comments->count() > 0) <!-- Verifica si hay comentarios -->
                <ul class="space-y-4">
                    @foreach ($comments as $comment)
                        <li class="border-b pb-2 relative">
                            <strong class="text-gray-800">{{ $comment->user->name }}</strong>
                            <div class="relative inline-block text-left">
                                <button onclick="toggleMenu(event)" class="text-gray-500 hover:text-gray-700">
                                    <x-heroicon-o-ellipsis-horizontal class="h-5 w-5" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                                <!-- Menú de opciones -->
                                <div class="menu hidden origin-top-right absolute z-50 left-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                        <!-- boton de editar-->
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="toggleEditForm({{ $comment->id }})" role="menuitem">Editar</a>
                                        <!-- Formulario de edición oculto por defecto -->
                                        <div class="origin-top-right absolute z-50 left-32 rounded-md top-0 w-60 shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                            <form id="edit-form-{{ $comment->id }}"
                                                action="{{ route('comments.update', $comment->id) }}" method="POST"
                                                class="hidden p-3 flex flex-row">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="text" value="{{ $comment->text }}" class="border p-1 w-full">
                                                <button type="submit"
                                                    class="inline-flex items-center p-1 text-blue-500 hover:text-blue-700 pl-3">
                                                    <x-heroicon-o-check class="h-5 w-5"/>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- boton de borrar -->
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar este comentario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-700 hover:bg-gray-100 px-4 py-2 text-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600">{{ $comment->text }}</p>
                            @if (Auth::id() === $comment->userId)
                                <!-- Verifica si el usuario autenticado es el autor del comentario -->
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">No hay comentarios todavía.</p>
            @endif
            <!-- Formulario para agregar comentarios -->
            @auth
                <h3 class="text-lg font-semibold mt-6 mb-2">Agregar comentario</h3>
                <form action="{{ route('comments.store', $note) }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="text" rows="3"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                    <input type="hidden" name="noteId" value="{{ $note }}">
                    <input type="hidden" name="userId" value="{{ Auth::id() }}">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Enviar</button>
                </form>
            @endauth
        </div>
    </article>
</li>
<!-- Función para mostrar/ocultar el menú de opciones
    -->
<script>

    function toggleMenu(event) {
        const menu = event.currentTarget.nextElementSibling;
        menu.classList.toggle('hidden');
    }
    document.addEventListener('click', function (event) {
            const target = event.target;
            if
                (!target.closest('.relative')) {
                document.querySelectorAll('.menu').forEach(menu => {menu.classList.add('hidden');
                });
            }
        });
    function toggleEditForm(commentId) {
        let form = document.getElementById('edit-form-' + commentId);
        form.classList.toggle('hidden');
    }

</script>
</article>
</li>
