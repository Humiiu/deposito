@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: radial-gradient(circle at top, #1a1a1a, #000);
        color: #f5d78e;
    }

    .container {
        max-width: 1100px;
        margin: 30px auto;
        padding: 20px;
    }

    /* ================= HEADER ================= */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .header h2 {
        letter-spacing: 2px;
    }

    .nav {
        display: flex;
        gap: 25px;
    }

    .nav a {
        text-decoration: none;
        color: #aaa;
        font-size: 13px;
        letter-spacing: 1px;
        padding-bottom: 5px;
    }

    .nav a.active,
    .nav a:hover {
        color: #f5d78e;
        border-bottom: 1px solid #f5d78e;
    }

    /* ================= WELCOME ================= */
    .welcome-text {
        font-size: 14px;
        letter-spacing: 2px;
        color: #aaa;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    /* ================= TABLE CARD ================= */
    .history-card {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border-radius: 18px;
        padding: 25px;
        border: 1px solid #f5d78e55;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 14px 12px;
        border-bottom: 1px solid #333;
        font-size: 14px;
    }

    th {
        color: #f5d78e;
        font-weight: bold;
        letter-spacing: 1px;
    }

    td {
        color: #ccc;
    }

    tr:hover {
        background: rgba(245, 215, 142, 0.03);
    }

    /* ================= BANK INFO ================= */
    .bank-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bank-logo {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    /* ================= ACTION ================= */
    .btn {
        padding: 14px;
        width: 100%;
        text-align: center;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        letter-spacing: 1px;
        cursor: pointer;
        border: 1px solid #f5d78e55;
        color: #f5d78e;
        background: transparent;
    }

    .btn:hover {
        background: linear-gradient(135deg, #f5d78e, #c9a44c);
        color: #000;
    }
</style>

<div class="container">

    {{-- HEADER --}}
    <div class="header">
        <h2>RIWAYAT SIMULASI</h2>
        <div class="nav">
            <a href="/dashboard">Dashboard</a>
            <a href="/deposito">Deposito</a>
            <a href="/riwayat" class="active">Riwayat</a>
            <a href="/profile">Profile</a>
        </div>
    </div>

    <div class="welcome-text">
        Daftar seluruh simulasi deposito yang pernah Anda lakukan
    </div>

    {{-- TABLE --}}
    <div class="history-card">
        <table>
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Nominal Deposito</th>
                    <th>Bunga Diterima</th>
                    <th>Suku Bunga</th>
                    <th>Waktu Simulasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $simulation)
                <tr>
                    <td>
                        <div class="bank-info">
                            <img src="{{ asset('bank_logos/' . $simulation->bank_logos) }}" class="bank-logo">
                        </div>
                    </td>
                    <td>
                        Rp {{ number_format($simulation->nominal_deposito, 0, ',', '.') }}
                    </td>
                    <td>
                        Rp {{ number_format($simulation->bunga_diterima, 0, ',', '.') }}
                    </td>
                    <td>
                        {{ $simulation->suku_bunga_dasar }}%
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($simulation->waktu_simulasi)->format('d M Y, H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#aaa;">
                        Belum ada simulasi deposito
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
