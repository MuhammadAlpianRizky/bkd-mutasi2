<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/'; // Redirect ke halaman yang sesuai setelah registrasi

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nip' => ['required', 'string', 'max:18', 'unique:users'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'alamat_tinggal' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'no_ktp' => ['required', 'string', 'max:25', 'unique:users'],
            'no_karpeg' => ['required', 'string', 'max:25', 'unique:users'],
            'acc_on' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'nip' => $data['nip'],
            'nama_lengkap' => $data['nama_lengkap'],
            'alamat_tinggal' => $data['alamat_tinggal'],
            'no_hp' => $data['no_hp'],
            'email' => $data['email'],
            'no_ktp' => $data['no_ktp'],
            'no_karpeg' => $data['no_karpeg'],
            'acc_on' => Hash::make($data['acc_on']),
            'is_approved' => false, // Pengguna belum disetujui secara default
        ]);

        $user->assignRole('pegawai');

        return $user;
    }

    /**
     * Override registered method to prevent auto login and redirect to home.
     */
    protected function registered(Request $request, $user)
{
    // Flash a message to inform the user
    session()->flash('message', 'Akun anda masih pending,Silahkan Login Lagi saat sudah diaktifkan.');

    // Redirect to the welcome page
    return redirect('/');
}

}
