<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin atau redirect ke home2 jika pegawai.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
{
    $user = Auth::user();
    
    if ($user->hasRole('admin')) {
        return view('admin.home', ['welcomeMessage' => 'Selamat datang admin']);
    } elseif ($user->hasRole('pegawai')) {
        return redirect()->route('home');
    } else {
        // Redirect ke halaman yang sesuai
        return redirect('/');
    }
}
    

    /**
     * Menampilkan halaman home untuk pegawai.
     *
     * @return \Illuminate\View\View
     */
    public function index2()
    {
        // Kirim pesan selamat datang untuk pegawai ke view home2
        return view('users.home2', ['welcomeMessage' => 'Selamat datang pegawai']);
    }

    /**
     * Menampilkan pengguna yang perlu disetujui.
     *
     * @return \Illuminate\View\View
     */
    public function showPendingUsers()
    {
        // Define the number of users per page
        $perPage = 10; // You can adjust this number as needed

        // Fetch paginated pending users
        $pendingUsers = User::where('is_approved', false)->paginate($perPage);

        // Pass paginated data to the view
        return view('admin.users', compact('pendingUsers'));
    }


    /**
     * Menyetuju pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveUser(User $user)
    {
        $user->is_approved = true;
        $user->status_verifikasi=true;
        $user->save();

        return redirect()->route('cms.users')->with('success', 'User has been approved.');
    }
    public function showActiveUsers()
{
    // Paginate results, with 10 users per page (adjust as needed)
    $activeUsers = User::where('status_verifikasi', true)->paginate(2);

    // Pass the paginated data to the view
    return view('admin.active_users', compact('activeUsers'));
}


public function showInactiveUsers()
{
    $inactiveUsers = User::where('status_verifikasi', false)->get();
    return view('admin.inactive_users', compact('inactiveUsers'));
}

public function deactivateUser(User $user)
{
    $user->status_verifikasi = false;
    $user->save();

    return redirect()->route('cms.active.users')->with('success', 'User has been deactivated.');
}

public function activateUser(User $user)
{
    $user->status_verifikasi = true;
    $user->save();

    return redirect()->route('cms.inactive.users')->with('success', 'User has been activated.');
}


    /**
     * Menampilkan detail pengguna dengan foto.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    // public function showUserDetail($id)
    // {
    //     $user = User::findOrFail($id);
    //     // Dekripsi path foto
    //     $photoKtpPath = $user->photo_ktp ? decrypt($user->photo_ktp) : null;
    //     $photoKarpegPath = $user->photo_karpeg ? decrypt($user->photo_karpeg) : null;

    //     return view('admin.user_detail', compact('user', 'photoKtpPath', 'photoKarpegPath'));
    // }
}
