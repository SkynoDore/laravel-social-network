<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function welcome()
    {
        $notes = Note::all();
        return view("welcome", compact("notes"));
    }

    public function guest()
    {
        $notes = Note::all();
        return view("note.guest", compact("notes"));
    }
    public function index()
    {
        $notes = Note::all();
        return view("note.index", compact("notes"));
    }
    public function create()
    {
        return view("note.create");
    }
    public function store(Request $request)
    {
        Note::create($request->all());
        return redirect()->route('note.index');
    }
    public function edit(Note $note)
    {
        return view('note.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->all());
        return redirect()->route('note.index');
    }
    public function show(Note $note)
    {
        return view('note.show', compact('note'));
    }

    public function destroy(Request $request, Note $note)
    {
        $note->delete();
        return redirect()->route('note.index');
    }
}
