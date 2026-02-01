

<?php $__env->startSection('title', 'Pinjaman Saya'); ?>
<?php $__env->startSection('page_title', 'Riwayat Pinjaman Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">

    
    <?php if(session('success')): ?>
        <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:6px;padding:12px;margin-bottom:16px;color:#047857;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:6px;padding:12px;margin-bottom:16px;color:#dc2626;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:24px;">
        <h2 style="margin-top:0;color:#dc2626;">
            📌 Peminjaman Aktif (<?php echo e($activeLoans->count()); ?>)
        </h2>

        <?php if($activeLoans->count()): ?>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                            <th style="padding:12px;text-align:left;">Judul Buku</th>
                            <th style="padding:12px;">Peminjam</th>
                            <th style="padding:12px;">Tanggal Pinjam</th>
                            <th style="padding:12px;">Batas Kembali</th>
                            <th style="padding:12px;text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:12px;">
                                    <strong><?php echo e($loan->book->name); ?></strong><br>
                                    <small><?php echo e($loan->book->author?->name ?? '-'); ?></small>
                                </td>
                                <td style="padding:12px;">
                                    <strong><?php echo e($loan->guest_name); ?></strong><br>
                                    <small><?php echo e($loan->guest_class); ?></small>
                                </td>

                                <td style="padding:12px;">
                                    <?php echo e(optional($loan->loan_date)->format('d M Y') ?? '-'); ?>

                                </td>

                                
                                <td style="padding:12px;">
                                    <?php if(optional($loan->return_date)->isPast()): ?>
                                        <span style="color:#dc2626;font-weight:600;">
                                            <?php echo e(optional($loan->return_date)->format('d M Y')); ?> ⚠️
                                        </span>
                                    <?php else: ?>
                                        <span style="color:#059669;font-weight:600;">
                                            <?php echo e(optional($loan->return_date)->format('d M Y') ?? '-'); ?> ✓
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td style="text-align:center;">
                                    <span style="background:#fef3c7;color:#92400e;padding:4px 8px;border-radius:4px;font-size:12px;">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="text-align:center;color:#6b7280;">Tidak ada peminjaman aktif.</p>
        <?php endif; ?>
    </div>

    
    <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h2 style="margin-top:0;color:#10b981;">✅ Riwayat Pengembalian</h2>

        <?php if($returnedLoans->count()): ?>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                            <th style="padding:12px;">Judul Buku</th>
                            <th style="padding:12px;">Peminjam</th>
                            <th style="padding:12px;">Tanggal Pinjam</th>
                            <th style="padding:12px;">Tanggal Kembali</th>
                            <th style="padding:12px;text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $returnedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:12px;">
                                    <strong><?php echo e($loan->book->name); ?></strong>
                                </td>
                                <td style="padding:12px;">
                                    <strong><?php echo e($loan->guest_name); ?></strong><br>
                                    <small><?php echo e($loan->guest_class); ?></small>
                                </td>
                                <td style="padding:12px;">
                                    <?php echo e(optional($loan->loan_date)->format('d M Y') ?? '-'); ?>

                                </td>
                                <td style="padding:12px;">
                                    <?php echo e(optional($loan->actual_return_date)->format('d M Y') ?? '-'); ?>

                                </td>
                                <td style="text-align:center;">
                                    <span style="background:#d1fae5;color:#047857;padding:4px 8px;border-radius:4px;font-size:12px;">
                                        Dikembalikan
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div style="margin-top:16px;display:flex;justify-content:center;">
                    <?php echo e($returnedLoans->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <p style="text-align:center;color:#6b7280;">Belum ada riwayat pengembalian.</p>
        <?php endif; ?>
    </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/loans/index.blade.php ENDPATH**/ ?>