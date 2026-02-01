

<?php $__env->startSection('title', 'Riwayat Peminjaman'); ?>

<?php $__env->startSection('content'); ?>


<div style="width: 100%; max-width: none; margin: 0; padding: 0;">

    <div>
        <h1 style="margin: 0 0 20px; font-size: 28px; color: #0f172a; font-weight: 700;">
            📋 Riwayat Peminjaman
        </h1>

        <?php if(session('success')): ?>
            <div style="margin-bottom: 16px; padding: 12px; border-radius: 8px; background: #dcfce7; color: #166534; font-weight: 600;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div style="margin-bottom: 16px; padding: 12px; border-radius: 8px; background: #fee2e2; color: #991b1b; font-weight: 600;">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <div style="background: #fff; border-radius: 10px; margin: 0 0 16px 0; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.05); border: 1px solid #e5e7eb;">
        <h3 style="margin: 0 0 12px; color: #0f172a; font-size: 15px; font-weight: 700; border-bottom: 2px solid #2563eb; padding-bottom: 8px;">
            Sedang Dipinjam (<?php echo e($activeLoans->count()); ?>)
        </h3>

        <?php if($activeLoans->count() > 0): ?>
            <table style="width:100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: #f1f5f9;">
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Judul Buku</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Pengarang</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Pinjam</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Kembali</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $activeLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding: 12px;"><strong><?php echo e($loan->book->name); ?></strong></td>
                        <td style="padding: 12px;"><?php echo e($loan->book->author?->name ?? '-'); ?></td>
                        <td style="padding: 12px;"><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                        <td style="padding: 12px; color: #dc2626; font-weight: 600;"><?php echo e($loan->return_date->format('d M Y')); ?></td>
                        <td style="padding: 12px;">
                            <form method="POST" action="<?php echo e(route('student.books.return', $loan->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    onclick="return confirm('Kembalikan buku ini?')"
                                    style="padding: 6px 12px; background: #f59e0b; color: #fff; border: none; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    Kembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color: #6b7280; text-align: center; padding: 20px; margin: 0;">
                Anda tidak sedang meminjam buku
            </p>
        <?php endif; ?>
    </div>

    
    <div style="background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.05); border: 1px solid #e5e7eb;">
        <h3 style="margin: 0 0 12px; color: #0f172a; font-size: 15px; font-weight: 700; border-bottom: 2px solid #2563eb; padding-bottom: 8px;">
            Riwayat Peminjaman (<?php echo e($returnedLoans->total()); ?>)
        </h3>

        <?php if($returnedLoans->count() > 0): ?>
            <table style="width:100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: #f1f5f9;">
                        <th style="padding: 12px;">Judul Buku</th>
                        <th style="padding: 12px;">Pengarang</th>
                        <th style="padding: 12px;">Tanggal Pinjam</th>
                        <th style="padding: 12px;">Tanggal Dikembalikan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $returnedLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding: 12px;"><strong><?php echo e($loan->book->name); ?></strong></td>
                        <td style="padding: 12px;"><?php echo e($loan->book->author?->name ?? '-'); ?></td>
                        <td style="padding: 12px;"><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                        <td style="padding: 12px;"><?php echo e($loan->actual_return_date?->format('d M Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <?php if($returnedLoans->hasPages()): ?>
                <div style="margin-top: 16px; display: flex; justify-content: center;">
                    <?php echo e($returnedLoans->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <p style="color: #6b7280; text-align: center; padding: 20px; margin: 0;">
                Belum ada riwayat peminjaman
            </p>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/loans/index.blade.php ENDPATH**/ ?>