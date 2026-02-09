

<?php $__env->startSection('title', 'Ulasan Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">⭐ Ulasan Buku</h1>

        <?php if(session('success')): ?>
            <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; padding: 12px; margin-bottom: 20px; color: #166534;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Daftar Ulasan</h2>
                <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                    Total: <?php echo e(count($reviews)); ?> Ulasan
                </span>
            </div>

            <?php if($reviews->isEmpty()): ?>
                <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
                    <p style="font-size: 16px; margin: 0;">✓ Tidak ada ulasan</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Buku</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Pengguna</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Rating</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Ulasan</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px;"><?php echo e($r->book->name); ?></td>
                                <td style="padding: 12px;"><?php echo e($r->user->name); ?></td>
                                <td style="padding: 12px;">
                                    <span style="background: #fef3c7; color: #b45309; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                        <?php echo e($r->rating); ?> ⭐
                                    </span>
                                </td>
                                <td style="padding: 12px;"><?php echo e($r->review ?? '-'); ?></td>
                                <td style="padding: 12px;">
                                    <form method="POST" action="<?php echo e(route('admin.reviews.destroy', $r->id)); ?>" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" style="background:#ef4444;color:#fff;padding:6px 12px;border-radius:6px; border: none; text-decoration: none; font-size: 12px; font-weight: 600; cursor: pointer;">Hapus</button>
                                    </form>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>