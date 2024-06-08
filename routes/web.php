<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureUserIsAuthorized;
use App\Http\Middleware\IsAdminOrAuth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeController::class)->name('home.show');
Route::fallback(function () {
    return redirect('/');
});

Route::get('login', function () {
    return view('users.login');
});
Route::get('register', function () {
    return view('users.register');
});
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('register', [UserController::class, 'register'])->name('register');



Route::middleware([Authenticate::class])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('usuarios', 'index')->name('users.index');
        Route::get('usuarios/{user}', 'show')->name('users.show')->middleware(EnsureUserIsAuthorized::class);
        Route::get('usuarios/{user}/edit', 'edit')->name('users.edit')->middleware(EnsureUserIsAuthorized::class);
        Route::put('usuarios/{user}', 'update')->name('users.update')->middleware(EnsureUserIsAuthorized::class);
        Route::delete('usuarios/{user}', 'destroy')->name('users.destroy')->middleware(EnsureUserIsAuthorized::class);
    });

    // Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user'])->names('users')->middleware(EnsureUserIsAuthorized::class);
    Route::resource('grupos', GroupController::class)->parameters(['grupos' => 'group'])->names('groups')->middleware(IsAdminOrAuth::class);
    Route::delete('grupos/{user}/{groupId}', [GroupController::class, 'deleteUser'])->name('groups.deleteUser')->middleware(IsAdminOrAuth::class);
    Route::delete('grupos/{groupId}', [GroupController::class, 'deleteTask'])->name('groups.deleteTask')->middleware(IsAdminOrAuth::class);

    Route::get('calendario/{user}', [CalendarController::class, 'index'])->name('calendar.show')->middleware(EnsureUserIsAuthorized::class);

    Route::get('tareas/crear/{user}', [TaskController::class, 'create'])->name('tasks.create')->middleware(EnsureUserIsAuthorized::class);
    Route::post('tareas/crear/{user}', [TaskController::class, 'store'])->name('tasks.store')->middleware(EnsureUserIsAuthorized::class);
    Route::get('tareas/adminCrear/{group}', [TaskController::class, 'adminCreate'])->name('tasks.adminCreate')->middleware(IsAdminOrAuth::class);
    Route::post('tareas/adminCrear/{group}', [TaskController::class, 'storeGroup'])->name('tasks.storeGroup')->middleware(IsAdminOrAuth::class);



    Route::delete('usuarios/{user}/{taskId}', [UserController::class, 'deleteTask'])->name('users.deleteTask')->middleware(EnsureUserIsAuthorized::class);
});
