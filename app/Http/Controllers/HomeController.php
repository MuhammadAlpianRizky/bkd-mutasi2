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
        if (Auth::user()->hasRole('admin')) {
            // Kirim pesan selamat datang ke view dashboard
            return view('home', ['welcomeMessage' => 'Selamat datang admin']);
        } elseif (Auth::user()->hasRole('pegawai')) {
            // Jika pengguna memiliki peran pegawai, redirect ke home2
            return redirect()->route('home');
        } else {
            // Jika pengguna tidak memiliki peran yang sesuai
            return abort(403); // Akses ditolak
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
        return view('home2', ['welcomeMessage' => 'Selamat datang pegawai']);
    }

    /**
     * Menampilkan pengguna yang perlu disetujui.
     *
     * @return \Illuminate\View\View
     */
    public function showPendingUsers()
    {
        $pendingUsers = User::where('is_approved', false)->get();
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
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User has been approved.');
    }
}
