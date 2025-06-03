<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        // Jika user sudah login, arahkan langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.sesi.index');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation

            return redirect()->intended(route('admin.dashboard'));
        }

        // Gagal login, redirect dengan error flash & simpan input sebelumnya
        return back()
            ->withErrors(['email' => 'Email atau password salah!'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();          // Hapus semua data session
        $request->session()->regenerateToken();     // Regenerasi token CSRF baru

        return redirect()->route('login');
    }
}
