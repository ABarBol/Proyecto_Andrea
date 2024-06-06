<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {

        $groups = Group::OrderBy('id', 'desc')->paginate();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $group = Group::create($request->all());

        return redirect()->route('groups.show', $group);
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function update(Request $request, Group $group)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $group->update($request->all());

        return redirect()->route('groups.show', $group);
    }

    public function destroy(Group $group)
    {

        $group->delete();

        return redirect()->route('groups.index');
    }
}
