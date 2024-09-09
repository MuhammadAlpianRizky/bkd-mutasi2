<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PegawaiController;

// // Route::get('/', function () {
// //     return view('welcome');
// // })->middleware('web');

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute autentikasi
Auth::routes();
// Rute untuk mengirimkan email reset password
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

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
        Route::post('/cms/deactivate/{user}', [HomeController::class, 'deactivateUser'])->name('cms.deactivate');
        Route::post('/cms/activate/{user}', [HomeController::class, 'activateUser'])->name('cms.activate');
        Route::get('/cms/users/activate', [HomeController::class, 'showActiveUsers'])
        ->name('cms.active.users');
        Route::get('/cms/users/inactivate', [HomeController::class, 'showInactiveUsers'])
        ->name('cms.inactive.users');
    });


// Rute untuk pengguna dengan peran 'pegawai'
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/home', [HomeController::class, 'index2'])
    ->name('home');
    Route::get('/mutasi', [MutasiController::class, 'index'])
    ->name('mutasi');
    Route::get('/mutasi/create', [MutasiController::class, 'create'])
    ->name('mutasi.create');
    Route::post('/mutasi/store', [MutasiController::class, 'store'])->name('mutasi.store');
    Route::get('mutasi/{id}/edit', [MutasiController::class, 'edit'])->name('mutasi.edit');
    Route::put('mutasi/{id}', [MutasiController::class, 'update'])->name('mutasi.update');
});

// Rute logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
