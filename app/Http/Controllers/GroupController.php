<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * This is the group controller
 */
class GroupController extends Controller
{
    /**
     * Show all users
     *
     * @return View of all groups
     */
    public function index() : View
    {

        $groups = Group::OrderBy('id', 'desc')->paginate();
        return view('groups.index', compact('groups'));
    }

    /**
     * Displays the form to create a group
     *
     * @return View with group creation form
     */
    public function create() : View
    {

        $users = User::all();

        return view('groups.create', compact('users'));
    }


    /**
     * Create the group
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
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

    /**
     * Show the view of the group
     *
     * @param Group $group
     * @return View
     */
    public function show(Group $group) : View
    {

        $users = $group->users;
        $tasksUsers = TaskUser::select('task_id')->where('group_id', $group->id)->distinct()->get();

        $tasks = [];
        foreach ($tasksUsers as $tasksUser) {
            $tasks[] = Task::find($tasksUser->task_id);
        }

        return view('groups.show', compact('group', 'users', 'tasks'));
    }


    /**
     * Update the name of the group
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function update(Request $request, Group $group) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:groups,name,' . $group->id . '|max:121',
        ]);

        $group->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('groups.show', $group);
    }


    /**
     * Show the form for adding users
     *
     * @param Request $request
     * @param Group $group
     * @return View
     */
    public function editUsersGroup(Request $request, Group $group) : View
    {

        return view('groups.show', compact('group'));
    }

    /**
     * Delete a group
     *
     * @param Group $group
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Group $group, User $user) : RedirectResponse
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

    /**
     * Deletes the user from a group and his tasks from the profile
     *
     * @param User $user
     * @param integer $groupId
     * @return RedirectResponse
     */
    public function deleteUser(User $user, int $groupId) : RedirectResponse
    {
        $group = Group::find($groupId);
        $userFromGroup = UserGroup::where('user_id', $user->id)->where('group_id', $groupId)->first();
        $tasksfromGroup = TaskUser::where('user_id', $user->id)->where('group_id', $groupId)->get();

        foreach ($tasksfromGroup as $taskfromGroup) {
            $taskfromGroup->delete();
        }

        $userFromGroup->delete();
        return redirect()->route('groups.show', $group);
    }


    /**
     * Delete the task from the group
     *
     * @param Group $group
     * @param integer $taskId
     * @return RedirectResponse
     */
    public function deleteTask(Group $group, int $taskId) : RedirectResponse
    {

        $task = Task::find($taskId);

        $tasksFromGroup = TaskUser::where('task_id', $taskId)->get();

        foreach ($tasksFromGroup as $taskFromGroup) {
            $taskFromGroup->delete();
        }

        $task->delete();

        return redirect()->route('groups.show', $group);
    }

    /**
     * Displays the form for adding users to the group
     *
     * @param Group $group
     * @return View
     */
    public function editUsers(Group $group) : View
    {

        $oldUsers = $group->users;
        $users = User::all();

        return view('groups.editUsers', compact('group', 'users', 'oldUsers'));
    }

    /**
     * Adds users to the group and adds the group's tasks to the user's profile
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function updateUsers(Request $request, Group $group) : RedirectResponse
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

        $tasks = TaskUser::select('task_id')->where('group_id', $group->id)->distinct()->get();

        foreach ($tasks as $task) {
            foreach ($request->input('users') as $userId) {
                TaskUser::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'task_id' => $task->task_id,
                        'group_id'=> $group->id
                    ]
                );
            }
        }


        return redirect()->route('groups.show', $group);
    }
}
