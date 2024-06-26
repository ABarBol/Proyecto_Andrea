<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureUserIsAuthorized;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrAuth;
use App\Http\Middleware\RedirectIfAuthenticated;


/**
 * Universal Routes
 */
Route::get('/', HomeController::class)->name('home.show');


/**
 * Not found routes
 */
Route::fallback(function () {
    return redirect('/');
});


/**
 * Guest user routes
 */
Route::get('login', function () {
    return view('users.login');
})->middleware(RedirectIfAuthenticated::class);
Route::get('register', function () {
    return view('users.register');
})->middleware(RedirectIfAuthenticated::class);
Route::post('login', [UserController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);
Route::post('register', [UserController::class, 'register'])->name('register')->middleware(RedirectIfAuthenticated::class);


/**
 * Authenticat users routes
 */
Route::middleware([Authenticate::class])->group(function () {
    /**
     * Log out
     */
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    /**
     * User Routes
     */
    Route::controller(UserController::class)->group(function () {
        Route::get('usuarios', 'index')->name('users.index');
        Route::get('usuarios/{user}', 'show')->name('users.show')->middleware(EnsureUserIsAuthorized::class);
        Route::get('usuarios/{user}/edit', 'edit')->name('users.edit')->middleware(EnsureUserIsAuthorized::class);
        Route::put('usuarios/{user}', 'update')->name('users.update')->middleware(EnsureUserIsAuthorized::class);
        Route::delete('usuarios/{user}', 'destroy')->name('users.destroy')->middleware(EnsureUserIsAuthorized::class);
    });
    Route::delete('usuarios/{user}/{taskId}', [UserController::class, 'deleteTask'])->name('users.deleteTask')->middleware(EnsureUserIsAuthorized::class);
    Route::post('search/{user}', [UserController::class, 'search'])->name('users.search')->middleware(EnsureUserIsAuthorized::class);

    /**
     * Group Routes
     */
    Route::resource('grupos', GroupController::class)->parameters(['grupos' => 'group'])->names('groups')->middleware(IsAdminOrAuth::class);
    Route::delete('grupos/{user}/{groupId}/user', [GroupController::class, 'deleteUser'])->name('groups.deleteUser')->middleware(IsAdmin::class);
    Route::delete('grupos/{group}/{taskId}/task', [GroupController::class, 'deleteTask'])->name('groups.deleteTaskG')->middleware(IsAdminOrAuth::class);
    Route::get('/grupos/{group}/editUsers', [GroupController::class, 'editUsers'])->name('groups.editUsers')->middleware(IsAdmin::class);
    Route::post('/grupos/{group}/updateUsers', [GroupController::class, 'updateUsers'])->name('groups.updateUsers')->middleware(IsAdmin::class);

    /**
     * Calendar Route
     */
    Route::get('calendario/{user}', [CalendarController::class, 'index'])->name('calendar.show')->middleware(EnsureUserIsAuthorized::class);

    /**
     * Task Routes
     */
    Route::get('tareas/crear/{user}', [TaskController::class, 'create'])->name('tasks.create')->middleware(EnsureUserIsAuthorized::class);
    Route::post('tareas/crear/{user}', [TaskController::class, 'store'])->name('tasks.store')->middleware(EnsureUserIsAuthorized::class);
    Route::get('tareas/adminCrear/{group}', [TaskController::class, 'adminCreate'])->name('tasks.adminCreate')->middleware(IsAdminOrAuth::class);
    Route::post('tareas/adminCrear/{group}', [TaskController::class, 'storeGroup'])->name('tasks.storeGroup')->middleware(IsAdminOrAuth::class);
});
