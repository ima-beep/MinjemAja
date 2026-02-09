

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

<?php $__env->startSection('title', 'Dashboard Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px;">

    <h1>📊 Dashboard Siswa</h1>

    
    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:20px; margin-bottom:32px;">

        <div class="stat-card">
            <div class="stat-info">
                <p>📚 Total Buku</p>
                <h2><?php echo e($totalBooks); ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>📋 Sedang Dipinjam</p>
                <h2><?php echo e($activeLoans); ?></h2>
            </div>
        </div>

    </div>

    
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:32px; align-items: center;">

        <!-- Pengembalian Menunggu Verifikasi (kiri) -->
        <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 1px solid #fcd34d; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="font-size: 32px; margin-bottom: 12px;">📦</div>
            <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #b45309;">Buku Menunggu Verifikasi</h3>
            <div style="font-size: 28px; font-weight: 700; color: #92400e; margin-bottom: 12px;"><?php echo e($pendingReturns); ?></div>
            <p style="margin: 0; font-size: 13px; color: #b45309;">
                Buku yang Anda minta untuk dikembalikan sedang menunggu persetujuan dari guru/admin.
            </p>
            <?php if($pendingReturns > 0): ?>
            <a href="<?php echo e(route('student.loans.index')); ?>" style="display: inline-block; margin-top: 12px; background: #b45309; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                Lihat Detail
            </a>
            <?php endif; ?>
        </div>

        <!-- Denda Belum Dibayar (tengah) -->
        <div style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 1px solid #fca5a5; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); justify-self: center; display:flex; flex-direction:column; align-items:center; text-align:center;">
            <div style="font-size: 32px; margin-bottom: 12px;">💰</div>
            <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #991b1b;">Denda Belum Dibayar</h3>
            <div style="font-size: 28px; font-weight: 700; color: #dc2626; margin-bottom: 12px;"><?php echo e($unpaidFines); ?></div>
            <p style="margin: 0; font-size: 13px; color: #991b1b;">
                Anda memiliki denda yang belum dibayar. Segera lakukan pembayaran.
            </p>
            <?php if($unpaidFines > 0): ?>
            <a href="<?php echo e(route('student.fines.index')); ?>" style="display: inline-block; margin-top: 12px; background: #dc2626; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                Bayar Sekarang
            </a>
            <?php endif; ?>
        </div>

        <!-- Denda Menunggu Persetujuan (kanan) -->
        <div style="background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%); border: 1px solid #fb923c; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); justify-self: end;">
            <div style="font-size: 32px; margin-bottom: 12px;">⏳</div>
            <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #92400e;">Denda Menunggu Persetujuan</h3>
            <div style="font-size: 28px; font-weight: 700; color: #92400e; margin-bottom: 12px;"><?php echo e($pendingPaymentFines); ?></div>
            <p style="margin: 0; font-size: 13px; color: #92400e;">
                Permintaan pembayaran denda Anda sedang dalam proses verifikasi dari guru/admin.
            </p>
            <?php if($pendingPaymentFines > 0): ?>
            <a href="<?php echo e(route('student.fines.index')); ?>" style="display: inline-block; margin-top: 12px; background: #92400e; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                Lihat Detail
            </a>
            <?php endif; ?>
        </div>

    </div>

    
    <?php if($loans->count() > 0): ?>
    <div class="box" style="margin-bottom: 32px;">
        <h3>Buku yang Sedang Dipinjam</h3>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong><?php echo e($loan->book->name); ?></strong></td>
                    <td><?php echo e($loan->book->author?->name ?? '-'); ?></td>
                    <td><?php echo e($loan->loan_date->format('d M Y')); ?></td>
                    <td><?php echo e($loan->return_date->format('d M Y')); ?></td>
                    <td>
                        <?php if($loan->status === 'active'): ?>
                            <span class="status-badge active">Aktif</span>
                        <?php else: ?>
                            <span class="status-badge returned">Dikembalikan</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 20px; margin-bottom: 32px; color: #1e40af;">
        <strong>ℹ️ Belum ada peminjaman</strong><br>
        <small>Anda belum meminjam buku. Kunjungi halaman <a href="<?php echo e(route('student.books.index')); ?>" style="color: #1e40af; text-decoration: underline;">Kumpulan Buku</a> untuk mulai meminjam.</small>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/dashboard/student.blade.php ENDPATH**/ ?>