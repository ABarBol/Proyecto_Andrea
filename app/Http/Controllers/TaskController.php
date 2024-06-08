<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function create(int $id)
    {

        $user = User::find($id); 
        $groups = $user->groups;
        return view('task', compact('groups', 'user'));
    }

    public function store(Request $request, int $userId)
    {
        $task = Task::create([
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => fake()->colorName()
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
                'user_id' => $userId
            ]);
        }

        return redirect()->route('users.show', $userId);
    }

    public function destroy(Task $task)
    {

        $task->delete();

        return redirect()->route('/');
    }
}
