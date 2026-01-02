<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function proses(Request $request)
    {
        $credentials = $request->validate([
            'email_admin' => 'required|email:rfc,dns',
            'password' => 'required'
        ], [
            'email_admin.required' => 'Email tidak boleh kosong!',
            'email_admin.email' => 'Format email salah!',
            'password.required' => 'Password tidak boleh kosong!'
        ]);

        // Attempt login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt([
            'email_admin' => $credentials['email_admin'],
            'password' => $credentials['password']
        ])) {
            // Regenerate session setelah login berhasil
            $request->session()->regenerate();

            // Redirect ke halaman dashboard atau home
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        // Jika gagal login, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email_admin' => 'Email atau password salah!',
        ])->onlyInput('email_admin');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
