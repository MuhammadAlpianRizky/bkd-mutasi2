<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;
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

        return view('mutasi.create-mutasi', compact('user'));
    }

    protected function handleFileUpload($request, $mutasi, $field, $directory)
    {
        if ($request->hasFile($field)) {
            // Hapus file lama jika ada
            if ($mutasi->$field) {
                $oldFilePath = $mutasi->$field;  // Path relatif yang disimpan di database
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }

            // Simpan file baru ke storage 'public'
            $file = $request->file($field);
            $filePath = $file->store($directory, 'public'); // Simpan file ke storage yang benar

            // Simpan path relatif di database
            $mutasi->update([$field => $filePath]);
        }
    }

    public function store(Request $request)
    {
        // Validasi data dengan pesan error kustom
        $validated = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'pgol' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'instansi' => 'nullable|string',
            'no_hp' => 'required|numeric',
            'sk_cpns' => 'nullable|file|mimes:pdf|max:500',
            'sk_pns' => 'nullable|file|mimes:pdf|max:500',
            'sk_pangkat_terakhir' => 'nullable|file|mimes:pdf|max:500',
            'sk_jabatan_struktural' => 'nullable|file|mimes:pdf|max:500',
            'sk_jabatan_fungsional' => 'nullable|file|mimes:pdf|max:500',
            'sk_berkala_terakhir' => 'nullable|file|mimes:pdf|max:500',
        ], [
            // Pesan error kustom dalam bahasa Indonesia
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'sk_cpns.mimes' => 'SK CPNS harus berupa file PDF.',
            'sk_cpns.max' => 'File SK CPNS tidak boleh lebih dari 500 kilobyte.',
            'sk_pns.mimes' => 'SK PNS harus berupa file PDF.',
            'sk_pns.max' => 'File SK PNS tidak boleh lebih dari 500 kilobyte.',
            'sk_pangkat_terakhir.mimes' => 'SK Pangkat Terakhir harus berupa file PDF.',
            'sk_pangkat_terakhir.max' => 'File SK Pangkat Terakhir tidak boleh lebih dari 500 kilobyte.',
            'sk_jabatan_struktural.mimes' => 'SK Jabatan Struktural harus berupa file PDF.',
            'sk_jabatan_struktural.max' => 'File SK Jabatan Struktural tidak boleh lebih dari 500 kilobyte.',
            'sk_jabatan_fungsional.mimes' => 'SK Jabatan Fungsional harus berupa file PDF.',
            'sk_jabatan_fungsional.max' => 'File SK Jabatan Fungsional tidak boleh lebih dari 500 kilobyte.',
            'sk_berkala_terakhir.mimes' => 'SK Berkala Terakhir harus berupa file PDF.',
            'sk_berkala_terakhir.max' => 'File SK Berkala Terakhir tidak boleh lebih dari 500 kilobyte.',
        ]);

        // Ambil ID mutasi dari session
        $mutasiId = session('mutasi_id');
        $mutasi = Mutasi::find($mutasiId);

        if (!$mutasi) {
            // Generate nomor registrasi jika mutasi tidak ditemukan
            $registrationNumber = $this->generateRegistrationNumber();

            // Buat mutasi baru
            $mutasi = Mutasi::create([
                'no_registrasi' => $registrationNumber,
                'user_id' => auth()->id(),
                'nama' => $request->nama,
                'nip' => $request->nip,
                'pgol' => $request->pgol,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
                'no_hp' => $request->no_hp,
                'status' => 'draft',
            ]);

            // Simpan ID mutasi ke session
            $request->session()->put('mutasi_id', $mutasi->id);
        } else {
            // Update mutasi yang sudah ada
            $mutasi->update($validated);
        }

        // Proses upload file
        $this->handleFileUpload($request, $mutasi, 'sk_cpns', 'uploads/sk_cpns');
        $this->handleFileUpload($request, $mutasi, 'sk_pns', 'uploads/sk_pns');
        $this->handleFileUpload($request, $mutasi, 'sk_pangkat_terakhir', 'uploads/sk_pangkat_terakhir');
        $this->handleFileUpload($request, $mutasi, 'sk_jabatan_struktural', 'uploads/sk_jabatan_struktural');
        $this->handleFileUpload($request, $mutasi, 'sk_jabatan_fungsional', 'uploads/sk_jabatan_fungsional');
        $this->handleFileUpload($request, $mutasi, 'sk_berkala_terakhir', 'uploads/sk_berkala_terakhir');

        if ($request->input('action') === 'finish') {
            $mutasi->update([
                'is_final' => 1,
                'status' => 'proses',
            ]);

            return redirect()->route('mutasi')->with('status', 'Mutasi diperbarui dan dikunci.');
        }

        return redirect()->route('mutasi')->with('status', 'Data disimpan. Anda dapat melanjutkan pengisian.');
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

    public function update(Request $request, $id)
    {
        // Validasi data dengan pesan error kustom
        $validated = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'pgol' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'instansi' => 'nullable|string',
            'no_hp' => 'required|numeric',
            'sk_cpns' => 'nullable|file|mimes:pdf|max:500',
            'sk_pns' => 'nullable|file|mimes:pdf|max:500',
            'sk_pangkat_terakhir' => 'nullable|file|mimes:pdf|max:500',
            'sk_jabatan_struktural' => 'nullable|file|mimes:pdf|max:500',
            'sk_jabatan_fungsional' => 'nullable|file|mimes:pdf|max:500',
            'sk_berkala_terakhir' => 'nullable|file|mimes:pdf|max:500',
        ], [
            // Pesan error kustom dalam bahasa Indonesia
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'sk_cpns.mimes' => 'SK CPNS harus berupa file PDF.',
            'sk_cpns.max' => 'File SK CPNS tidak boleh lebih dari 500 kilobyte.',
            'sk_pns.mimes' => 'SK PNS harus berupa file PDF.',
            'sk_pns.max' => 'File SK PNS tidak boleh lebih dari 500 kilobyte.',
            'sk_pangkat_terakhir.mimes' => 'SK Pangkat Terakhir harus berupa file PDF.',
            'sk_pangkat_terakhir.max' => 'File SK Pangkat Terakhir tidak boleh lebih dari 500 kilobyte.',
            'sk_jabatan_struktural.mimes' => 'SK Jabatan Struktural harus berupa file PDF.',
            'sk_jabatan_struktural.max' => 'File SK Jabatan Struktural tidak boleh lebih dari 500 kilobyte.',
            'sk_jabatan_fungsional.mimes' => 'SK Jabatan Fungsional harus berupa file PDF.',
            'sk_jabatan_fungsional.max' => 'File SK Jabatan Fungsional tidak boleh lebih dari 500 kilobyte.',
            'sk_berkala_terakhir.mimes' => 'SK Berkala Terakhir harus berupa file PDF.',
            'sk_berkala_terakhir.max' => 'File SK Berkala Terakhir tidak boleh lebih dari 500 kilobyte.',
        ]);

        $mutasi = Mutasi::findOrFail($id);

        if ($mutasi->is_final) {
            return redirect()->route('mutasi')->with('error', 'Mutasi ini sudah dikunci dan tidak dapat diedit.');
        }

        // Update data mutasi
        $mutasi->update([
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'pgol' => $validated['pgol'],
            'jabatan' => $validated['jabatan'],
            'unit_kerja' => $validated['unit_kerja'],
            'instansi' => $validated['instansi'],
            'no_hp' => $validated['no_hp'],
        ]);

        // Proses upload file
        $this->handleFileUpload($request, $mutasi, 'sk_cpns', 'uploads/sk_cpns');
        $this->handleFileUpload($request, $mutasi, 'sk_pns', 'uploads/sk_pns');
        $this->handleFileUpload($request, $mutasi, 'sk_pangkat_terakhir', 'uploads/sk_pangkat_terakhir');
        $this->handleFileUpload($request, $mutasi, 'sk_jabatan_struktural', 'uploads/sk_jabatan_struktural');
        $this->handleFileUpload($request, $mutasi, 'sk_jabatan_fungsional', 'uploads/sk_jabatan_fungsional');
        $this->handleFileUpload($request, $mutasi, 'sk_berkala_terakhir', 'uploads/sk_berkala_terakhir');

        if ($request->input('action') === 'finish') {
            // Update is_final menjadi 1
            $mutasi->update([
                'is_final' => 1,
                'status' => 'proses',
            ]);
            return redirect()->route('mutasi')->with('status', 'Mutasi diperbarui dan dikunci.');
        }

        return redirect()->route('mutasi')->with('status', 'Data mutasi berhasil diperbarui.');
    }

}
