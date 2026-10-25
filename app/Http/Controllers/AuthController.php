<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function form()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // VALIDASI
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // CARI USER
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        // CEK USER & PASSWORD (PLAINTEXT COMPARISON)
        if (!$user || $user->password !== $request->password) {
            return back()->withErrors([
                'login' => 'Username atau password salah.'
            ]);
        }

        // SIMPAN SESSION
        session([
            'user_id'   => $user->user_id,
            'user_name' => $user->nama_lengkap ?? $user->username,
        ]);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}