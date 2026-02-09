<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Siswa')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8fafc;
            color: #1e293b;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 220px;
            background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 100%);
            padding: 20px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 16px rgba(59, 130, 246, 0.12);
            border-right: 2px solid #dbeafe;
        }

        .sidebar h3 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar hr {
            border: none;
            border-top: 2px solid #dbeafe;
            margin: 10px 0 16px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 8px;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            text-decoration: none;
            color: #475569;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #eff6ff;
            color: #1e40af;
            border-left-color: #3b82f6;
            transform: translateX(4px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            font-weight: 600;
            border-left-color: #3b82f6;
        }

        .logout-form {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }

        /* ================= PROFILE HEADER ================= */
        .profile-header {
            position: fixed;
            top: 20px;
            right: 30px;
            background: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 100;
            border: 1px solid #e2e8f0;
        }

        .profile-header .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
                overflow: hidden;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .profile-header .user-avatar:hover {
                transform: scale(1.1);
            }

            .profile-header .user-avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* ================= MODAL ================= */
            .modal {
                display: none;
                position: fixed;
                z-index: 200;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .modal.show {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .modal-content {
                background: white;
                padding: 28px;
                border-radius: 10px;
                max-width: 400px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }

            .modal-content h2 {
                margin: 0 0 16px;
                font-size: 18px;
                color: #1e293b;
            }

            .modal-content .form-group {
                margin-bottom: 16px;
            }

            .modal-content label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                font-size: 13px;
                color: #475569;
            }

            .modal-content input[type="file"] {
                width: 100%;
                padding: 8px;
                border: 2px dashed #cbd5e1;
                border-radius: 6px;
                font-size: 13px;
                cursor: pointer;
            }

            .modal-content input[type="file"]:hover {
                border-color: #3b82f6;
            }

            .modal-content .modal-buttons {
                display: flex;
                gap: 10px;
            }

            .modal-content button {
                flex: 1;
                padding: 10px;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                font-size: 13px;
                transition: all 0.3s ease;
            }

            .modal-content .btn-upload {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                color: white;
            }

            .modal-content .btn-upload:hover {
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
            }

            .modal-content .btn-cancel {
                background: #f1f5f9;
                color: #475569;
            }

            .modal-content .btn-cancel:hover {
                background: #e2e8f0;
        }

        .profile-header .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .profile-header .user-name {
            font-weight: 600;
            font-size: 13px;
            color: #1e293b;
        }

        .profile-header .user-role {
            font-size: 11px;
            color: #64748b;
        }

        /* ================= MAIN CONTENT ================= */
        .container {
            margin-left: 220px;
            padding: 32px;
            width: calc(100% - 220px);
            max-width: none;
            min-height: 100vh;
            margin-top: 0;
        }

        h1 {
            margin-bottom: 24px;
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        /* ================= CARD / BOX ================= */
        .card,
        .box {
            background: #ffffff;
            border-radius: 8px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .box h3 {
            margin-bottom: 16px;
            font-size: 16px;
            font-weight: 700;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 12px;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table thead {
            background: #f1f5f9;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        table th {
            font-weight: 600;
            color: #475569;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .container {
                margin-left: 200px;
                padding: 16px;
                width: calc(100% - 200px);
            }
        }
    </style>
</head>

<body>

<div style="display:flex; min-height:100vh">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <h3>Perpustakaan</h3>
        <div style="height:12px"></div>
        <div style="margin-bottom:12px;">
            <a href="{{ route('student.profile-photo.edit') }}" style="text-decoration:none;color:inherit;font-weight:600;">Profil</a>
        </div>
        <hr>

        <ul>
            <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('student.books.index') }}">Kumpulan Buku</a></li>
            <li><a href="{{ route('student.loans.index') }}">Peminjaman</a></li>
            <li><a href="{{ route('student.fines.index') }}">Denda</a></li>
            <li><a href="{{ route('student.reviews.index') }}">Rating / Review</a></li>
        </ul>

        <div class="logout-form">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    {{-- CONTENT --}}
    <main class="container">
        @yield('content')
    </main>

</div>

</body>
</html>
