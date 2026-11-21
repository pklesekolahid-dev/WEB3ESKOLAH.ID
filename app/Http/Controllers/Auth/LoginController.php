<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    // 1. Proses Login
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['email'] = Str::lower(trim($credentials['email']));
        $remember = $request->boolean('remember-me');

        // Coba login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $dashboardUrl = route('admin.dashboard', absolute: false);

            // Jika sukses, arahkan ke dashboard admin (fallback ke HOME ketika route gagal)
            return redirect()->intended($dashboardUrl ?: RouteServiceProvider::HOME);
        }

        $user = User::where('email', $credentials['email'])->first();
        $errorMessage = $user ? 'Kata sandi tidak sesuai.' : 'Email tidak terdaftar.';

        // Jika gagal, kembalikan ke login dengan pesan error
        return back()->withErrors([
            'email' => $errorMessage,
        ])->onlyInput('email');
    }

    // 2. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/panel-login');
    }
}