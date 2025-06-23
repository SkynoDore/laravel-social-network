<?php

namespace App\Http\Controllers;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::withCount('notes');

        if ($request->filled('search')) {
            $groups->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $groups = $groups->get();
        return view('group.index', compact('groups'));
    }

    public function show(Group $group)
    {
        $notes = $group->notes()->latest()->get();
        return view('group.show', compact('group', 'notes'));
    }
}
