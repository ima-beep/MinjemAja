

<?php $__env->startSection('title', 'Edit Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">👥 Edit Anggota</h1>

        <form method="POST" action="<?php echo e(route('teacher.members.update', $member->id)); ?>" style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Nama</label>
                <input type="text" name="name" value="<?php echo e(old('name', $member->name)); ?>" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', $member->email)); ?>" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">NISN</label>
                <input type="text" name="nisn" value="<?php echo e(old('nisn', $member->nisn)); ?>"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Status</label>
                <select name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                    <option value="active" <?php echo e(old('status', $member->status ?? 'active') === 'active' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="inactive" <?php echo e(old('status', $member->status ?? 'active') === 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div style="display: flex; gap: 12px; margin-top: auto; border-top: 1px solid #e5e7eb; padding-top: 24px;">
                <button type="submit" style="flex: 0 1 200px; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Simpan Perubahan
                </button>
                <a href="<?php echo e(route('teacher.members.index')); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/members/edit.blade.php ENDPATH**/ ?>