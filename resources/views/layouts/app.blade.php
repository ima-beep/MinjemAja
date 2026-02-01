<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MinjemAja')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            margin: 0;
            background: #f3f4f6;
        }

        header {
            background: #ffffff;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .logo {
            font-weight: 700;
            font-size: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .nav a, .nav button {
            margin-left: 12px;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .btn-login {
            background: #2563eb;
            color: #fff;
        }

        .btn-register {
            border: 2px solid #2563eb;
            color: #2563eb;
        }

        .btn-register:hover {
            background: #2563eb;
            color: #fff;
        }

        .nav button {
            background: #2563eb;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        main {
            padding: 40px 16px;
            margin-top: 70px;
        }

        @media (min-width: 768px) {
            body.logged-in main {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body class="@auth logged-in @endauth">

<header>
    <a href="{{ route('dashboard') }}" class="logo">📚 MinjemAja</a>

    <div class="nav">
        @auth
            <span style="margin-right: 16px; color: #333;">Halo, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-login">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Daftar</a>
        @endauth
    </div>
</header>

@include('layouts.sidebar')

<main>
    @yield('content')
</main>

</body>
</html>
