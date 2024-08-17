<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    protected $redirectTo = '/admin'; // Ganti dengan rute tujuan setelah registrasi

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data yang diterima dari form registrasi
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat pengguna baru
        $user = $this->create($request->all());

        // Login pengguna setelah registrasi
        auth()->login($user);

        // Redirect ke halaman yang ditentukan
        return redirect($this->redirectTo);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nik' => ['required', 'integer', 'unique:users', 'distinct'],
            'name' => ['required', 'string', 'max:255', 'distinct', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nik.unique' => 'NIK sudah terdaftar.',
            'name.unique' => 'Nama sudah terdaftar.',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'nik' => $data['nik'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
