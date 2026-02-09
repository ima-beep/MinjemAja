

<?php $__env->startSection('title', 'Detail Denda'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 100%; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">💰 Detail Denda</h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Anggota</p>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600;"><?php echo e($loan->guest_name); ?></h3>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Buku</p>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600;"><?php echo e($loan->book->name); ?></h3>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Tanggal Peminjaman</p>
                    <p style="margin: 0; font-size: 14px;"><?php echo e($loan->loan_date->format('d M Y')); ?></p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Tanggal Pengembalian</p>
                    <p style="margin: 0; font-size: 14px;"><?php echo e($loan->return_date->format('d M Y')); ?></p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Tanggal Jatuh Tempo</p>
                    <p style="margin: 0; font-size: 14px;"><?php echo e($loan->return_date->format('d M Y')); ?></p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Hari Terlambat</p>
                    <p style="margin: 0; font-size: 14px; color: #dc2626; font-weight: 600;"><?php echo e($daysDue); ?> hari</p>
                </div>
            </div>

            <div style="border-top: 2px solid #e2e8f0; padding-top: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div style="background: #fef2f2; padding: 16px; border-radius: 6px;">
                        <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Jumlah Denda</p>
                        <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #dc2626;">
                            Rp <?php echo e(number_format($fineAmount, 0, ',', '.')); ?>

                        </h2>
                    </div>
                    <div style="background: #f0fdf4; padding: 16px; border-radius: 6px;">
                        <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Sudah Dibayar</p>
                        <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #16a34a;">
                            Rp <?php echo e(number_format($loan->fine_amount_paid ?? 0, 0, ',', '.')); ?>

                        </h2>
                    </div>
                </div>
            </div>

            <div style="margin-top: 24px; border-top: 2px solid #e2e8f0; padding-top: 24px; display: flex; gap: 12px;">
                <a href="<?php echo e(route('admin.fines.edit', $loan->id)); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #3b82f6; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; text-align: center;">
                    Edit Pembayaran
                </a>
                <a href="<?php echo e(route('admin.fines.index')); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/admin/fines/show.blade.php ENDPATH**/ ?>