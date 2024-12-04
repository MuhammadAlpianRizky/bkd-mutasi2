<?php

namespace App\Http\Controllers\Api;

use App\Models\NotifWa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function getPendingNotifications()
{
    // Ambil data notifikasi dengan is_wa = 0, hanya kolom Nama, no_hp, is_wa, dan message
    $pendingNotifications = NotifWa::where('is_wa', 0)
        ->select('id','nama', 'no_hp', 'is_wa', 'message','status') // Pilih kolom yang diinginkan
        ->get();

    // Kembalikan response berupa data notifikasi
    return response()->json([
        'success' => true,
        'data' => $pendingNotifications,
    ]);
}
public function updateStatus(Request $request)
{
    
    $request->validate([
        'number' => 'required|string',
        'message' => 'required|string',
        'status' => 'required|in:sent',
        'id' => 'required|integer',
    ]);

    $number = $request->number;

    if (substr($number, 0, 2) == '08') {
        $number = '+62' . substr($number, 2);
    }

    // Mencari data berdasarkan ID
    $notif = NotifWa::where('id', $request->id)->first();

    if ($notif) {
        $notif->is_wa = 1; // Ubah status menjadi 'sent'
        $notif->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Status pesan diperbarui.',
    ]);
}

}