<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\UploadPersyaratan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MutasiController extends Controller
{
    public function index()
    {
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
            return redirect()->route('mutasi')->with('error', 'Anda masih memiliki mutasi yang belum diverifikasi.');
        }

        // Simpan ID mutasi ke session
        $request->session()->put('mutasi_id', null);

        // Ambil data persyaratan untuk membuat form upload dinamis
        $persyaratans = Persyaratan::all();

        return view('mutasi.create-mutasi', compact('user', 'persyaratans'));
    }

    public function store(Request $request)
{
    $user = auth()->user();

    // Validasi data diri dan file persyaratan
    $validated = $request->validate([
        'nama' => 'required|string',
        'nip' => 'required|numeric',
        'pgol' => 'nullable|string',
        'jabatan' => 'nullable|string',
        'unit_kerja' => 'nullable|string',
        'instansi' => 'nullable|string',
        'no_hp' => 'required|numeric',
        'persyaratan.*' => 'nullable|file|mimes:pdf|max:500', // Validasi untuk file persyaratan
    ], [
        // Pesan error kustom
        'nama.required' => 'Nama lengkap wajib diisi.',
        'nip.required' => 'NIP wajib diisi.',
        'nip.numeric' => 'NIP harus berupa angka.',
        'no_hp.required' => 'Nomor HP harus diisi.',
        'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        'persyaratan.*.file' => 'File yang diunggah harus berupa file yang valid.',
        'persyaratan.*.mimes' => 'File yang diunggah harus berupa PDF.',
        'persyaratan.*.max' => 'Ukuran file tidak boleh lebih dari 500 KB.',
    ]);

    // Proses penyimpanan data mutasi ke database
    $mutasi = Mutasi::create([
        'user_id' => $user->id,
        'nama' => $request->nama,
        'nip' => $request->nip,
        'pgol' => $request->pgol,
        'jabatan' => $request->jabatan,
        'unit_kerja' => $request->unit_kerja,
        'instansi' => $request->instansi,
        'no_hp' => $request->no_hp,
        'is_final' => $request->action == 'finish' ? 1 : 0,
        'verified' => 0,
    ]);

    // Simpan nomor registrasi menggunakan fungsi generateRegistrationNumber
    if ($mutasi->no_registrasi == null) {
        $mutasi->no_registrasi = $this->generateRegistrationNumber(); // Panggil fungsi generateRegistrationNumber
        $mutasi->save();
    }

    // Simpan ID mutasi ke session
    $request->session()->put('mutasi_id', $mutasi->id);

    // Proses unggahan file persyaratan
    if ($request->has('persyaratan')) {
        foreach ($request->persyaratan as $persyaratan_id => $file) {
            if ($file) {
                // Simpan file ke direktori
                $filePath = $file->store('uploads/mutasi', 'public');

                // Simpan informasi upload ke tabel upload persyaratan
                UploadPersyaratan::create([
                    'mutasi_id' => $mutasi->id,
                    'user_id' => $user->id,
                    'persyaratan_id' => $persyaratan_id,
                    'file_path' => $filePath,
                ]);
            }
        }
    }

    // Tentukan langkah berikutnya berdasarkan tindakan
    if ($request->action == 'finish') {
        return redirect()->route('mutasi')->with('success', 'Pengajuan mutasi telah berhasil dikirim.');
    } else {
        return redirect()->route('mutasi.create')->with('success', 'Data telah disimpan, lanjutkan untuk mengunggah dokumen.');
    }
}


    private function generateRegistrationNumber()
    {
        // Set timezone ke WITA (Waktu Indonesia Tengah)
        $timezone = 'Asia/Makassar';
        $date = now()->setTimezone($timezone);

        // Ambil tanggal saat ini dalam format YYYYMMDD
        $datePrefix = $date->format('Ymd');

        // Ambil nomor registrasi terbaru untuk menentukan nomor berikutnya
        $latestMutasi = Mutasi::whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->first();

        // Tentukan nomor berikutnya
        $nextNumber = 1;
        if ($latestMutasi) {
            $lastNumber = intval(substr($latestMutasi->no_registrasi, -4)); // Sesuaikan dengan kolom di database
            $nextNumber = $lastNumber + 1;
        }

        // Format nomor menjadi 4 digit
        $numberSuffix = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Gabungkan prefix dan suffix
        return $datePrefix . $numberSuffix;
    }

    public function edit($id)
    {
        $mutasi = Mutasi::findOrFail($id);

        // Periksa apakah mutasi sudah dikunci
        if ($mutasi->is_final) {
            return redirect()->route('mutasi')->with('error', 'Mutasi ini sudah dikunci dan tidak dapat diedit.');
        }

        return view('mutasi.edit-mutasi', compact('mutasi'));
    }

}
