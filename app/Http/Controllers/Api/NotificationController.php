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
        ->select('nama', 'no_hp', 'is_wa', 'message','status') // Pilih kolom yang diinginkan
        ->get();

    // Kembalikan response berupa data notifikasi
    return response()->json([
        'success' => true,
        'data' => $pendingNotifications,
    ]);
}
public function updateStatus(Request $request)
    {
        
        // Validasi data
        $request->validate([
            'number' => 'required|string',
            'message' => 'required|string',
            'status' => 'required|in:sent',
        ]);

        // Mengubah nomor telepon ke format internasional (misalnya +62)
    $number = $request->number;

    // Jika nomor mulai dengan '08', ubah menjadi '+62'
    if (substr($number, 0, 2) == '08') {
        $number = '+62' . substr($number, 2);
    }

    // Perbarui status is_wa menjadi 1 jika sudah terkirim
    $notif = NotifWa::where('no_hp', $number) // Gunakan nomor yang sudah diformat
                    ->where('message', $request->message)
                    ->first();

    if ($notif) {
        $notif->is_wa = 1; // Mengubah status menjadi 1 (sent)
        $notif->save();
    }

    return response()->json([
        'success' => true,
        'message' => 'Status pesan diperbarui.',
    ]);
    }
}