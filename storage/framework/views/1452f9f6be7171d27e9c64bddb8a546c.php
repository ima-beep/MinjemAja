<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard Guru'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8fafc;
            color: #1e293b;
        }
        
        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 100%);
            color: #1e293b;
            padding: 20px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            box-shadow: 2px 0 16px rgba(59, 130, 246, 0.12);
            border-right: 2px solid #dbeafe;
        }
        .sidebar h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: 700;
            color: #1e40af;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar hr {
            border: none;
            border-top: 2px solid #dbeafe;
            margin: 10px 0 15px 0;
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
            color: #475569;
            text-decoration: none;
            display: block;
            padding: 10px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover {
            background: #eff6ff;
            color: #1e40af;
            border-left-color: #3b82f6;
            transform: translateX(4px);
        }
        .sidebar a.active {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            font-weight: 600;
            border-left-color: #3b82f6;
        }
        .sidebar .nav-section {
            margin-top: 20px;
        }
        .sidebar .logout-form {
            margin-top: auto;
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }
        .logout-btn {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }
        
        /* CONTAINER */
        .container {
            margin-left: 220px;
            padding: 30px;
            min-height: 100vh;
        }
        
        /* CARD */
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .card p {
            margin: 0 0 8px 0;
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .card h2 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #2563eb;
        }
        
        /* BOX */
        .box {
            background: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .box h3 {
            margin: 0 0 16px 0;
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 12px;
        }
        
        /* TABLE */
        table {
            border-collapse: collapse;
            font-size: 14px;
        }
        table thead {
            background: #f1f5f9;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #cbd5e1;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        table tbody tr {
            transition: background 0.2s ease;
        }
        table tbody tr:hover {
            background: #f8fafc;
        }
        table small {
            color: #64748b;
        }
        
        /* HEADING */
        h1 {
            color: #1e293b;
            margin-bottom: 28px;
            font-size: 28px;
            font-weight: 700;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .container {
                margin-left: 200px;
                padding: 16px;
            }
            .grid-2 {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body>

<div style="display:flex; min-height:100vh">

    
    <aside class="sidebar">
        <h3>📚 Perpustakaan</h3>
        <hr>

        <ul>
            <li><a href="<?php echo e(route('teacher.dashboard')); ?>">Dashboard</a></li>
            <li><a href="<?php echo e(route('teacher.books.index')); ?>">Buku</a></li>
            <li><a href="<?php echo e(route('teacher.authors.index')); ?>">Pengarang</a></li>
            <li><a href="<?php echo e(route('teacher.publishers.index')); ?>">Penerbit</a></li>
            <li><a href="<?php echo e(route('teacher.categories.index')); ?>">Kategori</a></li>
            <li><a href="<?php echo e(route('teacher.loans.index')); ?>">Peminjaman</a></li>
            <li><a href="<?php echo e(route('teacher.fines.index')); ?>">Denda</a></li>
            <li><a href="<?php echo e(route('teacher.members.index')); ?>">Kelola Anggota</a></li>
        </ul>

        <div class="logout-form">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    
    <main class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/layouts/teacher.blade.php ENDPATH**/ ?>