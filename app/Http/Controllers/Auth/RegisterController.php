<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Set a flash message indicating the account needs activation
        $request->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Akun anda belum diaktifkan. Silahkan login lagi saat sudah mendapatkan notifikasi dari WA.',
        ]);

        // Redirect to the welcome page
        return redirect('/');
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

        if (request()->hasFile('photo_ktp')) {
            $file = request()->file('photo_ktp');
            $originalName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('public/personal/ktp', $originalName);
            $photoKtpPath = encrypt($storedPath);
        }

        if (request()->hasFile('photo_karpeg')) {
            $file = request()->file('photo_karpeg');
            $originalName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('public/personal/karpeg', $originalName);
            $photoKarpegPath = encrypt($storedPath);
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
            'photo_ktp' => $photoKtpPath,
            'photo_karpeg' => $photoKarpegPath,
        ]);

        $user->assignRole('pegawai');

        return $user;
    }
}
