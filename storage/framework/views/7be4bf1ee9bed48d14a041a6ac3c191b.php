

<?php $__env->startSection('title', 'Ulasan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1000px;">
    <h1>⭐ Rating & Review</h1>

    <?php if(session('success')): ?>
        <div style="background:#dcfce7; border:1px solid #86efac; padding:12px; border-radius:6px; margin-bottom:12px; color:#166534;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="box" style="margin-bottom:20px;">
        <h3>Buku yang bisa Anda ulas</h3>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Pengarang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong><?php echo e($book->name); ?></strong></td>
                    <td><?php echo e($book->author?->name ?? '-'); ?></td>
                    <td>
                        <?php $existing = $reviews->firstWhere('book_id', $book->id); ?>
                        <?php if($existing): ?>
                            <span style="background:#d1fae5; color:#065f46; padding:6px 10px; border-radius:6px;">Sudah Diulas</span>
                        <?php else: ?>
                            <a href="<?php echo e(route('student.reviews.create', $book->id)); ?>" style="background:#2563eb; color:#fff; padding:6px 10px; border-radius:6px; text-decoration:none;">Ulasan</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="box">
        <h3>Ulasan Anda</h3>
        <?php if($reviews->isEmpty()): ?>
            <p>Belum ada ulasan.</p>
        <?php else: ?>
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($r->book->name); ?></td>
                        <td><?php echo e($r->rating); ?> ⭐</td>
                        <td><?php echo e($r->review ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/reviews/index.blade.php ENDPATH**/ ?>