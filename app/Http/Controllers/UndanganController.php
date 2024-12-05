<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Undangan;
use Illuminate\Http\Request;
use App\Models\NotifWhatsapp;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUndanganRequest;
use App\Http\Requests\UpdateUndanganRequest;

class UndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all Undangan records
        $undangan = Undangan::with('mutasi')->get();
        return view('undangan.index', compact('undangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    // Ambil bulan yang dipilih dari request
    $selectedMonth = $request->input('selected_month');

    if ($selectedMonth) {
        // Ambil bulan dan tahun dari selected_month
        $month = \Carbon\Carbon::parse($selectedMonth)->month;
        $year = \Carbon\Carbon::parse($selectedMonth)->year;

        // Filter data berdasarkan bulan dan tahun
        $mutasi = Mutasi::where('is_final', 1)
                        ->where('verified', 1)
                        ->where('status', 'diterima')
                        ->whereNull('undangan_id')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->get();
    } else {
        // Jika tidak ada bulan yang dipilih, ambil semua data mutasi
        $mutasi = Mutasi::where('is_final', 1)
                        ->where('verified', 1)
                        ->whereNull('undangan_id')
                        ->get();
    }

    // Cek apakah tidak ada data mutasi
    $errorMessage = $mutasi->isEmpty() ? 'Tidak ditemukan data mutasi tersebut.' : null;

    return view('undangan.create', compact('mutasi', 'errorMessage', 'selectedMonth'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'mutasi_ids' => 'required|array', // Izinkan multiple mutasi_ids
        'mutasi_ids.*' => 'exists:mutasi,id', // Pastikan mutasi_id ada di database
        'file' => 'required|file|mimes:pdf|max:2048', // Maksimal 2MB untuk file PDF
    ]);

    // Menangani file yang di-upload
    if ($request->hasFile('file')) {
        // Menghasilkan kode dasar undangan menggunakan tanggal hari ini
        $kode_base = now()->format('Ymd');

        // Ambil urutan terakhir file yang sudah di-upload dalam folder ini
        // Cek file yang sudah diupload sebelumnya dalam folder yang sama, jika ada
        $files = Storage::files('public/undangan');

        // Filter file berdasarkan prefix tanggal hari ini (misalnya: 20241111)
        $filteredFiles = array_filter($files, function ($file) use ($kode_base) {
            return strpos($file, $kode_base) !== false;
        });

        // Tentukan nomor urut berdasarkan file yang sudah ada
        // Nomor urut dimulai dari 1 jika tidak ada file, jika ada file sebelumnya urutannya akan ditambah 1
        $nextFileNumber = count($filteredFiles) + 1; // Nomor urut dimulai dari 1

        // Membuat kode_undangan yang unik berdasarkan urutan
        $kode_undangan = $kode_base . '-' . $nextFileNumber;

        // Menyimpan file yang di-upload dengan nama unik sesuai dengan urutan
        $filePath = $request->file('file')->storeAs('public/undangan', $kode_undangan . '.pdf');

        // Menyimpan record Undangan untuk setiap mutasi_id yang dipilih
        foreach ($request->mutasi_ids as $mutasi_id) {
            $undangan = Undangan::create([
                'mutasi_id' => $mutasi_id,
                'kode_undangan' => $kode_undangan,
                'file' => $filePath,
                'user_id' => auth()->id(), // Menyimpan ID pengguna yang sedang login
            ]);

            // Memperbarui record Mutasi dengan undangan_id baru
            $mutasi = Mutasi::find($mutasi_id);
            $mutasi->undangan_id = $undangan->id;
            $mutasi->save();

            // Logic untuk mengirim undangan
            $this->sendInvitationForMutasi($mutasi_id);
        }

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil ditambahkan.');
    }

    return redirect()->route('undangan.create')->with('error', 'Gagal menambahkan undangan.');
}

    protected function sendInvitationForMutasi($mutasi_id)
    {
        $mutasi = Mutasi::findOrFail($mutasi_id);
            // Buat entri notifikasi baru di tabel
            NotifWhatsapp::create([
                'no_hp' => $mutasi->no_hp,
                'message' => "*BADAN KEPEGAWAIAN DAERAH DIKLAT KOTA BANJARMASIN*\n" .
                        "https://asn.banjarmasinkota.go.id/bkd-mutasi\n\n" .
                        "Nama: {$mutasi->nama}\n" .
                        "NIP: {$mutasi->nip}\n" .
                        "No. Registrasi: {$mutasi->no_registrasi}\n" .
                        "Anda terpilih untuk mengikuti seleksi mutasi masuk. Harap login untuk melihat undangan. \n\n" .
                        "Demikian disampaikan, Terima kasih\n\n" .
                        "_Mohon untuk tidak mengubungi/membalas Whatsapp ini_",
                'is_sent' => false,
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $action = 'view')
    {
        // Temukan undangan berdasarkan ID
        $undangan = Undangan::findOrFail($id);

        // Dapatkan nama file dari query string (jika ada)
        $fileName = request()->query('filename');
        $filePath = 'undangan/' . $fileName; // Sesuaikan ini jika struktur folder berbeda

        // Cek jika file ada
        if ($fileName && !Storage::disk('public')->exists($filePath)) {
            return redirect()->route('undangan.index')->with('error', 'File tidak ditemukan.');
        }

        // Jika aksinya adalah 'download', kembalikan file sebagai respons download
        if ($action === 'download') {
            return Storage::download($filePath);
        }

        // Kembalikan file dalam browser jika aksinya 'view'
        if ($action === 'view') {
            return response()->file(Storage::disk('public')->path($filePath), [
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
            ]);
        }

        return redirect()->route('undangan.index')->with('error', 'Aksi tidak valid.');
    }
    public function show1(Mutasi $mutasi, $action = 'view')
{
    // Ambil record undangan terkait dengan mutasi
    $undangan = $mutasi->undangan; // Akan mengakses model Undangan yang terkait

    // Cek apakah undangan ada dan memiliki file
    if (!$undangan || !$undangan->file) {
        return redirect()->route('mutasi')->with('error', 'File tidak ditemukan.');
    }

    // Dapatkan nama file dari undangan
    $fileName = basename($undangan->file);
    $filePath = 'undangan/' . $fileName; // Path file di dalam folder 'undangan' di storage

    // Cek jika file ada di disk 'public'
    if (!Storage::disk('public')->exists($filePath)) {
        return redirect()->route('mutasi')->with('error', 'File tidak ditemukan.');
    }


    // Kembalikan file dalam browser jika aksinya 'view'
    if ($action === 'view') {
        return response()->file(Storage::disk('public')->path($filePath), [
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }

    return redirect()->route('mutasi')->with('error', 'Aksi tidak valid.');
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Undangan $undangan)
    {
        // Fetch all Mutasi records for the edit form
        $mutasi = Mutasi::all();
        return view('undangan.edit', compact('undangan', 'mutasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUndanganRequest $request, Undangan $undangan)
    {
        $request->validate([
            'mutasi_id' => 'required|exists:mutasi,id',
            'file' => 'nullable|file|mimes:pdf|max:2048', // Max size 2MB
        ]);

        // Update the Undangan record
        $undangan->mutasi_id = $request->mutasi_id;

        // Handle file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($undangan->file) {
                Storage::delete($undangan->file);
            }

            $filePath = $request->file('file')->storeAs('undangan', now()->day . '.pdf');
            $undangan->file = $filePath;
        }

        $undangan->save();

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Undangan $undangan)
    {
        // Delete the file if it exists
        if ($undangan->file) {
            Storage::delete($undangan->file);
        }

        // Delete the Undangan record
        $undangan->delete();

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil dihapus.');
    }

    public function invitedMutasi()
    {
        $mutasi = Mutasi::where('is_final', 1)
                        ->where('verified', 1)
                        ->where('status', 'diterima')
                        ->get();

        return view('mutasi.invited', compact('mutasi'));
    }

    /**
     * Download the specified Undangan file.
     */
    public function download($id)
    {
        $undangan = Undangan::findOrFail($id);

        // Check if file exists
        if (Storage::exists($undangan->file)) {
            return Storage::download($undangan->file);
        }

        return redirect()->route('undangan.index')->with('error', 'File tidak ditemukan.');
    }

    public function filterMutasi(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        if ($selectedDate) {
            // Filter Mutasi records based on creation date and additional criteria
            $mutasi = Mutasi::whereDate('created_at', $selectedDate)
                            ->where('is_final', 1)
                            ->where('verified', 1)
                            ->where('status', 'diterima')
                            ->get();

            return response()->json($mutasi);
        }

        return response()->json([]);
    }
}
