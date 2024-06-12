<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    /**
     * Displays the list of users, if you are the administrator, provides you with a selection menu.
     *
     * @return View
     */
    public function index()
    {

        $users = User::OrderBy('id', 'desc')->paginate();
        $allUsers = User::all();
        return view('users.index', compact('users', 'allUsers'));
    }


    /**
     * Returns the selected user or displays the user view.
     *
     * @param Request $request
     * @param User $user
     * @return View
     */
    public function search(Request $request, User $user)
    {

        if (isset($request->user_id)) {
            $foundUsesr = User::find($request->user_id);
            return redirect()->route('users.show', $foundUsesr);
        }

        $users = User::OrderBy('id', 'desc')->paginate();
        $allUsers = User::all();
        return view('users.index', compact('users', 'allUsers'));
    }


    /**
     * Register a user after filling in the registration form
     *
     * @param StoreUser $request
     * @return RedirectResponse
     */
    public function register(StoreUser $request)
    {
        $user = User::create($request->all());

        Auth::login($user);

        return redirect()->route('users.show', $user);
    }

    /**
     * Displays the user's tasks
     *
     * @param User $user
     * @return View
     */
    public function show(User $user)
    {
        $tasks = $user->tasks->map(function ($task) use ($user) {
            $userTask = TaskUser::where('task_id', $task->id)->where('user_id', $user->id)->first();
            if ($userTask) {
                $task->groupOfTask = $userTask->group;
            }

            return $task;
        });

        $groups = $user->groups;

        return view('users.show', compact('user', 'tasks', 'groups'));
    }


    /**
     * Displays the user edit form
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (empty($request->input('password'))) {
            $request->merge(['password' => $user->password]);
        }


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => [
                'required',
                Password::min(7)->letters()->mixedCase()->symbols()
            ]
        ]);


        $user->update($request->all());

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove a user and delete their session
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(User $user, Request $request)
    {

        if ($user->id != 1) {
            $user->delete();

            if (Auth::user()->admin) {
                return redirect()->route('users.index');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('home.show');
            }
        }

        return redirect()->route('users.show', Auth::user())->withErrors(['msg' => 'El administrador no puede borrarse a sí mismo']);
    }

    /**
     * Deletes a task from the user's profile, if it is not a group task, deletes it permanently
     *
     * @param User $user
     * @param integer $taskId
     * @return RedirectResponse
     */
    public function deleteTask(User $user, int $taskId)
    {
        $taskFromUser = TaskUser::where('user_id', $user->id)->where('task_id', $taskId)->first();

        if (is_null($taskFromUser->group_id)) {
            $task = Task::find($taskFromUser->task_id);
            $task->delete();
        } else {
            $taskFromUser->delete();
        }

        return redirect()->route('users.show', $user);
    }


    /**
     * Processes user login
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('users.show', Auth::user()));
        }

        return redirect()->back()
            ->withErrors(['login_error' => 'Usuario o contraseña incorrectos'])
            ->withInput();
    }

    /**
     * Log out the user of the session
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.show');
    }
}
