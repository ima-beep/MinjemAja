

<?php $__env->startPush('styles'); ?>
<style>
.stat-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: white;
    border-radius: 8px;
    padding: 40px 32px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    text-align: center;
    min-height: 200px;
}
.stat-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}
.stat-info {
    flex: 1;
}
.stat-info p {
    margin: 0 0 14px 0;
    font-size: 14px;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.stat-info h2 {
    margin: 0;
    font-size: 56px;
    font-weight: 700;
    color: #2563eb;
}
.stat-icon {
    font-size: 48px;
    margin-left: 20px;
    opacity: 0.8;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-badge.active {
    background: #fef3c7;
    color: #92400e;
}
.status-badge.returned {
    background: #d1fae5;
    color: #065f46;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px;">

    <h1>📊 Dashboard Admin</h1>

    
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:32px;">

        <div class="stat-card">
            <div class="stat-info">
                <p>📚 Total Buku</p>
                <h2><?php echo e($totalBooks); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>👨‍🎓 Total Siswa</p>
                <h2><?php echo e($totalStudents); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>📖 Peminjaman Aktif</p>
                <h2><?php echo e($activeLoans); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>✓ Dikembalikan</p>
                <h2><?php echo e($returnedLoans); ?></h2>
            </div>
        </div>

    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:32px;" class="grid-2">

        
        <div class="box">
            <h3>📖 Peminjaman Terbaru</h3>

            <table width="100%">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($loan->book->name); ?></strong><br>
                                <small><?php echo e($loan->book->author->name ?? '-'); ?></small>
                            </td>
                            <td><?php echo e($loan->loan_date->format('d/m/Y')); ?></td>
                            <td>
                                <span class="status-badge <?php echo e($loan->status === 'active' ? 'active' : 'returned'); ?>">
                                    <?php echo e($loan->status === 'active' ? 'Aktif' : 'Dikembalikan'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" style="text-align:center; padding:20px; color:#64748b;">
                                Belum ada peminjaman
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="box">
            <h3>👨‍🎓 Siswa Sedang Meminjam</h3>

            <table width="100%">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Buku</th>
                        <th>Tgl Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $activeStudentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loan->guest_name); ?></td>
                            <td><?php echo e($loan->book->name); ?></td>
                            <td><?php echo e($loan->return_date->format('d/m/Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" style="text-align:center; padding:20px; color:#64748b;">
                                Tidak ada siswa yang meminjam
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>