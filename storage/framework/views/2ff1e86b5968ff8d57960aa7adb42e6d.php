

<?php $__env->startSection('title', 'Kumpulan Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 100%;">
    <h1>📚 Kumpulan Buku</h1>

    
    <div style="background: white; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
        <input type="text" id="searchBooks" placeholder="Cari judul, pengarang, atau penerbit..." 
            style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
    </div>

    
    <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:16px;">
        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div data-url="<?php echo e(route('student.books.show', $book->id)); ?>" style="border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; cursor:pointer; transition:all 0.3s ease; height:100%;" 
                onclick="location.href=this.dataset.url"
                onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'; this.style.transform='translateY(-4px)'" 
                onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">>
                
                
                <div style="width:100%; height:200px; background:#e5e7eb; display:flex; align-items:center; justify-content:center;">
                    <?php if($book->cover_image): ?>
                        <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" style="width:100%; height:100%; object-fit:cover;">
                    <?php else: ?>
                        <div style="font-size:64px;">📖</div>
                    <?php endif; ?>
                </div>

                
                <div style="padding:12px;">
                    <h4 style="margin:0 0 4px; font-size:14px; font-weight:600;"><?php echo e($book->name); ?></h4>
                    <p style="margin:0 0 4px; font-size:12px; color:#6b7280;">
                        <strong><?php echo e($book->author?->name ?? '-'); ?></strong>
                    </p>
                    <p style="margin:0 0 8px; font-size:12px; color:#6b7280;">
                        <?php echo e($book->publisher?->name ?? '-'); ?>

                    </p>
                    <p style="margin:0; font-size:12px; color:#2563eb; font-weight:600;">
                        <?php if($book->stok > 0): ?>
                            ✓ Tersedia (<?php echo e($book->stok); ?>)
                        <?php else: ?>
                            ✗ Tidak Tersedia
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: #6b7280;">
                <p style="font-size: 16px; margin: 0;">📚 Belum ada buku</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
document.getElementById('searchBooks')?.addEventListener('keyup', function(e) {
    const search = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('div[data-url]');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (search === '') {
            card.style.display = '';
        } else {
            card.style.display = text.includes(search) ? '' : 'none';
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/books/index.blade.php ENDPATH**/ ?>