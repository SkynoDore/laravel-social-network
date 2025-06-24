@props([
    'note',
    'title',
    'description',
    'created',
    'image',
    'username',
    'user',
    'comments',
    'category',
    'group',
    'likes',
    'liked' => false,
])

<li>
    <article class="w-full sm:w-3/6 mx-auto flex flex-col items-start justify-between bg-white shadow-md rounded-lg">
        <!-- Imagen superior -->
        @if (!empty($image))
            <!-- Verifica que la imagen no esté vacía ni nula -->
            <div class="w-full h-full">
                <img src="{{ asset('storage/' . $image) }}" alt="Imagen principal"
                    class="w-full object-cover rounded-t-lg">
            </div>
        @endif
        <div class="flex flex-row justify-between w-full">
            <!-- Meta info -->
            <div class="flex items-center gap-x-4 text-xs px-6 py-3">
                <time class="text-gray-500">{{ $created ?? 'no hay datos' }}</time>
                <a href="/category/{{ $category ?? 'general' }}"
                    class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200">
                    {{ $category ?? 'General' }}
                </a>

                @if (auth()->check() && (auth()->id() === $user->id || auth()->user()->role === 'admin'))
                    <div class="space-x-2 text-sm">
                        <a href="{{ route('note.edit', $note) }}" class="text-blue-500 hover:underline">Editar</a> |
                        <form method="POST" action="{{ route('note.destroy', $note) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                onclick="return confirm('¿Estás seguro de eliminar esta nota?')">Borrar</button>
                        </form>
                    </div>
                @endif

            </div>
            <!--Ubicación del grupo si la hay-->
            <!-- Botón de like -->
            <div class="flex items-center space-x-2 px-6 py-3 ">
                <button onclick="toggleLike({{ $note }})" id="like-btn-{{ $note }}"
                    class="{{ $liked ? 'text-red-600' : 'text-gray-400' }} hover:text-red-600 focus:outline-none">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6
               4 4 6.5 4c1.74 0 3.41 1.01 4.13 2.44h.74C13.09
               5.01 14.76 4 16.5 4 19 4 21 6 21 8.5c0 3.78-3.4
               6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </button>
                <span id="like-count-{{ $note }}" class="text-sm text-gray-600">
                    {{ $likes }}
                </span>
            </div>
        </div>
        @if ($group)
            <div class="flex items-center gap-x-4 text-xs px-6 py-3">
                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 2a6 6 0 00-6 6c0 4 6 10 6 10s6-6 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z"
                        clip-rule="evenodd" />
                </svg>

                <a href="{{ route('group.show', $group) }}" class="hover:underline">
                    En {{ $group->title }}
                </a>
            </div>
        @endif
        <!-- Título y descripción -->
        <div class="px-6">
            <h3 class="mt-3 text-2xl font-semibold text-gray-900 hover:text-gray-600">
                <a href="/note/{{ $note }}">
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
            <!-- componente imagen de perfil -->
            <x-profile-pic :user="$user" size="w-12 h-12" />
            <!-- Pasamos el usuario -->
            <div class="text-sm">
                <p class="font-semibold text-gray-900">
                    <a href="profile/{{ $user->id ?? '' }}">
                        <span></span>
                        <!-- variable nombre de usuario-->
                        {{ $username ?? 'Usuario Desconocido' }}
                    </a>
                </p>
                <p class="text-gray-600">{{ $CategoriaUsuarios ?? ' Nuevo ' }}</p>
            </div>
        </div>
        <x-notes.comment :comments="$comments" :note="$note" />
    </article>
</li>
