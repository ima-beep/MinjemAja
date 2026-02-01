

<?php $__env->startSection('title', 'QR Code Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">📱 QR Code Buku</h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Daftar Buku</h2>
                <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                    Total: <?php echo e(count($books)); ?> Buku
                </span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; background: #f8fafc;">
                        <h3 style="margin: 0 0 8px; font-size: 14px; font-weight: 600; color: #1e293b;"><?php echo e($book->name); ?></h3>
                        <p style="margin: 0 0 16px; font-size: 12px; color: #6b7280;"><?php echo e($book->author?->name ?? '-'); ?></p>
                        
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="<?php echo e(route('teacher.qrcode.show', $book->id)); ?>" style="flex: 1; padding: 8px 12px; background: #6366f1; color: #fff; border: none; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; text-align: center; cursor: pointer;">
                                Lihat QR
                            </a>
                            <a href="<?php echo e(route('teacher.qrcode.download', $book->id)); ?>" style="flex: 1; padding: 8px 12px; background: #10b981; color: #fff; border: none; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; text-align: center; cursor: pointer;">
                                Download
                            </a>
                            <a href="<?php echo e(route('teacher.qrcode.print', $book->id)); ?>" style="flex: 1; padding: 8px 12px; background: #3b82f6; color: #fff; border: none; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; text-align: center; cursor: pointer;">
                                Cetak
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/qrcode/index.blade.php ENDPATH**/ ?>