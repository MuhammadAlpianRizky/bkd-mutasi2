<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index(){
        $user = auth()->user();
        $mutasi = Mutasi::where('user_id', $user->id)->get();

        return view('mutasi.index', compact('mutasi'));
    }
    public function create(Request $request)
    {
        $user = auth()->user();

        // Cek apakah ada mutasi yang belum diverifikasi
        $existingMutasi = Mutasi::where('verified', false)
            ->where('user_id', $user->id)
            ->first();

        if ($existingMutasi) {
            return redirect()->route('mutasi')->with('alert', 'Anda masih memiliki mutasi yang belum diverifikasi.');
        }

        // Generate nomor registrasi
        $registrationNumber = $this->generateRegistrationNumber();

        // Create new mutasi entry with registration number
        $mutasi = Mutasi::create([
            'no_registrasi' => $registrationNumber, // Pastikan nama kolom sesuai dengan database
            'user_id' => $user->id,
        ]);

        // Simpan ID mutasi ke session
        $request->session()->put('mutasi_id', $mutasi->id);

        return view('users.form-mutasi', compact('registrationNumber', 'user'));
    }

    private function generateRegistrationNumber()
    {
        // Get the current date in YYYYMMDD format
        $datePrefix = now()->format('Ymd');

        // Get the latest registration number to determine the next number
        $latestMutasi = Mutasi::whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->first();

        // Determine the next number
        $nextNumber = 1;
        if ($latestMutasi) {
            $lastNumber = intval(substr($latestMutasi->no_registrasi, -4)); // Sesuaikan dengan kolom di database
            $nextNumber = $lastNumber + 1;
        }

        // Format the number to 4 digits
        $numberSuffix = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Combine prefix and suffix
        return  $datePrefix . $numberSuffix;
    }
}
