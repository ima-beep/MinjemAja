

<?php $__env->startSection('title', 'Kelola Anggota'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">👥 Kelola Anggota</h1>

        <?php if(session('success')): ?>
            <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; padding: 12px; margin-bottom: 20px; color: #166534;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Daftar Anggota</h2>
                <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                    Total: <?php echo e(count($members)); ?> Anggota
                </span>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Nama</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Email</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">NISN</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Status</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px;"><?php echo e($member->name); ?></td>
                                <td style="padding: 12px;"><?php echo e($member->email); ?></td>
                                <td style="padding: 12px;"><?php echo e($member->nisn ?? '-'); ?></td>
                                <td style="padding: 12px;">
                                    <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                        Aktif
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <a href="<?php echo e(route('teacher.members.show', $member->id)); ?>" style="background: #6366f1; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-right: 8px;">
                                        Detail
                                    </a>
                                    <a href="<?php echo e(route('teacher.members.edit', $member->id)); ?>" style="background: #3b82f6; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-right: 8px;">
                                        Edit
                                    </a>
                                    <form method="POST" action="<?php echo e(route('teacher.members.destroy', $member->id)); ?>" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini?')" style="background: #ef4444; color: #fff; padding: 6px 12px; border: none; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td colspan="5" style="padding: 40px 12px; text-align: center; color: #6b7280;">
                                    Tidak ada anggota
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/members/index.blade.php ENDPATH**/ ?>