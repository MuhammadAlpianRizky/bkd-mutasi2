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

        // Dekripsi path foto
        $photoKtpPath = Crypt::decrypt($user->photo_ktp);
        $photoKarpegPath = Crypt::decrypt($user->photo_karpeg);

        // Mendapatkan URL file dari Storage
        $photoKtpUrl = Storage::url($photoKtpPath);
        $photoKarpegUrl = Storage::url($photoKarpegPath);

        return view('admin.user_detail', compact('user', 'photoKtpUrl', 'photoKarpegUrl'));
    }
}
