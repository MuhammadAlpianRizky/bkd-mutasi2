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
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan
        if ($user) {
    // Coba reset password menggunakan token
    $response = $this->broker()->reset(
        $this->credentials($request),
        function ($user, $acc_on) {
            $this->resetAccOn($user, $acc_on); // Panggil resetAccOn dengan password baru
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
     * Update the given user's acc_on.
     */
    protected function resetAccOn($user, $acc_on)
    {
        //dd($user);
        $user->acc_on = Hash::make($acc_on); // Update kolom acc_on
        $user->save();

        Auth::login($user);
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
