<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'nip' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/', 'unique:users'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'alamat_tinggal' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:13', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'no_ktp' => ['required', 'string', 'max:25', 'regex:/^[0-9]+$/', 'unique:users'],
            'no_karpeg' => ['required', 'string', 'max:25', 'regex:/^[0-9]+$/', 'unique:users'],
            'acc_on' => ['required', 'string', 'min:3', 'confirmed'],
            'photo_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:500'],
            'photo_karpeg' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:500'],
        ]);
    }

    protected function create(array $data)
    {
        $email = strtolower($data['email']);
        $photoKtpPath = null;
        $photoKarpegPath = null;

        // Upload dan simpan path foto KTP jika ada
        if (request()->hasFile('photo_ktp')) {
            $photoKtpPath = request()->file('photo_ktp')->store('public/personal/ktp');
            // Enkripsi path jika diperlukan
            $photoKtpPath = Crypt::encryptString($photoKtpPath);
        }

        // Upload dan simpan path foto Karpeg jika ada
        if (request()->hasFile('photo_karpeg')) {
            $photoKarpegPath = request()->file('photo_karpeg')->store('public/personal/karpeg');
            // Enkripsi path jika diperlukan
            $photoKarpegPath = Crypt::encryptString($photoKarpegPath);
        }

        $user = User::create([
            'nip' => $data['nip'],
            'nama_lengkap' => $data['nama_lengkap'],
            'alamat_tinggal' => $data['alamat_tinggal'],
            'no_hp' => $data['no_hp'],
            'email' => $email,
            'no_ktp' => $data['no_ktp'],
            'no_karpeg' => $data['no_karpeg'],
            'acc_on' => Hash::make($data['acc_on']),
            'is_approved' => false,
            'photo_ktp' => $photoKtpPath, // Simpan path foto KTP yang telah dienkripsi
            'photo_karpeg' => $photoKarpegPath, // Simpan path foto Karpeg yang telah dienkripsi
        ]);

        $user->assignRole('pegawai');

        return $user;
    }

    /**
     * Override registered method to prevent auto login and redirect to welcome page.
     */
    protected function registered(Request $request, $user)
    {
        // Simpan pesan dalam session flash
        $request->session()->flash('alert', [
            'type' => 'info', // Jenis alert, misalnya 'info', 'success', 'warning', 'danger'
            'message' => 'Akun anda belum diaktifkan. Silahkan login lagi saat sudah mendapatkan notifikasi dari WA.',
        ]);

        // Redirect ke halaman welcome
        return redirect('/');
    }
}
