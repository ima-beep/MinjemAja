<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MinjemAja</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        /* Make select look like inputs */
        select {
            width: 100%;
            padding: 12px 40px 12px 14px; /* extra right padding for arrow */
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            background: #ffffff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364758b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>") no-repeat calc(100% - 12px) center;
            background-size: 12px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
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
            font-size: 18px;
            color: #64748b;
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
            margin-top: 12px;
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

    <?php if($errors->any()): ?>
        <div class="error-box">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('register.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>NISN (Nomor Induk Siswa Nasional)</label>
            <input type="text" name="nisn" value="<?php echo e(old('nisn')); ?>" required <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
            <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select id="kelas-select" name="kelas" required <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                <option value="">Pilih Kelas</option>
                <option value="X" <?php echo e(old('kelas')=='X' ? 'selected' : ''); ?>>X</option>
                <option value="XI" <?php echo e(old('kelas')=='XI' ? 'selected' : ''); ?>>XI</option>
                <option value="XII" <?php echo e(old('kelas')=='XII' ? 'selected' : ''); ?>>XII</option>
            </select>
            <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Jurusan</label>
            <select id="jurusan-select" name="jurusan" required <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                <option value="">Pilih Jurusan</option>
                <optgroup label="TSM">
                    <option value="TSM 1" <?php echo e(old('jurusan')=='TSM 1' ? 'selected' : ''); ?>>TSM 1</option>
                    <option value="TSM 2" <?php echo e(old('jurusan')=='TSM 2' ? 'selected' : ''); ?>>TSM 2</option>
                    <option value="TSM 3" <?php echo e(old('jurusan')=='TSM 3' ? 'selected' : ''); ?>>TSM 3</option>
                </optgroup>
                <optgroup label="TKR">
                    <option value="TKR 1" <?php echo e(old('jurusan')=='TKR 1' ? 'selected' : ''); ?>>TKR 1</option>
                    <option value="TKR 2" <?php echo e(old('jurusan')=='TKR 2' ? 'selected' : ''); ?>>TKR 2</option>
                    <option value="TKR 3" <?php echo e(old('jurusan')=='TKR 3' ? 'selected' : ''); ?>>TKR 3</option>
                </optgroup>
                <optgroup label="ATPH">
                    <option value="ATPH 1" <?php echo e(old('jurusan')=='ATPH 1' ? 'selected' : ''); ?>>ATPH 1</option>
                    <option value="ATPH 2" <?php echo e(old('jurusan')=='ATPH 2' ? 'selected' : ''); ?>>ATPH 2</option>
                </optgroup>
                <optgroup label="APT">
                    <option value="APT 1" <?php echo e(old('jurusan')=='APT 1' ? 'selected' : ''); ?>>APT 1</option>
                    <option value="APT 2" <?php echo e(old('jurusan')=='APT 2' ? 'selected' : ''); ?>>APT 2</option>
                </optgroup>
                <optgroup label="DKV">
                    <option value="DKV 1" <?php echo e(old('jurusan')=='DKV 1' ? 'selected' : ''); ?>>DKV 1</option>
                    <option value="DKV 2" <?php echo e(old('jurusan')=='DKV 2' ? 'selected' : ''); ?>>DKV 2</option>
                    <option value="DKV 3" data-only-for-class="X" style="display:none;" <?php echo e(old('jurusan')=='DKV 3' ? 'selected' : ''); ?>>DKV 3</option>
                </optgroup>
                <optgroup label="TKJ">
                    <option value="TKJ 1" <?php echo e(old('jurusan')=='TKJ 1' ? 'selected' : ''); ?>>TKJ 1</option>
                    <option value="TKJ 2" <?php echo e(old('jurusan')=='TKJ 2' ? 'selected' : ''); ?>>TKJ 2</option>
                </optgroup>
                <optgroup label="RPL">
                    <option value="RPL 1" <?php echo e(old('jurusan')=='RPL 1' ? 'selected' : ''); ?>>RPL 1</option>
                    <option value="RPL 2" <?php echo e(old('jurusan')=='RPL 2' ? 'selected' : ''); ?>>RPL 2</option>
                </optgroup>
            </select>
            <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> class="error" <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-group">
                <input type="password" name="password" required>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small style="color:#dc2626"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="password-group">
                <input type="password" name="password_confirmation" required>
                <button type="button" class="password-toggle" onclick="togglePassword(this)">👁️</button>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Daftar</button>
        </div>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Login di sini</a>
    </div>

</div>

<script>
    function togglePassword(btn) {
        const input = btn.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.textContent = input.type === 'password' ? '👁️' : '🙈';
    }
</script>
<script>
    // Show DKV 3 only when kelas == X
    (function(){
        const kelas = document.getElementById('kelas-select');
        const jurusan = document.getElementById('jurusan-select');

        if (!kelas || !jurusan) return;

        function updateJurusanOptions() {
            const selectedKelas = kelas.value;
            const options = jurusan.querySelectorAll('option[data-only-for-class]');
            options.forEach(opt => {
                const onlyFor = opt.getAttribute('data-only-for-class');
                if (onlyFor && onlyFor.split(',').map(s=>s.trim()).includes(selectedKelas)) {
                    opt.style.display = '';
                } else {
                    // if currently selected but now hidden, reset selection
                    if (opt.selected) {
                        jurusan.selectedIndex = 0;
                    }
                    opt.style.display = 'none';
                }
            });
        }

        kelas.addEventListener('change', updateJurusanOptions);
        // initialize on load
        updateJurusanOptions();
    })();
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/auth/register.blade.php ENDPATH**/ ?>