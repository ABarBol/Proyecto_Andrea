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

Route::controller(CalendarController::class)->group(function () {
    Route::get('calendar', 'index');
    Route::get('calendar/create', 'create');
    Route::get('calendar/{calendar}', 'show');
});
