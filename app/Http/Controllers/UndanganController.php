<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\NotifWa;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $undangan = Undangan::all();
        return view('undangan.index', compact('undangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Mendapatkan range tanggal dari request, jika tidak ada default ke 7 hari dari sekarang
        $dateRange = $request->input('date_range', now()->format('Y-m-d') . ' - ' . now()->addDays(7)->format('Y-m-d'));
    
        // Split the date range into start and end dates
        [$startDate, $endDate] = explode(' - ', $dateRange);
    
        // Mengambil record mutasi yang bisa diundang (belum diundang) dalam rentang waktu ini
        $mutasi = Mutasi::where('status', 'diterima')
            ->where('verified', 1)
            ->whereDoesntHave('undangan') // Memfilter yang sudah diundang
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->get();
    
        return view('undangan.create', compact('mutasi', 'dateRange'));
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
        foreach ($request->mutasi_ids as $mutasi_id) {
            // Generate a unique kode_undangan for each entry
            $kode_undangan = now()->format('Ymd');

            // Store the file
            $filePath = $request->file('file')->storeAs('undangan', $kode_undangan . '.pdf');

            // Create a new Undangan record for each mutasi_id
            Undangan::create([
                'mutasi_id' => $mutasi_id,
                'kode_undangan' => $kode_undangan,
                'file' => $filePath,
                'user_id' => auth()->id(), // Set the current user's ID or provide the correct value
            ]);
        }

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil ditambahkan.');
    }

    return redirect()->route('undangan.create')->with('error', 'Gagal menambahkan undangan.');
}




    /**
     * Display the specified resource.
     */
    public function show(Undangan $undangan)
    {
        // Show the details of a specific Undangan
        return view('undangan.show', compact('undangan'));
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

    public function sendInvitation(Request $request)
    {
        $invitedIds = $request->input('undang');

        if ($invitedIds) {
            // Update the mutasi records to set 'undangan' column to true
            Mutasi::whereIn('id', $invitedIds)->update(['undangan' => true]);

            // Insert new 'undangan' entries into the NotifWa table for each invited ID
            foreach ($invitedIds as $id) {
                // Retrieve the Mutasi record to get 'nama'
                $mutasi = Mutasi::findOrFail($id);

                // Check if a 'undangan' entry already exists for this mutasi_id
                $existingNotif = NotifWa::where('mutasi_id', $id)
                    ->where('status', 'undangan')
                    ->first();

                // Only insert a new record if none exists
                if (!$existingNotif) {
                    NotifWa::create([
                        'mutasi_id' => $id,
                        'user_id' => $mutasi->user_id, // Set the current user's ID or provide the correct value
                        'nama' => $mutasi->nama,  // Add 'nama' from the Mutasi model
                        'nip' =>$mutasi->nip,
                        'no_hp' =>$mutasi->no_hp,
                        'no_registrasi' =>$mutasi->no_registrasi,
                        'status' => 'undangan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Logic for sending invitations (email, WhatsApp, etc.)
        }

        return redirect()->route('mutasi.invited')->with('success', 'Undangan berhasil dikirim.');
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
     // Dapatkan tanggal awal dan akhir dari request
     $startDate = $request->input('start_date');
     $endDate = $request->input('end_date');
 
     // Pastikan rentang tanggal tidak kosong
     if ($startDate && $endDate) {
         // Filter data mutasi berdasarkan tanggal di kolom created_at atau updated_at
         $mutasi = Mutasi::whereBetween('created_at', [$startDate, $endDate])
                         ->where('status', 'diterima')
                         ->where('verified', 1)
                         ->get();
 
         // Kembalikan data mutasi sebagai JSON
         return response()->json($mutasi);
     }
 
     // Kembalikan array kosong jika tanggal tidak valid
     return response()->json([]);
 }

}
