<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MinjemAja</title>
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

        .tabs {
            display: flex;
            margin-bottom: 28px;
            border-bottom: 2px solid #e2e8f0;
        }

        .tab-button {
            flex: 1;
            padding: 14px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #64748b;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
        }

        .tab-button.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
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

        form { display: none; }
        form.active { display: block; }

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
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <div class="logo">📚</div>
        <h1>MinjemAja</h1>
        <p class="subtitle">Sistem Peminjaman Buku</p>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5;border:1px solid #10b981;color:#065f46;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="tabs">
        <button type="button" class="tab-button active" data-tab="guru-form">👨‍🏫 Admin</button>
        <button type="button" class="tab-button" data-tab="siswa-form">👨‍🎓 Siswa</button>
    </div>

    <!-- FORM ADMIN (sebelumnya: GURU) -->
    <form id="guru-form" method="POST" action="{{ route('login') }}" class="active">
        @csrf
        <input type="hidden" name="role" value="admin">

        <div class="form-group">
            <label>Email Admin</label>
            <input type="email" name="email" value="admin@gmail.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-group">
                <input type="password" name="password" required>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Login</button>
        </div>
    </form>

    <!-- FORM SISWA -->
    <form id="siswa-form" method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="role" value="student">

        <div class="form-group">
            <label>Email Siswa</label>
            <input type="email" name="email" value="siswa@test.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-group">
                <input type="password" name="password" required>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Login</button>
        </div>

        <div style="text-align: center; margin-top: 16px; color: #64748b; font-size: 13px;">
            Siswa tapi belum punya akun? <a href="{{ route('register') }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">Daftar dulu deh!</a>
        </div>
    </form>

    <div style="text-align: center; margin-top: 20px; color: #64748b; font-size: 14px;">
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

    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('form').forEach(f => f.classList.remove('active'));

            btn.classList.add('active');
            document.getElementById(btn.dataset.tab).classList.add('active');
        });
    });
</script>
</body>
</html>
