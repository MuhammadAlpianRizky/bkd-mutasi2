<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    /**
     * Tangani proses reset password.
     */
    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'acc_on' => 'required|min:8|confirmed', // Gunakan 'acc_on' sebagai password baru
        ], [
            'acc_on.required' => 'Password baru wajib diisi.',
            'acc_on.min' => 'Password baru minimal harus :min karakter.',
            'acc_on.confirmed' => 'Konfirmasi password tidak cocok.',
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
        ]);



        // Coba reset password menggunakan token
        $response = $this->broker()->reset
        (
            $this->credentials($request),
            function ($user, $acc_on) {
                $this->resetAccOn($user, $acc_on);
                // Panggil resetAccOn dengan password baru
            }
        );


        // Menangani respons berdasarkan hasil reset password
        if ($response == Password::PASSWORD_RESET) {
            // Jika berhasil, redirect ke halaman welcome dengan pesan
            $request->session()->flash('alert', [
                'type' => 'info', // Jenis alert, misalnya 'info', 'success', 'warning', 'danger'
                'message' => 'Password berhasil di-reset. Silakan login dengan password baru Anda.',
            ]);
            // Redirect ke halaman welcome
            return redirect('/');
        } elseif ($response == Password::INVALID_TOKEN) {
            // Jika token tidak valid atau sudah kadaluwarsa, kembalikan ke formulir dengan error
            return redirect()->back()->withErrors(['token' => 'Link Sudah Expired.']);
        } else {
            // Jika gagal dengan error lain, kembalikan ke formulir dengan error
            return redirect()->back()->withErrors(['email' => __($response)]);
        }
    }

    /**
     * Update the given user's acc_on.
     */
    protected function resetAccOn($user, $acc_on)
    {
        $user->acc_on = Hash::make($acc_on); // Update kolom acc_on
        $user->save();

        // Hapus atau komentari baris ini jika tidak ingin login otomatis
        // Auth::login($user);
    }

    /**
     * Tampilkan form reset password.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Dapatkan instance password broker.
     */
    protected function broker()
    {
        return Password::broker();
    }

    /**
     * Dapatkan kredensial untuk reset password.
     */
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'token' => $request->input('token'),
            'password' => $request->input('acc_on'),
        ];
    }
}
