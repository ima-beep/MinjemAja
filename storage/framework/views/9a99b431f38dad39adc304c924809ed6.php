

<?php $__env->startSection('title', 'Detail Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 100%;">
    <a href="<?php echo e(route('student.books.index')); ?>" style="color: #2563eb; text-decoration: none; font-weight: 600; margin-bottom: 16px; display: inline-block;">
        ← Kembali ke Daftar Buku
    </a>

    <div style="background: white; border-radius: 8px; padding: 24px; border: 1px solid #e2e8f0; margin-bottom: 24px;">

        
        <div style="display: flex; gap: 24px; margin-bottom: 24px;">

            
            <div style="width: 200px; height: 300px; background: #e5e7eb; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                <?php if($book->cover_image): ?>
                    <img src="<?php echo e(asset('storage/'.$book->cover_image)); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                <?php else: ?>
                    <div style="font-size: 64px;">📖</div>
                <?php endif; ?>
            </div>

            
            <div style="flex: 1;">
                <h1 style="margin: 0 0 16px; font-size: 28px;"><?php echo e($book->name); ?></h1>

                <p style="margin: 8px 0;"><strong>Pengarang:</strong> <?php echo e($book->author?->name ?? '-'); ?></p>
                <p style="margin: 8px 0;"><strong>Penerbit:</strong> <?php echo e($book->publisher?->name ?? '-'); ?></p>
                <p style="margin: 8px 0;"><strong>Kategori:</strong> <?php echo e($book->category?->name ?? '-'); ?></p>
                <p style="margin: 8px 0;"><strong>Tahun:</strong> <?php echo e($book->publication_date?->format('Y') ?? '-'); ?></p>
                <p style="margin: 8px 0;">
                    <strong>Stok:</strong> 
                    <?php if($book->stok > 0): ?>
                        <span style="color: #10b981; font-weight: 600;">✓ Tersedia (<?php echo e($book->stok); ?>)</span>
                    <?php else: ?>
                        <span style="color: #dc2626; font-weight: 600;">✗ Tidak Tersedia</span>
                    <?php endif; ?>
                </p>

                
                <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <?php if($loan): ?>
                        
                        <button disabled style="padding: 12px 24px; background: #fbbf24; color: #78350f; border: none; border-radius: 6px; font-weight: 600; cursor: default;">
                            ✓ Buku Dipinjam
                        </button>
                    <?php elseif($book->stok > 0): ?>
                        
                        <form method="POST" action="<?php echo e(route('student.books.borrow', $book->id)); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="padding: 12px 24px; background: #10b981; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                                📚 Pinjam Buku
                            </button>
                        </form>
                    <?php else: ?>
                        
                        <button disabled style="padding: 12px 24px; background: #d1d5db; color: #6b7280; border: none; border-radius: 6px; font-weight: 600; cursor: default;">
                            ❌ Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if($book->description): ?>
        <div style="border-top: 1px solid #e2e8f0; padding-top: 24px;">
            <h3 style="margin: 0 0 12px; font-size: 16px; font-weight: 700;">Deskripsi</h3>
            <p style="margin: 0; line-height: 1.6; color: #475569;"><?php echo e($book->description); ?></p>
        </div>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div style="background: #d1fae5; border: 1px solid #6ee7b7; border-radius: 8px; padding: 16px; color: #065f46;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 8px; padding: 16px; color: #991b1b;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/student/books/show.blade.php ENDPATH**/ ?>