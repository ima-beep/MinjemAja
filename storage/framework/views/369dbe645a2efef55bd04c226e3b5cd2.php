

<?php $__env->startSection('title', 'Denda Saya'); ?>

<?php $__env->startSection('content'); ?>
<h1>💰 Kelola Denda</h1>

<div class="box">
    <h3>Daftar Denda</h3>
    
    <?php if($fines->isEmpty()): ?>
        <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 14px;">📭 Tidak ada denda untuk Anda.</p>
        </div>
    <?php else: ?>
        <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
            Total: <?php echo e(count($fines)); ?> Denda
        </span>
        
        <table style="margin-top: 16px;">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Terlambat (Hari)</th>
                    <th>Jumlah Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $fines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td><?php echo e($fine->book->name); ?></td>
                    <td>
                        <span style="background: #fed7aa; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                            <?php echo e($fine->getDaysDue()); ?> hari
                        </span>
                    </td>
                    <td style="font-weight: 600; color: #dc2626;">
                        Rp <?php echo e(number_format($fine->getDaysDue() * 5000, 0, ',', '.')); ?>

                    </td>
                    <td>
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
                    <td>
                        <?php if($fine->fine_amount_paid <= 0): ?>
                            <form method="POST" action="<?php echo e(route('student.fines.pay', $fine->id)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" style="background: #3b82f6; color: #fff; padding: 6px 12px; border-radius: 6px; border: none; text-decoration: none; font-size: 12px; font-weight: 600; cursor: pointer;">
                                    Bayar Denda
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/fines/index.blade.php ENDPATH**/ ?>