<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Group;

class NoteController extends Controller
{

    public function index(): View
{
    $user = null;

    if (Auth::check()) {
        $userId = Auth::id();
        $user = User::find($userId); // find, no findOrFail para evitar excepción
    }

    $notes = Note::with([
        'user',
        'group',
        'likedByUsers',
        'comments' => function ($query) {
            $query->limit(3)->with('user');
        }
    ])
    ->latest()
    ->get();

    $likedNoteIds = [];

    if ($user) {
        $likedNoteIds = $user->likedNotes()
            ->pluck('note_id')
            ->toArray();
    }

    return view("index", compact("notes", "likedNoteIds", "user"));
}


    public function profile($userId = null): View
    {
        $userId = $userId ?? Auth::id();

        $user = User::findOrFail($userId);
        $notes = Note::with(['user', 'comments' => function ($query) {
            $query->limit(3);
        }])->where('userId', $userId)
            ->latest()
            ->get();

        $likedNoteIds = [];

        if (Auth::check()) {
            $likedNoteIds = Auth::user()->likedNotes()
                ->pluck('note_id')
                ->toArray();
        }

        return view("note.profile", compact("notes", "user", "userId", "likedNoteIds"));
    }


    public function show(Note $note): View
    {
        $hasLiked = false;

        if (Auth::check()) {
            $hasLiked = $note->likedByUsers()
                ->where('user_id', Auth::id())
                ->exists();
        }

        $comments = $note->comments()->with(['user', 'group'])->get();

        return view('note.show', compact('note', 'comments', 'hasLiked'));
    }


    public function category($category): View
    {
        $notes = Note::with('user')
            ->where('category', $category)
            ->latest()
            ->get();

        $likedNoteIds = [];

        if (Auth::check()) {
            $likedNoteIds = Auth::user()
                ->likedNotes()
                ->pluck('note_id')
                ->toArray();
        }

        return view('note.category', compact('notes', 'category', 'likedNoteIds'));
    }


    public function like(Note $note)
    {
        $user = Auth::id();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $hasLiked = $note->likedByUsers()->where('user_id', $user)->exists();

        if ($hasLiked) {
            $note->likedByUsers()->detach($user);
            $note->decrement('likes');
        } else {
            $note->likedByUsers()->attach($user);
            $note->increment('likes');
        }

        $note->refresh();

        return response()->json([
            'likes' => $note->likes,
            'hasLiked' => !$hasLiked
        ]);
    }



    public function create(Request $request): View
    {
        $groupId = $request->query('group'); // null si no se pasa
        $group = $groupId ? Group::find($groupId) : null;

        return view("note.create", compact('group'));
    }
    public function store(NoteRequest $request): RedirectResponse
    {
        // Verifica si el usuario está autenticado
        if (auth::check()) {
            $note = Note::create([
                'title' => $request->input('title'),
                'userId' => Auth::id(),  // ID del usuario autenticado
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'group_id' => $request->input('group_id'),
            ]);

            // Guarda la imagen si se subió
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/notes', 'public');
                $note->image = $imagePath;
                $note->save();
            }

            return redirect()->route('note.profile')->with('success', 'Nota creada exitosamente');
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
            'category' => $request->input('category'),
        ]);;

        if (($request->filled('delete_image') || $request->hasFile('image')) && $note->image) {
            if (Storage::disk('public')->exists($note->image)) {
                Storage::disk('public')->delete($note->image);
            }
            $note->image = null;
        }

        if ($request->hasFile('image')) {
            if ($note->image && Storage::disk('public')->exists($note->image)) {
                Storage::disk('public')->delete($note->image);
            }

            $imagePath = $request->file('image')->store('images/notes', 'public');
            $note->image = $imagePath;
        }
        $note->save();

        return redirect()->route('note.show', $note->id)->with('success', 'Nota actualizada correctamente.');
    }


    public function destroy(Note $note): RedirectResponse
    {
        // Borrar imagen del storage si existe
        if ($note->image && Storage::disk('public')->exists($note->image)) {
            Storage::disk('public')->delete($note->image);
        }
        $note->delete();
        return redirect()->route('note.profile');
    }
}
