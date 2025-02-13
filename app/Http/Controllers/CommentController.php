<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class CommentController extends Controller
{
    // Mostrar comentarios de una nota
    public function index($noteId)
    {
        // Buscar la nota
        $note = Note::findOrFail($noteId);
        return view('comments.index', compact('note')); // Mostrar vista con los comentarios
    }

    // Crear un nuevo comentario
    public function store(Request $request, $noteId)
    {
        // Validar datos
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);
        $comment = Comment::create([
            'userId' => Auth::id(), // Usuario autenticado
            'noteId' => $noteId,
            'text' => $request->text,
        ]);

        return redirect()->route('note.show', $noteId)->with('success', 'Comentario agregado');
    }

    // Eliminar un comentario
    public function destroy(Comment $comment)
{
    // Verifica si el usuario es dueño del comentario
    if ($comment->userId !== Auth::id()) {
        return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
    }

    // Elimina el comentario
    $comment->delete();

    return redirect()->back()->with('success', 'Comentario eliminado correctamente.');

    }
}

