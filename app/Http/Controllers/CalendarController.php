<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroup;
use App\Models\Group;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {

        $calendars = Group::OrderBy('id', 'desc')->paginate();
        return view('calendars.index', compact('calendars'));
    }

    public function create()
    {
        return view('calendars.create');
    }

    public function store(StoreGroup $request)
    {
        // $calendar = new Group();
        // $calendar->name = $request->name;
        // $calendar->save();

        $calendar = Group::create($request->all());

        return redirect()->route('calendars.show', $calendar);
    }

    public function show(Group $calendar)
    {
        return view('calendars.show', compact('calendar'));
    }

    public function edit(Group $calendar)
    {
        return view('calendars.edit', compact('calendar'));
    }

    public function update(StoreGroup $request, Group $calendar)
    {

        $calendar->update($request->all());

        return redirect()->route('calendars.show', $calendar);
    }

    public function destroy(Group $calendar)
    {

        $calendar->delete();

        return redirect()->route('calendars.index');
    }
}
