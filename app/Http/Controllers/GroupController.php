<?php

namespace App\Http\Controllers;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('notes')->get();
        return view('group.index', compact('groups'));
    }

    public function show(Group $group)
    {
        $notes = $group->notes()->latest()->get();
        return view('group.show', compact('group', 'notes'));
    }
}
