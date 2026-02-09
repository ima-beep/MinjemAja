

<?php $__env->startSection('title', 'Tulis Ulasan'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">✍️ Beri Ulasan untuk <?php echo e($book->name); ?></h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05); max-width:800px;">
            <form method="POST" action="<?php echo e(route('student.reviews.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">

                <label style="display:block; font-weight:600; margin-bottom:8px;">Rating</label>
                <select name="rating" style="padding:8px; width:120px; margin-bottom:16px;">
                    <?php for($i=5;$i>=1;$i--): ?>
                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?> ⭐</option>
                    <?php endfor; ?>
                </select>

                <label style="display:block; font-weight:600; margin:8px 0;">Ulasan (lebih panjang dianjurkan)</label>
                <textarea name="review" rows="8" placeholder="Tulis pengalaman Anda dengan buku ini..." style="width:100%; padding:12px; border:1px solid #e5e7eb; border-radius:6px; resize:vertical; margin-bottom:16px;"></textarea>

                <div style="display:flex; gap:12px;">
                    <button type="submit" style="background:#10b981; color:#fff; padding:10px 16px; border-radius:8px; border:none; font-weight:600;">Kirim Ulasan</button>
                    <a href="<?php echo e(route('student.reviews.index')); ?>" style="background:#ef4444; color:#fff; padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/reviews/create.blade.php ENDPATH**/ ?>