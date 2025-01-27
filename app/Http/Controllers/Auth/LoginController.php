<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            // Toast Error Message
            toast('Invalid NIK or password!', 'error')->timerProgressBar();
            return redirect()->route('home');
        }

        // Pengecekan NIK
        $user = User::where('txtNIK', $request->nik)->first();

        // jika bitActive = 0
        if ($user->bitActive == 0) {
            toast('Your account is inactive!', 'error')->timerProgressBar();
            return redirect()->route('home');
        }

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->txtPassword)) {
            // Login user
            Auth::login($user);

            // Periksa apakah proses user
            if ($user->intProcessStep == 0) {
                toast('Login success!', 'success')->timerProgressBar();
                return redirect()->route('question');
            } elseif ($user->intProcessStep == 1) {
                toast('Login success!', 'success')->timerProgressBar();
                return redirect()->route('congratulations');
            } elseif ($user->intProcessStep == 2) {
                toast('Login success!', 'success')->timerProgressBar();
                return redirect()->route('home');
            }
        }

        // Jika login gagal, kembali ke halaman login dengan error message
        toast('Invalid NIK or password!', 'error')->timerProgressBar();
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        toast('Logout success!', 'success')->timerProgressBar();
        return redirect()->route('home');
    }
}
