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

        // Validasi data diri
        $validated = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'pgol' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'instansi' => 'nullable|string',
            'no_hp' => 'required|numeric',
        ], [
            // Pesan error kustom untuk data diri
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
        ]);

        // Proses validasi file persyaratan sebelum menyimpan data mutasi
        if ($request->has('persyaratan')) {
            foreach ($request->persyaratan as $persyaratan_id => $file) {
                $persyaratan = Persyaratan::find($persyaratan_id); // Ambil informasi persyaratan dari database

                // Validasi file berdasarkan jenis_file dan ukuran yang ditentukan
                $fieldName = "persyaratan.{$persyaratan_id}";

                // Lakukan validasi file untuk setiap persyaratan
                $request->validate([
                    $fieldName => "file|mimes:{$persyaratan->jenis_file}|max:{$persyaratan->ukuran}",
                ], [
                    "{$fieldName}.mimes" => "{$persyaratan->nama_persyaratan} harus berupa file {$persyaratan->jenis_file}.",
                    "{$fieldName}.max" => "{$persyaratan->nama_persyaratan} tidak boleh lebih dari {$persyaratan->ukuran} kilobyte.",
                ]);
            }
        }

        // Setelah semua validasi berhasil, simpan data mutasi ke database
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
            $mutasi->no_registrasi = $this->generateRegistrationNumber();
            $mutasi->save();
        }

        // Simpan ID mutasi ke session
        $request->session()->put('mutasi_id', $mutasi->id);

        // Proses unggahan file persyaratan
        if ($request->has('persyaratan')) {
            foreach ($request->persyaratan as $persyaratan_id => $file) {
                if ($file) {
                    // Simpan file ke direktori berdasarkan id_persyaratan
                    $filePath = $file->store("uploads/mutasi/{$persyaratan_id}", 'public');

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
            return redirect()->route('mutasi')->with('success', 'Data telah disimpan, lanjutkan untuk mengunggah dokumen.');
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

        // Ambil semua persyaratan dari tabel Persyaratan (jika diperlukan untuk tampilan)
        $persyaratans = Persyaratan::all();

        // Return view edit dengan data mutasi dan persyaratan (jika ada)
        return view('mutasi.edit-mutasi', compact('mutasi', 'persyaratans'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        // Validasi data diri
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'pgol' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'unit_kerja' => 'nullable|string|max:100',
            'instansi' => 'nullable|string|max:100',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'action' => 'required|in:finish,save', // Validasi tindakan
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 15 digit.',
            'action.required' => 'Tindakan harus dipilih.',
            'action.in' => 'Tindakan yang dipilih tidak valid.',
        ]);

        // Temukan mutasi berdasarkan ID
        $mutasi = Mutasi::findOrFail($id);

        // Periksa apakah mutasi sudah dikunci
        if ($mutasi->is_final) {
            return redirect()->route('mutasi')->with('error', 'Mutasi ini sudah dikunci dan tidak dapat diedit.');
        }

        // Validasi file unggahan secara dinamis
        $persyaratanList = Persyaratan::all();
        $fileRules = [];
        $customMessages = [];

        foreach ($persyaratanList as $persyaratan) {
            $fieldName = "persyaratan.{$persyaratan->id}";

            // Tambahkan aturan validasi untuk setiap file berdasarkan persyaratan
            $fileRules[$fieldName] = [
                "file",
                "mimes:{$persyaratan->jenis_file}",
                "max:{$persyaratan->ukuran}",
            ];

            // Pesan error kustom
            $customMessages["{$fieldName}.mimes"] = "{$persyaratan->nama_persyaratan} harus berupa file {$persyaratan->jenis_file}.";
            $customMessages["{$fieldName}.max"] = "{$persyaratan->nama_persyaratan} tidak boleh lebih dari {$persyaratan->ukuran} kilobyte.";
        }

        // Validasi file unggahan
        if ($request->has('persyaratan')) {
            $request->validate($fileRules, $customMessages);
        }

        // Perbarui data mutasi
        $mutasi->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'pgol' => $request->pgol,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'instansi' => $request->instansi,
            'no_hp' => $request->no_hp,
            'is_final' => $request->action == 'finish' ? 1 : 0,
        ]);

        // Proses unggahan file persyaratan
        if ($request->has('persyaratan')) {
            foreach ($request->persyaratan as $persyaratan_id => $file) {
                $persyaratan = Persyaratan::find($persyaratan_id); // Ambil informasi persyaratan dari database

                if ($file) {
                    // Cek apakah sudah ada file sebelumnya
                    $existingUpload = UploadPersyaratan::where('mutasi_id', $mutasi->id)
                        ->where('persyaratan_id', $persyaratan_id)
                        ->first();

                    if ($existingUpload) {
                        // Hapus file lama jika ada
                        Storage::disk('public')->delete($existingUpload->file_path);
                        // Perbarui informasi file di database
                        $existingUpload->file_path = $file->store("uploads/mutasi/{$persyaratan_id}", 'public');
                        $existingUpload->save();
                    } else {
                        // Simpan file baru
                        UploadPersyaratan::create([
                            'mutasi_id' => $mutasi->id,
                            'user_id' => $user->id,
                            'persyaratan_id' => $persyaratan_id,
                            'file_path' => $file->store("uploads/mutasi/{$persyaratan_id}", 'public'),
                        ]);
                    }
                }
            }
        }

        // Tentukan langkah berikutnya berdasarkan tindakan
        if ($request->action == 'finish') {
            return redirect()->route('mutasi')->with('success', 'Pengajuan mutasi telah diperbarui dan dikunci.');
        } else {
            return redirect()->route('mutasi', $mutasi->id)->with('success', 'Data mutasi telah diperbarui.');
        }
    }

}
