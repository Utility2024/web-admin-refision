<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'nik' => ['required', 'integer'],
            'password' => ['required', 'string'],
        ]);

        // Tentukan kredensial untuk autentikasi
        $credentials = $request->only('nik', 'password');

        // Coba autentikasi
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Autentikasi berhasil, arahkan ke halaman yang diinginkan
            return redirect()->intended('admin');
        }

        // Autentikasi gagal, tampilkan pesan kesalahan
        throw ValidationException::withMessages([
            'nik' => 'NIK atau password yang Anda masukkan salah.',
        ]);
    }
}
