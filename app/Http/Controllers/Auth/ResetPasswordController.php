<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    /**
     * Handle the reset password process.
     */
    public function reset(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'acc_on' => 'required|min:8|confirmed', // Gunakan 'password' di form
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan
        if ($user) {
            // Pastikan token valid untuk user ini
            $response = $this->broker()->reset(
                $this->credentials($request),
                function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            // Cek apakah reset password berhasil
            return $response == Password::PASSWORD_RESET
                        ? redirect($this->redirectPath())->with('status', __($response))
                        : back()->withErrors(['email' => __($response)]);
        } else {
            // Jika user tidak ditemukan
            throw ValidationException::withMessages([
                'email' => 'Email tidak terdaftar.',
            ]);
        }
    }

    /**
     * Update the given user's password.
     */
    protected function resetPassword(User $user, $password)
{
    // Simpan password baru di field 'acc_on'
    $user->acc_on = bcrypt($password);
    $user->save();

    // Login otomatis setelah reset password
    Auth::login($user);
}

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the password broker instance.
     */
    protected function broker()
    {
        return Password::broker();
    }

    /**
     * Get the credentials for the password reset.
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'acc_on', 'token');
    }
}
