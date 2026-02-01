

<?php $__env->startSection('title', 'Kelola Denda'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">💰 Kelola Denda</h1>

        <?php if(session('success')): ?>
            <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; padding: 12px; margin-bottom: 20px; color: #166534;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Daftar Denda</h2>
                <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                    Total: <?php echo e(count($fines)); ?> Denda
                </span>
            </div>

            <?php if($fines->isEmpty()): ?>
                <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <p style="font-size: 16px; margin: 0;">✓ Tidak ada denda</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Anggota</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Buku</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Terlambat (Hari)</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Jumlah Denda</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Status</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $fines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 12px;"><?php echo e($fine->guest_name); ?></td>
                                    <td style="padding: 12px;"><?php echo e($fine->book->name); ?></td>
                                    <td style="padding: 12px;">
                                        <span style="background: #fed7aa; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                            <?php echo e($fine->getDaysDue()); ?> hari
                                        </span>
                                    </td>
                                    <td style="padding: 12px; font-weight: 600; color: #dc2626;">
                                        Rp <?php echo e(number_format($fine->getDaysDue() * 5000, 0, ',', '.')); ?>

                                    </td>
                                    <td style="padding: 12px;">
                                        <?php if($fine->fine_amount_paid > 0): ?>
                                            <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                ✓ Lunas
                                            </span>
                                        <?php else: ?>
                                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                Belum Bayar
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="padding: 12px;">
                                        <a href="<?php echo e(route('teacher.fines.edit', $fine->id)); ?>" style="background: #3b82f6; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-right: 8px;">
                                            Edit
                                        </a>
                                        <a href="<?php echo e(route('teacher.fines.show', $fine->id)); ?>" style="background: #6366f1; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block;">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/fines/index.blade.php ENDPATH**/ ?>