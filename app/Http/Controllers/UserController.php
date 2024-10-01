<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\NotifWa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showUserDetail($id)
    {
        $user = User::findOrFail($id);
        //dd($user);
        // Initialize photo URLs as null
        $photoKtpUrl = null;
        $photoKarpegUrl = null;


        return view('admin.user_detail', compact('user', 'photoKtpUrl', 'photoKarpegUrl'));
    }
    public function showPhoto($id, $photoField, $action = 'view')
{
    // Find the user record by ID
    $user = User::findOrFail($id);

    // Ensure the requested photo field is valid
    if (!in_array($photoField, ['photo_ktp', 'photo_karpeg'])) {
        abort(404, 'Invalid photo field requested.');
    }

    // Get the encrypted photo path from the user model
    $encryptedPhotoPath = $user->$photoField;

    // Check if the user has uploaded a photo for the requested field
    if (!$encryptedPhotoPath) {
        abort(404, ucfirst(str_replace('_', ' ', $photoField)) . ' not found.');
    }

    // Decrypt the photo path
    $filePath = Crypt::decrypt($encryptedPhotoPath);
    
    // Adjust the path by removing the "public/" prefix if present
    $filePath = str_replace('public/', '', $filePath);

    // Check if the file exists in the storage
    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'File not found in the storage. Path: ' . $filePath);
    }

    // Get the full file path
    $fullPath = Storage::disk('public')->path($filePath);

    // Handle file download
    if ($action === 'download') {
        return response()->download($fullPath);
    }

    // Return the file to be displayed in the browser
    return response()->file($fullPath, [
        'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
    ]);
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

}