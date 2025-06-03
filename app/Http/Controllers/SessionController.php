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
        // Validasi form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $request->session()->regenerate(); // Perlindungan session fixation
            return redirect()->route('admin.dashboard');
        }

        // Login gagal, redirect kembali ke login dengan error
        return redirect('/login')->withErrors(['Email atau password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Untuk keamanan CSRF
        return redirect('/login');
    }
}
