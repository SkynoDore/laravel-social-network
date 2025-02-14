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

        return response()->json(['success' => 'Comentario agregado.', 'userName' => 'tú', 'commentText' => $request->text]);
    }
    public function update(Request $request, Comment $comment)
    {
        // Verifica si el usuario es dueño del comentario
        if ($comment->userId !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        // Validar datos
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        // Actualizar comentario
        $comment->update([
            'text' => $request->text,
        ]);

        return response()->json(['success' => 'Comentario actualizado.', 'comment' => $comment]);
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

        return response()->json(['success' => 'Comentario eliminado.']);
    }
}
