<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute autentikasi
Auth::routes();

// Rute untuk pengguna dengan peran 'admin'
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');
    Route::get('/cms/users', [HomeController::class, 'showPendingUsers'])
        ->name('cms.users');
    Route::post('/cms/approve/{user}', [HomeController::class, 'approveUser'])
        ->name('cms.approve');
        Route::get('/cms/user/{id}', [UserController::class, 'showUserDetail'])
        ->name('cms.user.detail');
});

// Rute untuk pengguna dengan peran 'pegawai'
Route::middleware(['auth', 'role:pegawai'])->get('/home', [HomeController::class, 'index2'])
    ->name('home');

// Rute logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
