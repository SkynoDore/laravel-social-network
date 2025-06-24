<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
   public function index(Request $request)
{
    $query = Group::query();

    // Filtro de búsqueda por título
    if ($request->filled('search')) {
        $query->where('groups.title', 'like', '%' . $request->input('search') . '%');
    }

    $sort = $request->input('sort');

    if ($sort === 'popular') {
        $query->withCount('notes')
              ->orderByDesc('notes_count');
    } elseif ($request->filled(['lat', 'lng'])) {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        $query->selectRaw('groups.id, groups.uid, groups.title, groups.latitude, groups.longitude, groups.area, groups.district, groups.locality, groups.street_address, groups.postal_code, groups.link, groups.price, groups.created_at, groups.updated_at, COUNT(notes.id) as notes_count,
            (6371 * acos(
                cos(radians(?)) * cos(radians(groups.latitude)) *
                cos(radians(groups.longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(groups.latitude))
            )) AS distance', [$lat, $lng, $lat])
            ->leftJoin('notes', 'groups.id', '=', 'notes.group_id')
            ->groupBy('groups.id')
            ->orderBy('distance');
    } else {
        $query->withCount('notes');
    }

    $groups = $query->get();

    return view('group.index', compact('groups'));
}



    public function show(Group $group)
    {
        $notes = $group->notes()->latest()->get();
        return view('group.show', compact('group', 'notes'));
    }
}
