<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Rute untuk pengguna dengan peran 'pegawai'
Route::middleware(['auth', 'role:pegawai'])->get('/home', [HomeController::class, 'index'])
    ->name('home');

// Rute untuk pengguna dengan peran 'admin'
Route::middleware(['auth', 'role:admin'])->get('/dashboard', [HomeController::class, 'index'])
    ->name('dashboard');

// Rute logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
