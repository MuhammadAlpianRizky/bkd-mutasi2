<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home'; // Redirect to the home page after login

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string',
            'acc_on' => 'required|string',
        ]);

     // Compare user input with the generated captcha result
    if ($request->captcha != $request->captcha_result) {
        return back()->withErrors([
            'captcha' => 'Hasil hitungan salah, coba lagi!',
        ])->withInput($request->except('acc_on'));
    }


        $credentials = $request->only('nip', 'acc_on');

        $user = User::where('nip', $credentials['nip'])->first();

        if ($user) {
            if (Hash::check($credentials['acc_on'], $user->acc_on)) {
                // Menggunakan fungsi canLogin untuk memeriksa is_approved dan status_verifikasi
                if (!$user->canLogin()) {
                    return back()->withErrors([
                        'nip' => $user->is_approved ? 'Akun Anda Dinonaktifkan' : 'Akun Belum Diverifikasi oleh Admin',
                    ])->withInput($request->except('acc_on'));
                }

                Auth::login($user);

                // Redirect berdasarkan peran pengguna
                if ($user->hasRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif ($user->hasRole('pegawai')) {
                    return redirect()->route('home');
                }
            } else {
                // Password tidak cocok
                return back()->withErrors([
                    'acc_on' => 'Akun Tidak Sesuai',
                ])->withInput($request->except('acc_on'));
            }
        } else {
            // NIP tidak ditemukan atau belum terdaftar
            return back()->withErrors([
                'nip' => 'NIP Belum Terdaftar',
            ])->withInput($request->except('acc_on'));
        }
    }
}
