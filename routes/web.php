<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeController::class);

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

Route::resource('pitos', CalendarController::class)->names('calendars');