        <!-- Comentarios -->
        <li class="w-full">
            <article>
                <div class="px-6 py-4">
                    <h3 class="text-xl font-semibold mb-4">Comentarios</h3>

                    @if ($comments->count() > 0) <!-- Verifica si hay comentarios -->
                        <ul class="space-y-4" id="commentBox">
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
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="toggleEditForm({{ $comment->id }})" role="menuitem">Editar</a>
                                                <!-- Formulario de edición oculto por defecto -->
                                                <div class="origin-top-right absolute z-50 left-32 rounded-md top-0 w-60 shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                    <form id="edit-form-{{ $comment->id }}"
                                                        data-comment-id="{{ $comment->id }}"
                                                        class="hidden p-3 flex flex-row">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" name="text" value="{{ $comment->text }}" class="border p-1 w-full">
                                                        <button
                                                            class="inline-flex items-center p-1 text-blue-500 hover:text-blue-700 pl-3">
                                                            <x-heroicon-o-check id="UpdateComment" class="h-5 w-5"/>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- boton de borrar -->
                                                <form action="{{ route('comments.destroy', $comment->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="destroyComment"
                                                        class="text-red-700 hover:bg-gray-100 px-4 py-2 text-sm">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="comment-text-{{ $comment->id }}" class="text-gray-600">{{ $comment->text }}</p>
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
                        <form action="{{ route('comments.store', $note) }}" class="space-y-4">
                            @csrf
                            @method('POST')
                            <textarea name="text" rows="3"
                                class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></textarea>
                            <input type="hidden" name="noteId" value="{{ $note }}">
                            <input type="hidden" name="userId" value="{{ Auth::id() }}">
                            <button id="CreateComment"
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

document.addEventListener("DOMContentLoaded", function () {

    // ✅ Función para enviar formularios sin recargar la página
    function handleCommentAction(event, method, url, formData) {
        event.preventDefault();

        fetch(url, {
            method: method,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                if (method === "DELETE") {
                    event.target.closest("li").remove(); // 🔥 Elimina el comentario de la vista
                } else if (method === "POST") {
                    // 🔥 Agrega el nuevo comentario a la lista (AJAX)
                    location.reload(); // O puedes actualizar el DOM sin recargar
                } else if (method === "PUT") {
                    // 🔥 Actualiza el comentario sin recargar
                    let commentId = event.target.dataset.commentId;
                    document.querySelector(`#edit-form-${commentId}`).classList.add("hidden");
                    document.querySelector(`#comment-text-${commentId}`).textContent = formData.get("text");
                }
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Crear comentario
document.querySelector("#CreateComment").addEventListener("click", function (event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado
    let form = event.target.closest("form");
    let formData = new FormData(form);
    let url = form.action;

    fetch(url, {
        method: 'POST',
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            // Crear el nuevo comentario en el DOM
            const commentBox = document.getElementById("commentBox");

            // Crear el nuevo comentario
            let newComment = document.createElement("li");
            newComment.classList.add("border-b", "pb-2", "relative");
            newComment.innerHTML = `
                <strong class="text-gray-800">${data.userName}</strong>
                <p class="text-gray-600">${data.commentText}</p>
            `;

            // Agregarlo al final de la lista
            commentBox.appendChild(newComment);

            // Limpiar el formulario
            form.reset();
        }
    })
    .catch(error => console.error("Error:", error));
});

    // ✅ Editar comentario
    document.querySelectorAll("#UpdateComment").forEach(button => {
        button.addEventListener("click", function (event) {
            let form = event.target.closest("form");
            let formData = new FormData(form);
            let commentId = form.dataset.commentId;
            let url = `/comments/${commentId}`;
            handleCommentAction(event, "PUT", url, formData);
        });
    });

    // ✅ Eliminar comentario
    document.querySelectorAll("#destroyComment").forEach(button => {
        button.addEventListener("click", function (event) {

            let form = event.target.closest("form");
            let formData = new FormData(form);
            let url = form.action;
            handleCommentAction(event, "DELETE", url, formData);
        });
    });

});
</script>

