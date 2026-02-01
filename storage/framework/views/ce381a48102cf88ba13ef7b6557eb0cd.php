

<?php $__env->startSection('title', 'Edit Pembayaran Denda'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">💰 Edit Pembayaran Denda</h1>

        <form method="POST" action="<?php echo e(route('teacher.fines.update', $loan->id)); ?>" style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Anggota</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;"><?php echo e($loan->guest_name); ?></p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Buku</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;"><?php echo e($loan->book->name); ?></p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Hari Terlambat</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;"><?php echo e($daysDue); ?> hari</p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Jumlah Denda</label>
                <p style="margin: 0; padding: 10px 12px; background: #fef2f2; border-radius: 6px; color: #dc2626; font-weight: 600;">
                    Rp <?php echo e(number_format($fineAmount, 0, ',', '.')); ?>

                </p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Jumlah Dibayar</label>
                <input type="number" name="amount_paid" value="<?php echo e(old('amount_paid', $loan->fine_amount_paid ?? 0)); ?>" min="0" max="<?php echo e($fineAmount); ?>" step="1000" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <?php $__errorArgs = ['amount_paid'];
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
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Tanggal Pembayaran</label>
                <input type="date" name="payment_date" value="<?php echo e(old('payment_date', $loan->fine_payment_date ? $loan->fine_payment_date->format('Y-m-d') : now()->format('Y-m-d'))); ?>" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <?php $__errorArgs = ['payment_date'];
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

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Catatan</label>
                <textarea name="notes" rows="4" placeholder="Catatan pembayaran denda" 
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; font-family: inherit; resize: vertical;"><?php echo e(old('notes', $loan->fine_notes ?? '')); ?></textarea>
                <?php $__errorArgs = ['notes'];
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
                    Simpan Pembayaran
                </button>
                <a href="<?php echo e(route('teacher.fines.index')); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/fines/edit.blade.php ENDPATH**/ ?>