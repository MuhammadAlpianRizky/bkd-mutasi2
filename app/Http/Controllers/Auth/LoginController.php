<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

    public function login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string',
            'acc_on' => 'required|string',
        ]);
        //  if($request->hasRole('admin')){
        //     return redirect()->route('dashboard');
        // }
        // return redirect()->route('home');

        // Cari user berdasarkan NIP
        $user = User::where('nip', $request->nip)->first();

        // Jika user ditemukan dan Hash cocok, lakukan login
        if ($user && Hash::check($request->acc_on, $user->acc_on)) {
            Auth::login($user);  // Login user secara manual
            return redirect()->intended($this->redirectPath());  // Redirect ke halaman tujuan
        }
        // return back()->withErrors([
        //     'nip' => 'The provided credentials do not match our records.',
        // ]);
       

        // Jika login gagal, kembalikan dengan error
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'nip' => [trans('auth.failed')],
            'acc_on' => [trans('auth.failed')],
        ]);
    }
    
}