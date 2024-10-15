<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    /**
     * Tangani permintaan reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $pengumumans = Pengumuman::all();
        return view('auth.passwords.email', compact('pengumumans'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'nip' => 'required|exists:users,nip',
            'no_ktp' => 'required|exists:users,no_ktp',
            'no_karpeg' => 'required|exists:users,no_karpeg',
        ], [
            'nip.required' => 'NIP tidak boleh kosong.',
            'nip.exists' => 'NIP tidak ditemukan.',
            'no_ktp.required' => 'Nomor KTP tidak boleh kosong.',
            'no_ktp.exists' => 'Nomor KTP tidak ditemukan.',
            'no_karpeg.required' => 'Nomor Karpeg tidak boleh kosong.',
            'no_karpeg.exists' => 'Nomor Karpeg tidak ditemukan.',
        ]);

        $user = User::where('nip', $request->nip)
                    ->where('no_ktp', $request->no_ktp)
                    ->where('no_karpeg', $request->no_karpeg)
                    ->first();

        if ($user) {
            // Buat token reset password
            $token = Password::createToken($user);
            $resetUrl = url('password/reset/'.$token.'?email='.$user->email);

            // Kirimkan notifikasi reset password
            Notification::send($user, new ResetPasswordNotification($resetUrl));

            // Mask email
            $maskedEmail = $this->maskEmail($user->email);

            return back()->with('status', 'Link reset password telah dikirim melalui: ' . $maskedEmail);
        }

        return back()->withErrors(['email' => 'Pengguna tidak ditemukan.']);
    }

    // Fungsi untuk menyensor email
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1];

        // Sensori username
        $maskedUsername = substr($username, 0, 3) . str_repeat('*', strlen($username) - 6) . substr($username, -3);

        return $maskedUsername . '@' . $domain;
    }

}
