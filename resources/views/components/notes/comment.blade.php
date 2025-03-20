        <!--<x-notes.comment
            $comments
            $note
        -->
        <li class="w-full">
            <article>
                <div class="px-6 py-4">
                    <h3 class="text-xl font-semibold mb-4">Comentarios</h3>
                    <ul class="space-y-4 commentBox">
                        @forelse ($comments as $comment)
                            <li class="border-b pb-2">
                                <div class="relative flex">
                                <x-profile-pic :user="$comment->user" size="w-8 h-8" />
                <div class="flex flex-col">
                <div>
                                <strong class="text-gray-800">{{ $comment->user->name }}</strong>
                                @if (Auth::id() === $comment->userId)
                                <div class="relative inline-block text-left">
                                    <button onclick="toggleMenu(event)" class="text-gray-500 hover:text-gray-700">
                                        <x-heroicon-o-ellipsis-horizontal class="h-5 w-5" />
                                    </button>
                                    <!-- Menú de opciones -->
                                    <div class="menu hidden origin-top-right absolute z-50 left-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                            <!-- Botón de editar -->
                                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="toggleEditForm({{ $comment->id }})" role="menuitem">Editar</a>
                                            <!-- Formulario de edición oculto por defecto -->
                                            <div class="origin-top-right absolute z-50 left-32 rounded-md top-0 w-60 shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                <form action="{{ route('comments.update', $comment->id) }}" id="edit-form-{{ $comment->id }}" data-comment-id="{{ $comment->id }}" class="hidden p-3 flex flex-row">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="text" value="{{ $comment->text }}" class="border p-1 w-full">
                                                    <button class="inline-flex items-center p-1 text-blue-500 hover:text-blue-700 pl-3">
                                                        <x-heroicon-o-check id="UpdateComment" class="h-5 w-5"/>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- Botón de borrar -->
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button id="destroyComment"
                                                    class="text-red-700 hover:bg-gray-100 px-4 py-2 text-sm">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                </div>
                                @endif

                                <p id="comment-text-{{ $comment->id }}" class="text-gray-600">{{ $comment->text }}</p>
                </div>
                                </div>
                            </li>
                        @empty
                            <p class="text-gray-600">No hay comentarios todavía.</p>
                        @endforelse
                    </ul>

                    <!-- Formulario para agregar comentarios -->
                    @auth
                        <h3 class="text-lg font-semibold mt-6 mb-2">Agregar comentario</h3>
                        <form action="{{ route('comments.store', $note) }}" class="space-y-4" data-comment-id="{{ $note }}">
                            @csrf
                            @method('POST')
                            <textarea name="text" rows="3"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></textarea>
                            <input type="hidden" name="userId" value="{{ Auth::id() }}">
                            <button class="CreateComment bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Enviar</button>
                        </form>
                    @endauth
                </div>
            </article>
        </li>
        <script>
            function toggleMenu(event) {
    const menu = event.currentTarget.nextElementSibling;
    menu.classList.toggle('hidden');
}
function toggleEditForm(commentId) {
    let form = document.getElementById('edit-form-' + commentId);
    form.classList.toggle('hidden');
}
        </script>
