<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/login', 'auth/login');
// Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@do']);

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'auth/login'])->name('login');
Route::get('/logados', [AuthController::class, 'logados'])->name('logados');

Route::view('/register', 'auth/register');
Route::post('register', [ 'as' => 'register', 'uses' => 'RegisterController@do']);

Route::view('/verify', 'auth/verify');
Route::post('verification.resend', [ 'as' => 'verification.resend', 'uses' => 'VerificationController@do']);

