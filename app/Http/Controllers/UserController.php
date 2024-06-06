<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {

        $users = User::OrderBy('id', 'desc')->paginate();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUser $request)
    {
        // $user = new User();
        // $user->name = $request->name;
        // $user->save();

        $user = User::create($request->all());

        return redirect()->route('users.show', $user);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(StoreUser $request, User $user)
    {
        if(empty($request->input('password'))) {
            $request->merge(['password' => $user->password]);
        }

        $user->update($request->all());

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('users.index');
    }
}
