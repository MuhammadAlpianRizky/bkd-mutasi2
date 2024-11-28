<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class WhatssappController extends Controller
{
    /**
     * Menampilkan halaman WhatsApp
     */
    public function wagw()
    {
        return view('whatsapp/index');  // Mengarah ke view yang sesuai
    }

   /**
     * Mengirim pesan WhatsApp via API
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function send(Request $request)
    {
        // Mendapatkan parameter dari request
        $pesan = $request->input('message');
        $number = $request->input('number');
        $file = $request->file('media'); // Mengambil file media jika ada
        $table = $request->input('table', 'users'); // Nama tabel yang diambil dari request, default 'users'

        // Nama tabel bisa berbeda-beda sesuai kebutuhan, namun tetap bisa dinamis
        // Mengambil data no_hp dari database bkd-mutasi dan tabel yang ditentukan
        $noHp = DB::table($table)->where('id', $request->input('user_id'))->value('no_hp');

        if (!$noHp) {
            return Redirect::back()->withErrors('Nomor HP tidak ditemukan');
        }

        // URL API WhatsApp Gateway di Node.js
        $apiUrl = 'http://localhost:3000/api/add-message'; // Pastikan URL ini benar

        // Menyiapkan data untuk dikirim
        $data = [
            'number' => $noHp, // Mengirimkan nomor HP dari database bkd-mutasi
            'message' => $pesan,
            'schedule' => $request->input('schedule'), // Jika ada jadwal
        ];

        // Jika ada file media yang diunggah
        if ($file) {
            $data['media'] = $file;

            // Mengirim request dengan meng-attach file media
            $response = Http::attach(
                'media', $file, $file->getClientOriginalName()
            )->post($apiUrl, $data);
        } else {
            // Jika tidak ada file media, mengirim data tanpa file
            $response = Http::post($apiUrl, $data);
        }

        // Mengecek apakah respons berhasil
        if ($response->successful()) {
            // Jika berhasil, kembali dengan pesan sukses
            return Redirect::back()->with('success', 'Pesan berhasil dikirim.');
        } else {
            // Jika gagal, kembali dengan pesan error dan respons dari API
            return Redirect::back()->withErrors('Pesan gagal dikirim. Respons: ' . $response->body());
        }
    }
}