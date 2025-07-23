function toggleLike(noteId) {
    document.addEventListener('DOMContentLoaded', () => {
});
 fetch(`/notes/${noteId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error al dar/quitar like');
        return response.json();
    })
    .then(data => {
        const countEl = document.getElementById(`like-count-${noteId}`);
        const btnEl = document.getElementById(`like-btn-${noteId}`);

        countEl.textContent = data.likes;

        btnEl.classList.remove('text-red-600', 'text-gray-400');
        if (data.hasLiked) {
            btnEl.classList.add('text-red-600');
        } else {
            btnEl.classList.add('text-gray-400');
        }
    })
    .catch(error => {
        console.error(error);
    });
}
