<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // public function login(Request $request)
    // {
    //     // Validasi input dari pengguna
    //     $request->validate([
    //         'nik' => 'required|numeric',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     // pengecekan adanya nik
    //     $user = User::where('txtNIK', $request->nik)->first();

    //     // Cek kredensial pengguna dan login
    //     if (Auth::attempt(['txtNIK' => $request->nik, 'txtPassword' => $request->password])) {
    //         // Redirect ke halaman utama setelah login sukses
    //         return redirect()->intended('/dashboard');
    //     }

    //     dd('Password Salah');

    //     // Jika login gagal, kembali ke halaman login dengan error
    //     return back()->withErrors([
    //         'nik' => 'The provided credentials do not match our records.',
    //         'password' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'nik' => 'required|numeric',
            'password' => 'required|string|min:8',
        ]);

        // Pengecekan NIK
        $user = User::where('txtNIK', $request->nik)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->txtPassword)) {
            // Lakukan login menggunakan Auth::login()
            Auth::login($user);

            // Redirect ke halaman utama setelah login sukses
            return redirect()->intended('/');
        }

        dd('Password Salah');

        // Jika login gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'nik' => 'The provided NIK does not match our records.',
            'password' => 'The provided password is incorrect.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
