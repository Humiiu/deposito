<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Simulasi Deposito</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: radial-gradient(circle at top, #1a1a1a, #000);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #f5d78e;
        }

        .card {
            background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
            padding: 30px;
            width: 420px;
            border-radius: 16px;
            border: 1px solid #f5d78e55;
            box-shadow: 0 15px 40px rgba(0,0,0,0.85);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 1.5px;
        }

        label {
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
            color: #f5d78e;
        }

        input,
        select {
            width: 100%;
            height: 46px;                /* KUNCI UTAMA */
            line-height: 46px;           /* BIKIN TENGAH */
            padding: 0 12px;
            margin-bottom: 16px;
            border-radius: 9px;
            border: 1px solid #333;
            background: #0f0f0f;
            color: #f5d78e;
            outline: none;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        input::placeholder {
            color: #777;
        }

        input:focus,
        select:focus {
            border-color: #f5d78e;
            box-shadow: 0 0 0 1px #f5d78e44;
        }

        button {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #f5d78e, #c9a44c);
            color: #000;
            border: none;
            border-radius: 9px;
            font-weight: bold;
            letter-spacing: 1.2px;
            cursor: pointer;
            margin-top: 8px;
        }

        button:hover {
            opacity: 0.9;
        }

        .error {
            background: #3b0d0d;
            color: #ffb4b4;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .success {
            background: #0d3b1f;
            color: #9fffbf;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 18px;
            color: #777;
        }

        input:-webkit-autofill {
            -webkit-text-fill-color: #f5d78e;
            -webkit-box-shadow: 0 0 0px 1000px #0f0f0f inset;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>SIMULASI DEPOSITO</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

<form method="POST" action="/deposito">
    @csrf

    <label>Pilih Bank</label>
    <select name="bank_id" required>
        <option value="">-- Pilih Bank --</option>
        @foreach ($banks as $bank)
            <option value="{{ $bank->bank_id }}">
                {{ $bank->nama_bank }} ({{ $bank->suku_bunga_dasar }}%)
            </option>
        @endforeach
    </select>

    <label>Nominal Deposito</label>
    <input
        type="number"
        name="nominal_deposito"
        placeholder="Minimal 1.000.000"
        min="1000000"
        required
    >

    <label>Durasi (bulan)</label>
    <input
        type="number"
        name="jangka_waktu_bulan"
        placeholder="Contoh: 12"
        min="1"
        required
    >

    <button type="submit">HITUNG</button>
</form>
