<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function showUserDetail($id)
    {
        $user = User::findOrFail($id);

        // Initialize photo URLs as null
        $photoKtpUrl = null;
        $photoKarpegUrl = null;

        // Check if photo paths are available and decrypt them
        if ($user->photo_ktp) {
            try {
                $photoKtpPath = Crypt::decrypt($user->photo_ktp);
                $photoKtpUrl = Storage::url($photoKtpPath);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Handle decryption error if necessary
                $photoKtpUrl = null;
            }
        }

        if ($user->photo_karpeg) {
            try {
                $photoKarpegPath = Crypt::decrypt($user->photo_karpeg);
                $photoKarpegUrl = Storage::url($photoKarpegPath);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Handle decryption error if necessary
                $photoKarpegUrl = null;
            }
        }

        return view('admin.user_detail', compact('user', 'photoKtpUrl', 'photoKarpegUrl'));
    }
}
