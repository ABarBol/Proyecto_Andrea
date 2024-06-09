<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'name' => 'required|unique:groups|max:121',
            'users' => 'required'
        ]);

        $group = Group::create([
            'name' => $request->input('name'),
        ]);


        foreach ($request->input('users') as $userId) {
            UserGroup::create([
                'user_id' => $userId,
                'group_id' => $group->id,
            ]);
        }

        return redirect()->route('groups.show', $group);
    }

    public function show(Group $group)
    {

        $users = $group->users;
        $tasksUsers = TaskUser::select('task_id')->where('group_id', $group->id)->distinct()->get();

        $tasks = [];
        foreach ($tasksUsers as $tasksUser) {
            $tasks[] = Task::find($tasksUser->task_id);
        }

        return view('groups.show', compact('group', 'users', 'tasks'));
    }


    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|unique:groups,name,' . $group->id . '|max:121',
        ]);

        $group->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('groups.show', $group);
    }

    public function editUsersGroup(Request $request, Group $group)
    {

        return view('groups.show', compact('group'));
    }

    public function destroy(Group $group, User $user)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

    public function deleteUser(User $user, int $groupId)
    {
        $group = Group::find($groupId);
        $userFromGroup = UserGroup::where('user_id', $user->id)->where('group_id', $groupId)->first();
        $userFromGroup->delete();
        return redirect()->route('groups.show', $group);
    }

    public function deleteTask(Group $group, int $taskId)
    {

        $task = Task::find($taskId);

        $tasksFromGroup = TaskUser::where('task_id', $taskId)->get();

        foreach ($tasksFromGroup as $taskFromGroup) {
            $taskFromGroup->delete();
        }

        $task->delete();

        return redirect()->route('groups.show', $group);
    }

    public function editUsers(Group $group)
    {

        $oldUsers = $group->users;
        $users = User::all();

        return view('groups.editUsers', compact('group', 'users', 'oldUsers'));
    }

    public function updateUsers(Request $request, Group $group)
    {

        $request->validate([
            'users' => 'required|array',
        ]);

        foreach ($request->input('users') as $userId) {
            UserGroup::updateOrCreate(
                [
                    'user_id' => $userId,
                    'group_id' => $group->id,
                ]
            );
        }

        return redirect()->route('groups.show', $group);
    }
}
