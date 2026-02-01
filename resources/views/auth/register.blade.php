<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MinjemAja</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #f3f4f6 0%, #eef2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(15,23,42,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 56px;
            margin-bottom: 16px;
        }

        h1 {
            color: #2563eb;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .error-box {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-box ul {
            list-style: none;
            padding: 0;
        }

        .error-box li {
            margin-bottom: 4px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 600;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input.error {
            border-color: #dc2626;
            background: #fef2f2;
        }

        .password-group {
            position: relative;
        }

        .password-group input {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            font-size: 18px;
            padding: 0;
        }

        .password-toggle:hover {
            color: #334155;
        }

        .form-actions {
            margin-top: 24px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: #2563eb;
            color: white;
            font-size: 15px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <div class="logo">📚</div>
        <h1>Daftar Siswa</h1>
        <p class="subtitle">Buat akun baru untuk meminjam buku</p>
    </div>

    @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required @error('name') class="error" @enderror>
            @error('name')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>NISN (Nomor Induk Siswa Nasional)</label>
            <input type="text" name="nisn" value="{{ old('nisn') }}" required @error('nisn') class="error" @enderror>
            @error('nisn')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required @error('email') class="error" @enderror>
            @error('email')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-group">
                <input type="password" name="password" required @error('password') class="error" @enderror>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
            @error('password')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="password-group">
                <input type="password" name="password_confirmation" required @error('password_confirmation') class="error" @enderror>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
            @error('password_confirmation')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Daftar</button>
        </div>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
</div>

<script>
    function togglePassword(btn) {
        const input = btn.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁️';
        }
    }
</script>
</body>
</html>
