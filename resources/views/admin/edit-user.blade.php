@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: radial-gradient(circle at top, #1a1a1a, #000);
        color: #f5d78e;
    }

    .container {
        max-width: 600px;
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

    .form-container {
        background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
        border-radius: 12px;
        padding: 30px;
        border: 1px solid #f5d78e55;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #f5d78e;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 12px;
        border: 1px solid #f5d78e55;
        border-radius: 8px;
        background: #1a1a1a;
        color: #f5d78e;
        font-size: 14px;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #f5d78e;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #f5d78e, #c9a44c);
        color: #000;
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid #f5d78e55;
        color: #f5d78e;
        margin-left: 10px;
    }

    .form-actions {
        text-align: right;
        margin-top: 30px;
    }
</style>

<div class="container">

    <h2>EDIT USER</h2>

    <a href="/admin/users" class="back-btn">← Back to Users</a>

    <div class="form-container">
        <form method="POST" action="/admin/users/{{ $user->user_id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="/admin/users" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
