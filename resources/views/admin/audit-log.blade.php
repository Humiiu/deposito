@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: radial-gradient(circle at top, #1a1a1a, #000);
        color: #f5d78e;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    h2 {
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background: linear-gradient(135deg, #f5d78e, #c9a44c);
        color: #000;
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .table-container {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #f5d78e55;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #333;
    }

    th {
        background: #1a1a1a;
        color: #f5d78e;
        font-weight: bold;
    }

    td {
        color: #ccc;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: #aaa;
    }
</style>

<div class="container">

    <h2>AUDIT LOG</h2>

    <a href="/admin/dashboard" class="back-btn">← Back to Dashboard</a>

    <div class="table-container">
        @if($auditLogs->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Bank</th>
                    <th>Deposit Amount</th>
                    <th>Interest Rate</th>
                    <th>Simulation Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auditLogs as $log)
                <tr>
                    <td>{{ $log->username }}</td>
                    <td>{{ $log->nama_bank }}</td>
                    <td>Rp {{ number_format($log->nominal_deposito, 0, ',', '.') }}</td>
                    <td>{{ $log->suku_bunga_dasar }}%</td>
                    <td>{{ $log->waktu_simulasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            No audit logs available
        </div>
        @endif
    </div>

</div>
@endsection
