<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\NotifWa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
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
        $pengumumans = Pengumuman::all();
        return view('auth.register', compact('pengumumans'));
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
            'nip' => ['required', 'string', 'min:18','max:18', 'regex:/^[0-9]+$/', 'unique:users'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'alamat_tinggal' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'min:10','max:15', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'no_ktp' => ['required', 'string', 'min:16','max:25', 'regex:/^[0-9]+$/', 'unique:users'],
            'no_karpeg' => ['required', 'string', 'max:25','unique:users'],
            'acc_on' => ['required', 'string', 'min:8', 'confirmed'],
            'photo_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:500'],
            'photo_karpeg' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:500'],
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 18 karakter.',
            'nip.min'=> 'NIP tidak boleh kurang dari 18 karakter.',
            'nip.regex' => 'NIP harus terdiri dari angka.',
            'nip.unique' => 'NIP sudah terdaftar.',

            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 150 karakter.',

            'alamat_tinggal.required' => 'Alamat tinggal wajib diisi.',
            'alamat_tinggal.string' => 'Alamat tinggal harus berupa teks.',
            'alamat_tinggal.max' => 'Alamat tinggal tidak boleh lebih dari 255 karakter.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 13 karakter.',
            'no_hp.regex' => 'Nomor HP harus terdiri dari angka.',
            'no_hp.min' => 'Nomor HP tidak boleh lebih dari 10 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.string' => 'Nomor KTP harus berupa teks.',
            'no_ktp.max' => 'Nomor KTP tidak boleh lebih dari 25 karakter.',
            'no_ktp.regex' => 'Nomor KTP harus terdiri dari angka.',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar.',
            'no_ktp.min' => 'Nomor KTP minimal 16 karakter',

            'no_karpeg.required' => 'Nomor Karpeg wajib diisi.',
            'no_karpeg.string' => 'Nomor Karpeg harus berupa teks.',
            'no_karpeg.max' => 'Nomor Karpeg tidak boleh lebih dari 25 karakter.',
            'no_karpeg.unique' => 'Nomor Karpeg sudah terdaftar.',

            'acc_on.required' => 'Password wajib diisi.',
            'acc_on.string' => 'Password harus berupa teks.',
            'acc_on.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'acc_on.confirmed' => 'Konfirmasi password tidak cocok.',

            'photo_ktp.required' => 'Foto KTP wajib diunggah.',
            'photo_ktp.image' => 'Foto KTP harus berupa gambar.',
            'photo_ktp.mimes' => 'Foto KTP harus dalam format jpeg, png, atau jpg.',
            'photo_ktp.max' => 'Ukuran foto KTP tidak boleh lebih dari 500KB.',

            'photo_karpeg.required' => 'Foto Karpeg wajib diunggah.',
            'photo_karpeg.image' => 'Foto Karpeg harus berupa gambar.',
            'photo_karpeg.mimes' => 'Foto Karpeg harus dalam format jpeg, png, atau jpg.',
            'photo_karpeg.max' => 'Ukuran foto Karpeg tidak boleh lebih dari 500KB.',
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
// Insert data into notif_wa table, both mutasi_id and no_registrasi can be null
            NotifWa::create([
                'user_id' => $user->id,
                'mutasi_id' => null, // This can be null now
                'status' => 'bikin_akun',
                'nama' => $user->nama_lengkap,
                'nip' => $user->nip,
                'no_hp' => $user->no_hp,
                'no_registrasi' => null, // This can be null now
            ]);
            return $user;
        }
}
