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
        //dd($user);
        // Initialize photo URLs as null
        $photoKtpUrl = null;
        $photoKarpegUrl = null;


        return view('admin.user_detail', compact('user', 'photoKtpUrl', 'photoKarpegUrl'));
    }
}
