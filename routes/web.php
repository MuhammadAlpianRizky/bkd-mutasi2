<?php

use App\Http\Controllers\UndanganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PengumumanController;

// // Route::get('/', function () {
// //     return view('welcome');
// // })->middleware('web');

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Rute autentikasi
Auth::routes();
// Rute untuk mengirimkan email reset password
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');



// Route for authenticated users - redirect based on role
Route::middleware(['auth'])->group(function () {
    // Routes for users with 'admin' role
    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('cms')->group(function () {
            Route::get('/users', [HomeController::class, 'showPendingUsers'])->name('cms.users');
            Route::get('/users/{user}/edit', [HomeController::class, 'editUser'])->name('cms.edit.user');
            Route::put('/users/{user}', [HomeController::class, 'updateUser'])->name('cms.update.user');
            Route::delete('/cms/users/pending/{user}', [HomeController::class, 'deleteUser'])->name('cms.delete.user');
            Route::delete('/cms/users/{user}', [HomeController::class, 'deleteUser2'])->name('cms.delete.user2');
            Route::get('/user/{id}', [UserController::class, 'showUserDetail'])->name('cms.user.detail');
            Route::get('/user/{id}/photo/{photoField}/{action?}', [UserController::class, 'showPhoto'])
                            ->where(['photoField' => 'photo_ktp|photo_karpeg', 'action' => 'view|download'])
                            ->name('user.photo');
            Route::get('/mutasi/invited', [UndanganController::class, 'invitedMutasi'])->name('mutasi.invited');
            Route::post('/mutasi/send-invitation', [UndanganController::class, 'sendInvitation'])->name('mutasi.sendInvitation');
            Route::post('/approve/{user}', [HomeController::class, 'approveUser'])->name('cms.approve');
            Route::post('/deactivate/{user}', [HomeController::class, 'deactivateUser'])->name('cms.deactivate');
            Route::post('/activate/{user}', [HomeController::class, 'activateUser'])->name('cms.activate');
            Route::get('/users/activate', [HomeController::class, 'showActiveUsers'])->name('cms.active.users');
            Route::get('/users/inactivate', [HomeController::class, 'showInactiveUsers'])->name('cms.inactive.users');
            Route::get('/mutasi/{id}/validate', [FileController::class, 'validate'])->name('mutasi.validate');
            Route::post('/mutasi/{id}/validate', [FileController::class, 'updateValidation'])->name('mutasi.validate.update');
            Route::get('/mutasi/list', [FileController::class, 'list'])->name('mutasi.list');
            // Route untuk membatalkan validasi
            Route::post('/mutasi/{id}/cancel', [FileController::class, 'cancel'])->name('mutasi.cancel');
            Route::get('/files/{id}/{filename}', [FileController::class, 'show'])->name('file.show');
            Route::resource('persyaratan', PersyaratanController::class);
            // Route untuk pengumuman
            Route::get('/pengumuman/index', [PengumumanController::class, 'index2'])->name('pengumuman.index');
            Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
            Route::post('/pengumuman/store', [PengumumanController::class, 'store'])->name('pengumuman.store');
            Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
            Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
            Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
            //undangan
            // Routes for Undangan
            Route::get('/undangan/create', [UndanganController::class, 'create'])->name('undangan.create');
            Route::get('undangan/{id}/{action?}', [UndanganController::class, 'show'])->name('undangan.show');
            Route::get('/undangan', [UndanganController::class, 'index'])->name('undangan.index');

            Route::post('/undangan', [UndanganController::class, 'store'])->name('undangan.store');
            Route::get('/undangan/{undangan}/edit', [UndanganController::class, 'edit'])->name('undangan.edit');
            Route::put('/undangan/{undangan}', [UndanganController::class, 'update'])->name('undangan.update');
            Route::delete('/undangan/{undangan}', [UndanganController::class, 'destroy'])->name('undangan.destroy');
            Route::get('/undangan/{id}/download', [UndanganController::class, 'download'])->name('undangan.download');
            // In your web.php or routes file
            Route::get('/mutasi/filter', [UndanganController::class, 'filterMutasi'])->name('mutasi.filter');




        });

        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    });


    // Rute untuk pengguna dengan peran 'pegawai'
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/home', [HomeController::class, 'index2'])->name('home');
        Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi');
        Route::get('/mutasi/create', [MutasiController::class, 'create'])->name('mutasi.create');
        Route::post('/mutasi/store', [MutasiController::class, 'store'])->name('mutasi.store');
        Route::get('/mutasi/{mutasi}/edit', [MutasiController::class, 'edit'])->name('mutasi.edit');
        Route::get('/mutasi/{mutasi}/file/{action?}', [UndanganController::class, 'show1'])->name('mutasi.show1');
        Route::put('/mutasi/{mutasi}', [MutasiController::class, 'update'])->name('mutasi.update');
        Route::get('/mutasi/{mutasi}/file/{filename}/{action?}', [FileController::class, 'show1'])->name('mutasi.show');

    });


    // Rute logout
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

});
