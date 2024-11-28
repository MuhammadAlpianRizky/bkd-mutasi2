<?php

namespace App\Services;

use App\Models\NotifWa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WhatsappService
{
    protected $apiUrl;

    public function __construct()
    {
        // URL endpoint untuk mengirim pesan
        $this->apiUrl = 'http://localhost:3000/api/add-message';
    }

    /**
     * Fungsi untuk mengirim pesan WhatsApp
     *
     * @param string $number Nomor telepon penerima
     * @param string $message Pesan yang akan dikirim
     * @param string|null $schedule Jadwal pengiriman pesan (opsional)
     * @param mixed $file File yang dilampirkan (opsional)
     * @return array Status pengiriman pesan
     */
    public function sendMessage(string $number, string $message, ?string $schedule = null, $file = null): array
{
    // Mengonversi nomor telepon lokal (dimulai dengan 08) ke format internasional (+62)
    if (substr($number, 0, 2) == '08') {
        $number = '+62' . substr($number, 1);
    }

    // Validasi nomor telepon (format internasional)
    if (!preg_match('/^\+?[\d\s]+$/', $number)) {
        return [
            'success' => false,
            'message' => 'Nomor telepon tidak valid.',
        ];
    }

    // Data yang akan dikirimkan ke API WhatsApp
    $data = [
        'number' => $number,
        'message' => $message,
        'schedule' => $schedule,
    ];

    try {
        // Jika ada file, kirim file bersama dengan pesan
        if ($file) {
            // Pastikan file valid sebelum dikirim
            if (!$file->isValid()) {
                return [
                    'success' => false,
                    'message' => 'File yang diupload tidak valid.',
                ];
            }

            // Kirim pesan dengan file lampiran
            $response = Http::attach(
                'media', 
                $file->getContent(), 
                $file->getClientOriginalName()
            )->post($this->apiUrl, $data);
        } else {
            // Kirim pesan tanpa file lampiran
            $response = Http::post($this->apiUrl, $data);
        }

        // Jika pengiriman pesan berhasil
        if ($response->successful()) {
            // Update status is_wa menjadi 1 di database
            \App\Models\NotifWa::where('number', $number)
                ->where('message', $message)
                ->update(['is_wa' => 1]);

            return [
                'success' => true,
                'message' => 'Pesan berhasil dikirim dan status is_wa diperbarui.',
            ];
        } else {
            // Jika gagal, tampilkan pesan kesalahan
            return [
                'success' => false,
                'message' => 'Gagal mengirim pesan: ' . $response->body(),
            ];
        }
    } catch (\Exception $e) {
        // Tangani jika terjadi error saat pengiriman pesan
        return [
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ];
    }
}
    /**
     * Mendapatkan data notif dengan is_wa = 0
     */
    // public function getPendingNotifications()
    // {
    //     $pendingNotifications = NotifWa::where('is_wa', 0)->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $pendingNotifications
    //     ]);
    // }

    /**
     * Fungsi untuk menyimpan data pesan WhatsApp yang belum terkirim
     *
     * @param string $number Nomor telepon penerima
     * @param string $message Pesan yang akan dikirim
     * @param mixed|null $file File yang dilampirkan (opsional)
     * @return array Status penyimpanan pesan
     */
//     public function saveNotification(string $number, string $message, $file = null)
// {
//     // Mengonversi nomor telepon lokal (dimulai dengan 08) ke format internasional (+62)
//     if (substr($number, 0, 2) == '08') {
//         $number = '+62' . substr($number, 1);
//     }

//     // Simpan data notif ke database dengan status is_wa = 0
//     $notif = new \App\Models\NotifWa();
//     $notif->number = $number;
//     $notif->message = $message;
//     $notif->is_wa = 0; // Status 0 berarti belum terkirim

//     if ($file) {
//         // Salin file ke direktori penyimpanan dan simpan path file di database
//         $fileName = $file->getClientOriginalName();
//         $filePath = $file->storeAs('public/files', $fileName);
//         $notif->file = $filePath;
//     }
    
//     $notif->save();

//     return [
//         'success' => true,
//         'message' => 'Pesan disimpan untuk pengiriman selanjutnya.',
//     ];
// }

    /**
     * Fungsi untuk mengirim pesan yang tertunda (status is_wa = 0) setelah Node.js server aktif
     *
     * @param array $pendingNotifs Data notifikasi yang tertunda
     * @return void
     */
    public function sendPendingMessages()
{
    // Ambil data notifikasi dengan status is_wa = 0 (belum terkirim)
    $pendingNotifs = \App\Models\NotifWa::where('is_wa', 0)->get();

    foreach ($pendingNotifs as $notif) {
        // Cek pengiriman pesan setiap 5 detik
        $maxRetries = 10; // Maksimum percobaan
        $attempts = 0;
        $success = false;

        while ($attempts < $maxRetries && !$success) {
            try {
                // Kirim pesan melalui WhatsApp API
                $response = $this->sendMessage(
                    $notif->number, 
                    $notif->message, 
                    null, 
                    $notif->file ? Storage::path('files/'.$notif->file) : null
                );

                // Jika pengiriman berhasil, ubah status is_wa menjadi 1
                if ($response['success']) {
                    $notif->is_wa = 1;
                    $notif->save();
                    $success = true;
                }
            } catch (\Exception $e) {
                // Jika ada error, increment attempts dan coba lagi
                $attempts++;
                sleep(5); // Tunggu 5 detik sebelum mencoba lagi
            }
        }

        // Jika pengiriman pesan gagal setelah beberapa kali percobaan, simpan log error atau beri notifikasi
        if (!$success) {
            \Log::error("Gagal mengirim pesan untuk nomor: {$notif->number}. Error: {$e->getMessage()}");
        }
    }
}
}