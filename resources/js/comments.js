// Asignar eventos cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener("click", function (event) {
        // Crear comentario
        if (event.target.classList.contains("CreateComment")) {
            console.log("Botón 'CreateComment' clickeado:", event.target);
            event.preventDefault();

            let form = event.target.closest("form");
            if (!form) {
                return;
            }

            let formData = new FormData(form);
            let url = form.action;
            let commentBox = form.closest("article").querySelector(".commentBox");

            if (!commentBox) {
                return;
            }

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let newComment = document.createElement("li");
                        newComment.classList.add("border-b", "pb-2", "relative");
                        newComment.innerHTML = `
                            <strong class="text-gray-800">${data.userName}</strong>
                            <p class="text-gray-600">${data.commentText}</p>
                        `;

                        commentBox.appendChild(newComment);
                        form.reset();
                    }
                })
                .catch(error => console.error("Error en la petición:", error));
        }
    // Editar comentario
if (event.target.closest('#UpdateComment')) {
    event.preventDefault();  // Prevenir el comportamiento predeterminado de envío
    let form = event.target.closest("form");

    // Obtener solo el valor de 'text' del formulario
    let text = form.querySelector('input[name="text"]').value;

    // Crear un objeto FormData para solo enviar el campo 'text'
    let formData = new FormData();
    formData.append('text', text);  // Añadir el campo 'text'

    // Añadir también el CSRF Token y el método PUT
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('_method', 'PUT');  // El método PUT debe ser incluido de forma manual

    let url = form.action;

    fetch(url, {
        method: "POST",  // Usar POST aunque sea para PUT debido a los métodos manuales
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let commentId = form.dataset.commentId;
            document.querySelector(`#comment-text-${commentId}`).textContent = text;
            form.closest(".menu").classList.add("hidden");
        }
    })
    .catch(error => console.error("Error en la petición:", error));
}


    // Eliminar comentario
    if (event.target.closest('form') && event.target.closest('form').querySelector('#destroyComment')) {
        event.preventDefault();  // Prevenir el comportamiento predeterminado de envío
        let form = event.target.closest("form");
        let url = form.action;

        fetch(url, {
            method: "DELETE",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.closest("li").remove();
                }
            })
            .catch(error => console.error("Error en la petición:", error));
    }
});
});
