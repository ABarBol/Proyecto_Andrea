<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;

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

Route::post('login', [UserController::class, 'login'])->name('login');


Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('register', [UserController::class, 'create'])->name('register');

Route::middleware([Authenticate::class])->group(function () {
    // Route::get('calendar', [CalendarController::class, 'index']);

    // Route::get('calendar/create', [CalendarController::class, 'create']);

    // Route::get('calendar/{calendar}', [CalendarController::class, 'show']);

    // Route::controller(CalendarController::class)->group(function () {
    //     Route::get('calendars', 'index')->name('calendars.index');
    //     Route::get('calendars/create', 'create')->name('calendars.create');
    //     Route::post('calendars/create', 'store')->name('calendars.store');
    //     Route::get('calendars/{group}', 'show')->name('calendars.show');
    //     Route::get('calendars/{group}/edit', 'edit')->name('calendars.edit');
    //     Route::put('calendars/{group}', 'update')->name('calendars.update');
    //     Route::delete('calendars/{group}', 'destroy')->name('calendars.destroy');
    // });

    // Route::resource('groups', CalendarController::class)->parameters(['groups' => 'calendar'])->names('calendars');
    Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user'])->names('users');
    Route::resource('grupos', GroupController::class)->parameters(['grupos' => 'group'])->names('groups');
    Route::get('calendario/{id}', [CalendarController::class, 'index'])->name('calendar.show');
    Route::get('tareas/crear/{id}', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tareas/crear/{id}', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('groups/{userId}/{groupId}', [GroupController::class, 'deleteUser'])->name('groups.deleteUser');
    Route::delete('groups/{groupId}', [GroupController::class, 'deleteTask'])->name('groups.deleteTask');
    Route::delete('users/{userId}/{taskId}', [UserController::class, 'deleteTask'])->name('users.deleteTask');
});
