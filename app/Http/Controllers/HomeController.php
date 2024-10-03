<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // Fetch user and mutasi data
            $pendingUsersCount = User::where('is_approved', false)->count();
            $activeUsersCount = Mutasi::where('verified', true)->count();
            $inactiveUsersCount = Mutasi::where('verified', false)->count();
            $mutasiCount = Mutasi::count();

            // Return the data to the view
            return view('admin.home', [
                'welcomeMessage' => 'Selamat datang admin',
                'pendingUsersCount' => $pendingUsersCount,
                'activeUsersCount' => $activeUsersCount,
                'inactiveUsersCount' => $inactiveUsersCount,
                'mutasiCount' => $mutasiCount,
            ]);
        } elseif ($user->hasRole('pegawai')) {
            return redirect()->route('home');
        } else {
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
        return view('users.beranda', ['welcomeMessage' => 'Selamat datang pegawai']);
    }

    /**
     * Menampilkan pengguna yang perlu disetujui.
     *
     * @return \Illuminate\View\View
     */
    public function showPendingUsers(Request $request)
{
    // Define the number of users per page
    $perPage = 10; // You can adjust this number as needed

    // Get the search query from the request
    $searchQuery = $request->input('search');

    // Build the query for pending users
    $pendingUsers = User::where('is_approved', false);

    // If there is a search query, filter by relevant fields
    if ($searchQuery) {
        $pendingUsers->where(function ($query) use ($searchQuery) {
            $query->where('nama_lengkap', 'like', "%{$searchQuery}%")
                ->orWhere('email', 'like', "%{$searchQuery}%")
                ->orWhere('nip', 'like', "%{$searchQuery}%");
        });
    }

    // Paginate the results
    $pendingUsers = $pendingUsers->paginate($perPage);

    // Pass paginated data to the view
    return view('admin.users', compact('pendingUsers'));
}


    /**
     * Menyetujui pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveUser(User $user)
    {
        $user->is_approved = true;
        $user->status_verifikasi = true;
        $user->save();

        return redirect()->route('cms.users')->with('success', 'User has been approved.');
    }

    /**
     * Menampilkan pengguna aktif.
     *
     * @return \Illuminate\View\View
     */
    public function showActiveUsers(Request $request)
    {
         // Define the number of users per page
        $perPage = 10; // You can adjust this number as needed

        // Get the search query from the request
        $searchQuery = $request->input('search');

        // Paginate results, excluding users with the 'admin' role
        $activeUsers = User::where('status_verifikasi', true)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            });
            // If there is a search query, filter by name or email
    if ($searchQuery) {
        $activeUsers->where(function ($query) use ($searchQuery) {
            $query->where('nama_lengkap', 'like', "%{$searchQuery}%")
                ->orWhere('email', 'like', "%{$searchQuery}%")
                ->orWhere('nip','like',"%{$searchQuery}%");
        });
    }

    // Paginate the results
    $activeUsers = $activeUsers->paginate($perPage);

        // Pass the paginated data to the view
        return view('admin.active_users', compact('activeUsers'));
    }

    public function showInactiveUsers(Request $request)
{
    // Define the number of users per page
    $perPage = 10; // You can adjust this number as needed

    // Get the search query from the request
    $searchQuery = $request->input('search');

    // Build the query
    $inactiveUsers = User::where('status_verifikasi', false)
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        });

    // If there is a search query, filter by name or email
    if ($searchQuery) {
        $inactiveUsers->where(function ($query) use ($searchQuery) {
            $query->where('nama_lengkap', 'like', "%{$searchQuery}%")
                ->orWhere('email', 'like', "%{$searchQuery}%")
                ->orWhere('nip','like',"%{$searchQuery}%");
        });
    }

    // Paginate the results
    $inactiveUsers = $inactiveUsers->paginate($perPage);

    return view('admin.inactive_users', compact('inactiveUsers'));
}



    /**
     * Menonaktifkan pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateUser(User $user)
    {
        $user->status_verifikasi = false;
        $user->save();

        return redirect()->route('cms.active.users')->with('success', 'User has been deactivated.');
    }

    /**
     * Mengaktifkan pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateUser(User $user)
    {
        $user->status_verifikasi = true;
        $user->save();

        return redirect()->route('cms.inactive.users')->with('success', 'User has been activated.');
    }
    public function deleteUser(User $user)
{
    $user->delete();

    return redirect()->route('cms.users')->with('success', 'User has been deleted.');
}
public function deleteUser2(User $user)
{
    // Check if the user has a related mutasi with no_register
    $hasNoRegister = Mutasi::where('user_id', $user->id)
                            ->whereNotNull('no_registrasi')
                            ->exists();

    if ($hasNoRegister) {
        return redirect()->route('cms.inactive.users')->with('error', 'Akun ini tidak bisa dihapus dikarenakan data mutasi masih ada');
    }

    $user->delete();

    return redirect()->route('cms.users')->with('success', 'Akun berhasil dihapus');
}

}
