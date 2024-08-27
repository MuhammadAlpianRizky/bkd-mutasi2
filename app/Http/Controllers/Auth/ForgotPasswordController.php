<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Tangani permintaan reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $response = Password::sendResetLink(['email' => $user->email]);

        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', __($response))
                    : back()->withErrors(['email' => __($response)]);
    }

    return back()->withErrors(['email' => __('No matching user found.')]);
}
}