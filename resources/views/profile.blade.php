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

    .form-container {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border-radius: 18px;
        padding: 30px;
        border: 1px solid #f5d78e55;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #f5d78e;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #f5d78e55;
        border-radius: 8px;
        background: #1a1a1a;
        color: #f5d78e;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #f5d78e;
        box-shadow: 0 0 0 2px rgba(245,215,142,0.2);
    }

    .btn {
        padding: 14px;
        text-align: center;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        letter-spacing: 1px;
        cursor: pointer;
        border: none;
        font-size: 14px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #f5d78e, #c9a44c);
        color: #000;
        width: 100%;
        margin-bottom: 15px;
    }

    .btn-danger {
        background: #dc3545;
        color: #fff;
        width: 100%;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>

<div class="container">

    <div class="header">
        <h2>PROFILE</h2>
        <div class="nav">
            <a href="/dashboard">Dashboard</a>
            <a href="/deposito">Deposito</a>
            <a href="/riwayat">Riwayat</a>
            <a href="/profile" class="active">Profile</a>
        </div>
    </div>

    <div class="welcome-text">
        MANAGE YOUR ACCOUNT
    </div>

    {{-- PROFILE FORM --}}
    <div class="form-container">
        <form method="POST" action="/profile/update">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">New Password (leave empty to keep current)</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        {{-- LOGOUT --}}
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

</div>
@endsection
