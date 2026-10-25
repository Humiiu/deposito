<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        $user = DB::table('users')
            ->where('user_id', session('user_id'))
            ->first();

        $simulations = DB::table('simulations')
            ->join('banks', 'simulations.bank_id', '=', 'banks.bank_id')
            ->where('simulations.user_id', session('user_id'))
            ->orderBy('waktu_simulasi', 'desc')
            ->select(
                'simulations.*',
                'banks.nama_bank',
                'banks.suku_bunga_dasar',
                'bank_logos'
            )
            
            ->get();

        $lastSimulation = $simulations->first();

        $totalDeposito = $lastSimulation ? $lastSimulation->nominal_deposito : 0;
        $totalBunga = $lastSimulation ? $lastSimulation->bunga_diterima : 0;
        $totalSimulasi = $simulations->count();

        return view('dashboard', compact(
            'user',
            'simulations',
            'lastSimulation',
            'totalDeposito',
            'totalBunga',
            'totalSimulasi'
        ));
    }

    public function riwayat()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        $data = DB::table('simulations')
            ->join('banks', 'simulations.bank_id', '=', 'banks.bank_id')
            ->where('user_id', session('user_id'))
            ->orderBy('waktu_simulasi', 'desc')
            ->get();

        return view('riwayat', compact('data'));
    }

    public function profile()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        $user = DB::table('users')
            ->where('user_id', session('user_id'))
            ->first();

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->password) {
            $updateData['password'] = bcrypt($request->password);
        }

        DB::table('users')
            ->where('user_id', session('user_id'))
            ->update($updateData);

        return redirect('/profile')->with('success', 'Profile updated successfully');
    }
}
