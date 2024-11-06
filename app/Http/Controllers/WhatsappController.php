<?php

namespace App\Http\Controllers;
use App\Models\NotifWhatsapp;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index()
    {
        $notif = NotifWhatsapp::where('is_sent', false)->first();
        $status = null;

        if ($notif) {
            $success = $this->sendWhatsAppMessage($notif->no_hp, $notif->message);

            if ($success) {
                $notif->is_sent = true;
                $notif->save();
                $status = 'Pesan berhasil terkirim';
            } else {
                $status = 'Gagal mengirim pesan';
            }
        } else {
            $status = 'Tidak ada pesan untuk dikirim';
        }

        // Refresh halaman setiap 1-2 menit
        return view('whatsapp.index', compact('notif', 'status'));
    }

    private function sendWhatsAppMessage($phoneNumber, $message)
    {
        try {
        // Format nomor HP untuk WhatsApp
        $formattedNumber = '62' . substr($phoneNumber, 1); // Pastikan formatnya benar

        // Kirim pesan ke aplikasi Node.js menggunakan HTTP
        $url = 'http://localhost:3000/send-message'; // Ubah URL sesuai dengan endpoint di aplikasi Node.js

        // Mengirim request POST ke aplikasi Node.js
        $response = \Http::post($url, [
            'number' => $formattedNumber,
            'message' => $message,
        ]);

        if ($response->successful()) {
            return true;
        } else {
            return false;
        }
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim pesan Whatsapp: ' . $e->getMessage());
            return false;
        }
    }
}
