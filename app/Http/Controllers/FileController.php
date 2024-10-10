<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\NotifWa;
use App\Models\Validasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\UploadPersyaratan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * Show or download a file.
     *
     * @param  int  $id
     * @param  string  $filename
     * @param  string  $action
     * @return \Illuminate\Http\Response
     */
    public function show($id, $filename, $action = 'view')
{
    // Find the mutasi record
    $mutasi = Mutasi::findOrFail($id);

    // Retrieve the UploadPersyaratan record for the given filename
    $upload = UploadPersyaratan::where('mutasi_id', $id)
        ->where('file_path', 'like', '%'.$filename)
        ->first();

    if (!$upload) {
        abort(404, 'File not found.');
    }

    // Get file_path and user_id from the UploadPersyaratan record
    $filePath = $upload->file_path;

    // Construct the path to the file
    $fullPath = Storage::disk('public')->path($filePath);

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'File not found.');
    }

    if ($action === 'download') {
        return response()->download($fullPath);
    }

    return response()->file($fullPath, [
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
}

public function show1(Mutasi $mutasi, $filename, $action = 'view')
{
    // Retrieve the UploadPersyaratan record for the given filename
    $upload = UploadPersyaratan::where('mutasi_id', $mutasi->id)
        ->where('file_path', 'like', '%'.$filename)
        ->first();

    if (!$upload) {
        abort(404, 'File not found.');
    }

    // Get file_path from the UploadPersyaratan record
    $filePath = $upload->file_path;

    // Construct the path to the file
    $fullPath = Storage::disk('public')->path($filePath);

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'File not found.');
    }

    if ($action === 'download') {
        return response()->download($fullPath);
    }

    return response()->file($fullPath, [
        'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
    ]);
}


    public function cancel(Request $request,$id)
    {
        $mutasi = Mutasi::findOrFail($id);

        // Update status verified
        $mutasi->update([
            'verified' => false,
            'verified_at' => null,
            'is_final' => false,
        ]);

        return redirect()->route('mutasi.list')->with('status', 'Validasi berhasil dibatalkan.');
    }

    public function validate($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $uploads = UploadPersyaratan::where('mutasi_id', $id)->get();
        $persyaratan = Persyaratan::all(); // Get all persyaratan for the dropdown

        return view('mutasi.validate', compact('mutasi', 'uploads', 'persyaratan'));
    }

    // Handle validation action with file validation
    public function updateValidation(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:diterima,ditolak,dibatalkan',
        'keterangan' => 'nullable|string',  // Validation for the 'keterangan' field
    ]);

    $mutasi = Mutasi::findOrFail($id);

    $status = $request->input('status');
    $isFinal = $status === 'diterima' || $status === 'dibatalkan';
    $verified = $status !== 'ditolak';

    $mutasi->update([
        'status' => $status,
        'verified' => $verified,
        'is_final' => $isFinal,
        'keterangan' => $request->input('keterangan'),  // Save the 'keterangan' value
    ]);

    NotifWa::create([
        'user_id' => $mutasi->user_id, // ID pengguna dari mutasi
        'mutasi_id' => $mutasi->id,    // ID mutasi yang disetujui
        'status' => 'approved_mutasi', // Status notifikasi WA: 'approved_mutasi'
        'nama' => $mutasi->user->nama_lengkap, // Nama pengguna dari relasi user di mutasi
        'nip' => $mutasi->user->nip,   // NIP pengguna
        'no_hp' => $mutasi->user->no_hp, // Nomor HP pengguna
        'no_registrasi' => $mutasi->no_registrasi, // Nomor registrasi dari mutasi
        'is_wa' => '0',  // Default is_wa: belum dikirim via WA
    ]);
    return redirect()->route('mutasi.list')->with('status', 'Mutasi berhasil diperbarui.');
}


    public function list(Request $request)
    {
        $perPage = 10;
        // Ambil data query dari request user
        $searchQuery = $request->input('search');
        $statusFilter = $request->input('status');

        $daftarMutasi = Mutasi::query();

        if ($searchQuery) {
            $daftarMutasi->where(function ($query) use ($searchQuery) {
                $query->where('no_registrasi', 'like', "%{$searchQuery}%")
                ->orWhere('nama', 'like', "%{$searchQuery}%")
                ->orWhere('nip', 'like', "%{$searchQuery}%");
            });
        }

        if ($statusFilter) {
            if ($statusFilter === 'proses') {
                $daftarMutasi->where('status', 'proses');
            } elseif ($statusFilter === 'diterima'){
                $daftarMutasi->where('status', 'diterima');
            } elseif ($statusFilter === 'ditolak') {
                $daftarMutasi->where('status', 'ditolak');
            } elseif ($statusFilter === 'dibatalkan') {
                $daftarMutasi->where('status', 'dibatalkan');
            }
        }


        $daftarMutasis = $daftarMutasi->orderBy('verified', 'asc')->orderBy('id', 'desc')->paginate(10);

        return view('mutasi.list', compact('daftarMutasis'));
    }
    public function edit($id)
{
    // You may reuse the validation view or create a new view for editing.
    $mutasi = Mutasi::findOrFail($id);
    $uploads = UploadPersyaratan::where('mutasi_id', $id)->get();
    $persyaratan = Persyaratan::all(); // Get all persyaratan for the dropdown

    return view('mutasi.edit', compact('mutasi', 'uploads', 'persyaratan'));
}
}
