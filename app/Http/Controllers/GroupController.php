<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
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

        $users = User::all();

        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $group = Group::create([
            'name' => $request->input('name'),
        ]);

        foreach ($request->input('users') as $user) {

            UserGroup::create([
                'user_id' => $user,
                'group_id' => $group->id
            ]);
        }

        return redirect()->route('groups.show', $group);
    }

    public function show(Group $group)
    {

        $users = $group->users;
        $tasksUsers = TaskUser::where('group_id', $group->id)->get();

        $tasks = [];
        foreach ($tasksUsers as $tasksUser) {
           $tasks[] = $tasksUser->task;
        }

        return view('groups.show', compact('group', 'users', 'tasks'));
    }

    public function update(Request $request, Group $group)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $group->update($request->all());

        return redirect()->route('groups.show', $group);
    }

    public function destroy(Group $group, User $user)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

    public function deleteUser(int $userId, int $groupId)
    {
        $group = Group::find($groupId);
        $userFromGroup = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->first();
        $userFromGroup->delete();
        return redirect()->route('groups.show', $group);
    }

    public function deleteTask(int $groupId)
    {

        $group = Group::find($groupId);
        $tasksFromGroup = TaskUser::where('group_id', $groupId)->get();

        foreach ($tasksFromGroup as $taskFromGroup) {
            $taskFromGroup->delete();
        }

        return redirect()->route('groups.show', $group);
    }
}
