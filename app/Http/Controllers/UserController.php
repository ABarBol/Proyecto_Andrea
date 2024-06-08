<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Group;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function index()
    {

        $users = User::OrderBy('id', 'desc')->paginate();
        return view('users.index', compact('users'));
    }


    public function register(StoreUser $request)
    {
        $user = User::create($request->all());

        Auth::login($user);

        return redirect()->route('users.show', $user);
    }

    public function show(User $user)
    {
        $tasks = $user->tasks->map(function ($task) use ($user) {
            $userTask = TaskUser::where('task_id', $task->id)->where('user_id', $user->id)->first();
            if ($userTask) {
                $task->groupOfTask = $userTask->group;
            }

            return $task;
        });

        return view('users.show', compact('user', 'tasks'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(StoreUser $request, User $user)
    {
        if (empty($request->input('password'))) {
            $request->merge(['password' => $user->password]);
        }

        $user->update($request->all());

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        dd('quiero vaquero');
        $user->delete();
        return redirect()->route('users.index');
    }

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.show');
    }
}
