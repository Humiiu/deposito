@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: radial-gradient(circle at top, #1a1a1a, #000);
        color: #f5d78e;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
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

    .welcome-text {
        font-size: 14px;
        letter-spacing: 2px;
        color: #aaa;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    /* CARD SUMMARY */
    .card-summary {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border-radius: 18px;
        padding: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f5d78e55;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
        margin-bottom: 30px;
    }

    .card-left img {
        width: 80px;
        margin-bottom: 10px;
    }

    .card-left p {
        font-size: 13px;
        color: #aaa;
    }

    .card-right h3 {
        font-size: 26px;
        margin-bottom: 10px;
    }

    .info-row {
        display: flex;
        gap: 30px;
        font-size: 13px;
        color: #ccc;
    }

    .info-row strong {
        color: #f5d78e;
    }

    .actions {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .btn {
        flex: 1;
        padding: 14px;
        text-align: center;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        letter-spacing: 1px;
        cursor: pointer;
    }

    .btn-gold {
        background: linear-gradient(135deg, #f5d78e, #c9a44c);
        color: #000;
    }

    .btn-dark {
        border: 1px solid #f5d78e55;
        color: #f5d78e;
        background: transparent;
    }

    .insight-box {
        background: #0f0f0f;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #333;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .about {
        font-size: 13px;
        color: #aaa;
        text-align: center;
        margin-top: 40px;
    }
</style>

<div class="container">

    <div class="header">
        <h2>DASHBOARD</h2>
        <div class="nav">
            <a href="/dashboard" class="active">Dashboard</a>
            <a href="/deposito">Deposito</a>
            <a href="/riwayat">Riwayat</a>
            <a href="/profile">Profile</a>
        </div>
    </div>

    <div class="welcome-text">
        WELCOME, {{ $user->username }}!
    </div>

    {{-- SUMMARY CARD --}}
    <div class="card-summary">
<div class="card-left">
    @if($lastSimulation)
        @if($lastSimulation->bank_logos)
            <img src="{{ asset('bank_logos/' . $lastSimulation->bank_logos) }}" 
            alt="{{ $lastSimulation->nama_bank }}"
                 style="width: 80px; height: auto;">
        @else
            <img src="{{ asset('images/default-bank.png') }}" 
                 alt="{{ $lastSimulation->nama_bank }}"
                 style="width: 80px; height: auto; border-radius: 8px;">
        @endif
        <p>{{ $lastSimulation->nama_bank }}</p>
    @else
        <img src="{{ asset('images/default-bank.png') }}" 
             alt="Default Bank"
             style="width: 80px; height: auto; border-radius: 8px;">
        <p>Belum ada simulasi</p>
    @endif
</div>

        <div class="card-right">
            <h3>
                Rp {{ number_format($totalDeposito ?? 0, 0, ',', '.') }}
            </h3>

            <div class="info-row">
                <div>
                    Interest Income<br>
                    <strong>Rp {{ number_format($totalBunga ?? 0, 0, ',', '.') }}</strong>
                </div>

                @if($lastSimulation)
                <div>
                    Interest Rate<br>
                    <strong>{{ $lastSimulation->suku_bunga_dasar }}%</strong>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- QUICK ACTION --}}
    <div class="actions">
        <a href="/deposito" class="btn btn-gold">Simulasi Deposito</a>
        <a href="/riwayat" class="btn btn-dark">Riwayat Simulasi</a>
    </div>

    {{-- INSIGHT --}}
    <div class="insight-box">
        <strong>Insight Singkat</strong><br><br>
        Total Simulasi: {{ $totalSimulasi ?? 0 }}<br>
    </div>

    {{-- ABOUT --}}
    <div class="about">
        Huve adalah aplikasi simulasi deposito digital untuk membantu pengguna memperkirakan
        hasil investasi secara cepat dan terstruktur. Seluruh perhitungan bersifat simulasi.
    </div>

</div>
@endsection
