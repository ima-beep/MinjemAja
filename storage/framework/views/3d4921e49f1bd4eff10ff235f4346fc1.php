

<?php $__env->startSection('title', 'Detail Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 100%; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">👥 Detail Anggota</h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Nama</p>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600;"><?php echo e($member->name); ?></h3>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Email</p>
                    <p style="margin: 0; font-size: 14px;"><?php echo e($member->email); ?></p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">NISN</p>
                    <p style="margin: 0; font-size: 14px;"><?php echo e($member->nisn ?? '-'); ?></p>
                </div>
            </div>

            <div style="border-top: 2px solid #e2e8f0; padding-top: 24px; margin-bottom: 24px;">
                <h3 style="margin: 0 0 16px; font-size: 16px; font-weight: 600;">Riwayat Peminjaman</h3>
                
                <?php if($loans->isEmpty()): ?>
                    <p style="margin: 0; color: #6b7280; text-align: center; padding: 20px;">Belum ada peminjaman</p>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f1f5f9;">
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Buku</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Tanggal Peminjaman</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Jatuh Tempo</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="border-bottom: 1px solid #e2e8f0;">
                                        <td style="padding: 12px;"><?php echo e($loan->book->name); ?></td>
                                        <td style="padding: 12px;"><?php echo e(optional($loan->loan_date)->format('d M Y') ?? '-'); ?></td>
                                        <td style="padding: 12px;"><?php echo e(optional($loan->return_date)->format('d M Y') ?? '-'); ?></td>
                                        <td style="padding: 12px;">
                                            <?php if($loan->status === 'returned'): ?>
                                                <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                    ✓ Dikembalikan
                                                </span>
                                            <?php else: ?>
                                                <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                    Dipinjam
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div style="display: flex; gap: 12px;">
                <a href="<?php echo e(route('teacher.members.edit', $member->id)); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #3b82f6; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; text-align: center;">
                    Edit Data
                </a>
                <a href="<?php echo e(route('teacher.members.index')); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/members/show.blade.php ENDPATH**/ ?>