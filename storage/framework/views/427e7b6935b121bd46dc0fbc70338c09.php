

<?php $__env->startSection('title', 'QR Code - ' . $book->name); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 100%; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">📱 QR Code Buku</h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div>
                    <h2 style="margin: 0 0 16px; font-size: 16px; font-weight: 600;">Detail Buku</h2>
                    <div style="display: grid; gap: 12px;">
                        <div>
                            <p style="margin: 0 0 4px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Judul</p>
                            <p style="margin: 0; font-size: 14px;"><?php echo e($book->name); ?></p>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Pengarang</p>
                            <p style="margin: 0; font-size: 14px;"><?php echo e($book->author?->name ?? '-'); ?></p>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Penerbit</p>
                            <p style="margin: 0; font-size: 14px;"><?php echo e($book->publisher?->name ?? '-'); ?></p>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Kategori</p>
                            <p style="margin: 0; font-size: 14px;"><?php echo e($book->category?->name ?? '-'); ?></p>
                        </div>
                    </div>
                </div>

                <div style="text-align: center;">
                    <h2 style="margin: 0 0 16px; font-size: 16px; font-weight: 600;">QR Code</h2>
                    <?php if(isset($qrCodeUrl)): ?>
                        <div style="padding: 16px; background: #f8fafc; border-radius: 8px; display: inline-block;">
                            <img src="<?php echo e($qrCodeUrl); ?>" alt="QR Code" style="max-width: 300px; height: auto;">
                        </div>
                    <?php else: ?>
                        <div style="padding: 40px; background: #f1f5f9; border-radius: 8px; border: 2px dashed #cbd5e1;">
                            <p style="margin: 0; color: #6b7280;">QR Code belum tersedia</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div style="margin-top: 24px; border-top: 2px solid #e2e8f0; padding-top: 24px; display: flex; gap: 12px;">
                <a href="<?php echo e(route('teacher.qrcode.download', $book->id)); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #10b981; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; text-align: center;">
                    Download QR Code
                </a>
                <a href="<?php echo e(route('teacher.qrcode.print', $book->id)); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #3b82f6; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none; text-align: center;">
                    Cetak QR Code
                </a>
                <a href="<?php echo e(route('teacher.qrcode.index')); ?>" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/qrcode/show.blade.php ENDPATH**/ ?>