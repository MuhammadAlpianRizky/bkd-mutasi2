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

        return view('users.form-mutasi', compact('user'));
    }

    public function store (Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string',
            'nip' => 'required|numeric',
            'pgol' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'instansi' => 'nullable|string',
            'no_hp' => 'numeric',
            'sk_cpns' => 'nullable|file|mimes:pdf|max:500',
            'sk_pns' => 'nullable|file|mimes:pdf|max:500',
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
            ]);

            // Simpan ID mutasi ke session
            $request->session()->put('mutasi_id', $mutasi->id);
        } else {
            // Update mutasi yang sudah ada
            $mutasi->update($validated);
        }

        // Proses upload file
        if ($request->hasFile('sk_cpns')) {
            $file = $request->file('sk_cpns');
            $filePath = $file->store('uploads/sk_cpns', 'public');
            $mutasi->update(['sk_cpns' => $filePath]);
        }

        if ($request->hasFile('sk_pns')) {
            $file = $request->file('sk_pns');
            $filePath = $file->store('uploads/sk_pns', 'public');
            $mutasi->update(['sk_pns' => $filePath]);
        }

        if ($request->input('action') === 'save') {
            return redirect()->route('mutasi')->with('status', 'Data disimpan. Anda dapat melanjutkan pengisian.');
        } elseif ($request->input('action') === 'finish') {
            // Update is_final menjadi 1
            $mutasi->update(['is_final' => 1]);
            return redirect()->route('mutasi');
        }
    }

    private function generateRegistrationNumber()
    {
        // Ambil tanggal saat ini dalam format YYYYMMDD
        $datePrefix = now()->format('Ymd');

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
    // Validasi data
    $validated = $request->validate([
        'nama' => 'required|string',
        'nip' => 'required|numeric',
        'pgol' => 'nullable|string',
        'jabatan' => 'nullable|string',
        'unit_kerja' => 'nullable|string',
        'instansi' => 'nullable|string',
        'no_hp' => 'numeric',
        'sk_cpns' => 'nullable|file|mimes:pdf|max:500',
        'sk_pns' => 'nullable|file|mimes:pdf|max:500',
    ]);

    // Temukan mutasi berdasarkan ID
    $mutasi = Mutasi::findOrFail($id);

    // Periksa apakah mutasi sudah dikunci
    if ($mutasi->is_final) {
        return redirect()->route('mutasi')->with('error', 'Mutasi ini sudah dikunci dan tidak dapat diedit.');
    }

    // Update data mutasi tanpa file
    $mutasi->update([
        'nama' => $request->nama,
        'nip' => $request->nip,
        'pgol' => $request->pgol,
        'jabatan' => $request->jabatan,
        'unit_kerja' => $request->unit_kerja,
        'instansi' => $request->instansi,
        'no_hp' => $request->no_hp,
    ]);

    // Proses upload file sk_cpns jika ada
    if ($request->hasFile('sk_cpns')) {
        // Hapus file lama jika ada
        if ($mutasi->sk_cpns) {
            Storage::disk('public')->delete($mutasi->sk_cpns);
        }
        // Simpan file baru
        $file = $request->file('sk_cpns');
        $filePath = $file->store('uploads/sk_cpns', 'public');
        $mutasi->update(['sk_cpns' => $filePath]);
    }

    // Proses upload file sk_pns jika ada
    if ($request->hasFile('sk_pns')) {
        // Hapus file lama jika ada
        if ($mutasi->sk_pns) {
            Storage::disk('public')->delete($mutasi->sk_pns);
        }
        // Simpan file baru
        $file = $request->file('sk_pns');
        $filePath = $file->store('uploads/sk_pns', 'public');
        $mutasi->update(['sk_pns' => $filePath]);
    }

    // Periksa apakah tombol 'Finish' diklik
    if ($request->input('action') === 'finish') {
        $mutasi->update(['status' => 'completed', 'is_final' => 1]);
        return redirect()->route('mutasi')->with('status', 'Mutasi diperbarui dan dikunci.');
    }

    return redirect()->route('mutasi')->with('status', 'Mutasi berhasil diperbarui.');
}


}
