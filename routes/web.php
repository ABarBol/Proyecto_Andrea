<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeController::class)->name('home.show');

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
Route::resource('grupos', GroupController::class)->parameters(['grupos' => 'group'])->names('groups');

Route::get('calendario/{user}', [CalendarController::class, 'index'])->name('calendar.show');
Route::get('tareas/crear/{id}', [TaskController::class, 'create'])->name('tasks.create');
Route::post('tareas/crear/{id}', [TaskController::class, 'store'])->name('tasks.store');

