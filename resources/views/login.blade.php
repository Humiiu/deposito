<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

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
            padding: 32px;
            width: 420px;
            border-radius: 16px;
            border: 1px solid #f5d78e55;
            box-shadow: 0 15px 40px rgba(0,0,0,0.85);
        }

        h2 {
            text-align: center;
            margin-bottom: 26px;
            letter-spacing: 1.5px;
        }

        label {
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
            color: #f5d78e;
        }

        input {
            width: 100%;
            height: 46px;
            line-height: 46px;
            padding: 0 12px;
            margin-bottom: 18px;
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

        input:focus {
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
            margin-bottom: 18px;
            font-size: 13px;
            text-align: center;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 20px;
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
    <h2>LOGIN</h2>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">LOGIN</button>
    </form>

    <div class="footer">
            
    </div>
</div>

</body>
</html>
