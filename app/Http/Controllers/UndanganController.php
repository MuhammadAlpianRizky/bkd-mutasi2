<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\NotifWa;
use App\Models\Undangan;
use Illuminate\Http\Request;
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
        // Get the selected date from the request
        $selectedDate = $request->input('selected_date');

        // Fetch mutasi records based on the selected date if provided
        if ($selectedDate) {
            $mutasi = Mutasi::where('is_final', 1)
                            ->where('verified', 1)
                            ->where('status','diterima')
                            ->whereNull('undangan_id')
                            ->whereDate('created_at', $selectedDate)
                            ->get();
        } else {
            // If no date is provided, fetch all mutasi records
            $mutasi = Mutasi::where('is_final', 1)
                            ->where('verified', 1)
                            ->whereNull('undangan_id')
                            ->get();
        }

        // Check if there are no mutasi records
        $errorMessage = $mutasi->isEmpty() ? 'Tidak ditemukan data mutasi tersebut.' : null;

        return view('undangan.create', compact('mutasi', 'errorMessage', 'selectedDate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'mutasi_ids' => 'required|array', // Allow multiple mutasi_ids
        'mutasi_ids.*' => 'exists:mutasi,id', // Each mutasi_id must exist
        'file' => 'required|file|mimes:pdf|max:2048', // Max size 2MB
    ]);

   // Handle the uploaded file
if ($request->hasFile('file')) {
    // Generate a base kode_undangan using the current date
    $kode_base = now()->format('Ymd');

    foreach ($request->mutasi_ids as $index => $mutasi_id) {
        // Create a unique kode_undangan for each entry by appending the sequence number
        $kode_undangan = $kode_base . '-' . ($index + 1); // +1 to start from 1 instead of 0
        
        // Store the file with the unique kode_undangan
        $filePath = $request->file('file')->storeAs('public/undangan', $kode_undangan . '.pdf');

        // Create a new Undangan record for each mutasi_id
        $undangan = Undangan::create([
            'mutasi_id' => $mutasi_id, // Update mutasi_id
            'kode_undangan' => $kode_undangan,
            'file' => $filePath,
            'user_id' => auth()->id(), // Set the current user's ID
        ]);

        // Update the Mutasi record with the undangan_id
        $mutasi = Mutasi::find($mutasi_id);
        $mutasi->undangan_id = $undangan->id; // Set undangan_id to the new undangan
        $mutasi->save(); // Save the updated mutasi

        // Logic for sending invitations
        $this->sendInvitationForMutasi($mutasi_id);
    }

    return redirect()->route('undangan.index')->with('success', 'Undangan berhasil ditambahkan.');
}

return redirect()->route('undangan.create')->with('error', 'Gagal menambahkan undangan.');
}
    protected function sendInvitationForMutasi($mutasi_id)
    {
        // Retrieve the Mutasi record to get 'nama'
        $mutasi = Mutasi::findOrFail($mutasi_id);

        // Check if a 'undangan' entry already exists for this mutasi_id
        $existingNotif = NotifWa::where('mutasi_id', $mutasi_id)
            ->where('status', 'undangan')
            ->first();

        // Only insert a new record if none exists
        if (!$existingNotif) {
            NotifWa::create([
                'mutasi_id' => $mutasi_id,
                'user_id' => $mutasi->user_id, // Set the current user's ID or provide the correct value
                'nama' => $mutasi->nama,  // Add 'nama' from the Mutasi model
                'nip' => $mutasi->nip,
                'no_hp' => $mutasi->no_hp,
                'no_registrasi' => $mutasi->no_registrasi,
                'status' => 'undangan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Logic for sending invitations (email, WhatsApp, etc.)
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
