<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function welcome(): View
    {
        $notes = Note::all();
        return view("welcome", compact("notes"));
    }

    public function guest(): View
    {
        $notes = Note::all();
        return view("note.guest", compact("notes"));
    }
    public function index(): View
    {
        $notes = Note::all();
        return view("note.index", compact("notes"));
    }
    public function create(): View
    {
        $notes = Note::all();

        return view("note.create");
    }
    public function store(NoteRequest $request): RedirectResponse
    {
    // Verifica si el usuario está autenticado
    if (auth::check()) {
        $note = Note::create([
            'title' => $request->input('title'),
            'userId' => Auth::id(),  // ID del usuario autenticado
            'description' => $request->input('description'),
        ]);

        // Guarda la imagen si se subió
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/notes', 'public');
            $note->image = $imagePath;
            $note->save();
        }

        return redirect()->route('note.index')->with('success', 'Nota creada exitosamente');
    }

    return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
}

    public function edit(Note $note): View
    {
        return view('note.edit', compact('note'));
    }

    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        $note->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);;
        if ($request->hasFile('image')) {
            // 3️⃣ Guardar la imagen en 'storage/app/public/images/notes'
            $imagePath = $request->file('image')->store('images/notes', 'public');
            // 4️⃣ Asignar la ruta de la imagen a la nota y guardar
            $note->image = $imagePath;
            $note->save();
        }
        return redirect()->route('note.index')->with('success', 'Nota actualizada correctamente.');
    }
    public function show(Note $note): View
    {
        return view('note.show', compact('note'));
    }

    public function destroy(Request $request, Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->route('note.index');
    }
}
