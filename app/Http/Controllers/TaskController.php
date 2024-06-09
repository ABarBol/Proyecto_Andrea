<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Mockery\Matcher\Any;

class TaskController extends Controller
{

    public function create(User $user)
    {
        $groups = $user->groups;
        return view('task', compact('groups', 'user'));
    }

    public function adminCreate(Group $group)
    {
        return view('task', compact('group'));
    }
    public function storeGroup(Request $request, Group $group)
    {
        $request->validate([
            'start' => 'required|date',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);


        $task = Task::create([
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => fake()->randomElement(['blue', 'indigo', 'purple', 'red', 'orange', 'green', 'brown'])
        ]);



        if(!is_object($group) && is_int($group)) {
            $group = Group::find($group);
        }

        $userGroups = $group->users;

        foreach ($userGroups as $user) {
            TaskUser::create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'group_id' => $group->id
            ]);
        }

        return redirect()->route('groups.show', $group);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'start' => 'required|date',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);


        $task = Task::create([
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => fake()->randomElement(['blue', 'indigo', 'purple', 'red', 'orange', 'green', 'brown'])
        ]);

        if ($request->filled('group')) {

            $groupId = $request->input('group');
            $groupUsers = UserGroup::where('group_id', $groupId)->get();

            foreach ($groupUsers as $groupUser) {
                TaskUser::create([
                    'task_id' => $task->id,
                    'user_id' => $groupUser->user_id,
                    'group_id' => $groupId
                ]);
            }
        } else {
            TaskUser::create([
                'task_id' => $task->id,
                'user_id' => $user->id
            ]);
        }

        return redirect()->route('users.show', $user);
    }

    public function destroy(Task $task)
    {

        $task->delete();

        return redirect()->route('/');
    }
}
