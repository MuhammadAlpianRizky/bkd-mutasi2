<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
    
        $credentials = $request->only('nip', 'acc_on');
    
        $user = User::where('nip', $credentials['nip'])->first();
    
        if ($user) {
            if (Hash::check($credentials['acc_on'], $user->acc_on)) {
                if (!$user->is_approved) {
                    return back()->withErrors([
                        'nip' => 'Akun Belum Diaktifkan',
                    ])->withInput($request->except('acc_on'));
                }
    
                Auth::login($user);
    
                // Redirect based on user role
                if ($user->hasRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif ($user->hasRole('pegawai')) {
                    return redirect()->route('home');
                }
            } else {
                // Password is incorrect
                return back()->withErrors([
                    'acc_on' => 'Akun Tidak Sesuai',
                ])->withInput($request->except('acc_on'));
            }
        } else {
            // Nip is incorrect or not registered
            return back()->withErrors([
                'nip' => 'NIP Belum Terdaftar',
            ])->withInput($request->except('acc_on'));
        }
    }
}    