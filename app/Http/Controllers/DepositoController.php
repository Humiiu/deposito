<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositoController extends Controller
{
    public function deposito()
    {
        // cek login
        if (!session('user_id')) {
            return redirect('/login');
        }

        // ambil semua bank
        $banks = DB::table('banks')->get();

        return view('deposito', compact('banks'));
    }

    public function store(Request $request)
    {
        // cek login
        if (!session('user_id')) {
            return redirect('/login');
        }

        // validasi input
        $request->validate([
            'bank_id' => 'required|exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|integer|min:1',
        ]);

        // ambil data bank
        $bank = DB::table('banks')
            ->where('bank_id', $request->bank_id)
            ->first();

        if (!$bank) {
            return back()->withErrors(['bank_id' => 'Bank tidak ditemukan']);
        }

        $nominal = (float) $request->nominal_deposito;
        $durasi  = (int) $request->jangka_waktu_bulan;

        // hitung bunga (flat sederhana)
        $bunga = $nominal * ($bank->suku_bunga_dasar / 100) * ($durasi / 12);

        // total akhir
        $total = $nominal + $bunga;

        // simpan ke tabel simulations
        DB::table('simulations')->insert([
            'user_id' => session('user_id'), // FK ke users.id
            'bank_id' => $bank->bank_id,
            'nominal_deposito' => $nominal,
            'jangka_waktu_bulan' => $durasi,
            'bunga_diterima' => $bunga,
            'total_akhir' => $total,
            'waktu_simulasi' => now(),
        ]);

        return redirect('/dashboard')
            ->with('success', 'Simulasi deposito berhasil disimpan!');
    }
}
