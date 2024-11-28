<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;

// Rute untuk mengambil notifikasi yang tertunda (status is_wa = 0)
Route::get('/pending-notifications', [NotificationController::class, 'getPendingNotifications']);
Route::post('/update-status', [NotificationController::class, 'updateStatus']);
Route::get('/waduh', function () {
    return response()->json([
        'message' => 'Waduh, kamu mengakses rute yang salah!',
    ], 404);
});