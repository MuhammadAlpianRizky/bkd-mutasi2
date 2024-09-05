<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LandingPageController;

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('web');

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute autentikasi
Auth::routes();
// Rute untuk mengirimkan email reset password
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Rute untuk pengguna dengan peran 'admin'
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('cms')->group(function () {
        Route::get('/users', [HomeController::class, 'showPendingUsers'])->name('cms.users');
        Route::get('/user/{id}', [UserController::class, 'showUserDetail'])->name('cms.user.detail');
        Route::post('/approve/{user}', [HomeController::class, 'approveUser'])->name('cms.approve');
        Route::post('/deactivate/{user}', [HomeController::class, 'deactivateUser'])->name('cms.deactivate');
        Route::post('/activate/{user}', [HomeController::class, 'activateUser'])->name('cms.activate');
        Route::get('/users/activate', [HomeController::class, 'showActiveUsers'])->name('cms.active.users');
        Route::get('/users/inactivate', [HomeController::class, 'showInactiveUsers'])->name('cms.inactive.users');
    });

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});



// Rute untuk pengguna dengan peran 'pegawai'
Route::middleware(['auth', 'role:pegawai'])->get('/home', [HomeController::class, 'index2'])
    ->name('home');

// Rute logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
