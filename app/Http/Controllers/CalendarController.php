<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){

        $groups = Group::OrderBy('id','desc')->paginate();
        return view('calendars.index', compact('groups'));
    }

    public function create(){
        return view('calendars.create');
    }

    public function store(Request $request){
        $grupo = new Group();
        $grupo->name = $request->name;
        $grupo->save();

        return redirect()->route('calendars.show', $grupo);
    }

    public function show(Group $calendar){
        return view('calendars.show',compact('calendar'));
    }

    public function edit(Group $group){
        return view('calendars.edit', compact('group'));
    }

    public function update(Request $request, Group $group){
        $group->name = $request->name;
        $group->save();

        return redirect()->route('calendars.show', $group);
    }
}
