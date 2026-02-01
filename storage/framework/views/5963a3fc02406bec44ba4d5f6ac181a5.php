

<?php $__env->startSection('title', 'Detail Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 800px; margin: 0 auto; padding: 0 16px;">

    
    <?php if(session('success')): ?>
        <div style="margin-bottom:16px;padding:12px;border-radius:8px;background:#ecfdf5;color:#065f46;font-weight:600;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div style="margin-bottom:16px;padding:12px;border-radius:8px;background:#fef2f2;color:#991b1b;font-weight:600;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.05);overflow:hidden">

        
        <div style="padding:24px;border-bottom:1px solid #e5e7eb;display:flex;gap:24px">

            
            <div style="width:180px;height:260px;background:#e5e7eb;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center">
                <?php if($book->cover_image): ?>
                    <img src="<?php echo e(asset('storage/'.$book->cover_image)); ?>"
                         style="width:100%;height:100%;object-fit:cover;border-radius:8px">
                <?php else: ?>
                    📖
                <?php endif; ?>
            </div>

            
            <div style="flex:1">
                <h1 style="margin:0 0 8px;font-size:24px"><?php echo e($book->name); ?></h1>

                <p><strong>Penulis:</strong> <?php echo e($book->author?->name ?? '-'); ?></p>
                <p><strong>Penerbit:</strong> <?php echo e($book->publisher?->name ?? '-'); ?></p>
                <p><strong>Kategori:</strong> <?php echo e($book->category?->name ?? '-'); ?></p>
                <p><strong>Stok:</strong> <?php echo e($book->stok); ?></p>

                
                <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap">
                    <button onclick="history.back()"
                        style="padding:8px 16px;background:#e5e7eb;border:none;border-radius:6px;font-weight:600;cursor:pointer">
                        ← Kembali
                    </button>
                </div>
            </div>
        </div>

        
        <?php if($book->description): ?>
        <div style="padding:24px">
            <h3>Deskripsi</h3>
            <p style="line-height:1.6"><?php echo e($book->description); ?></p>
        </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/books/show.blade.php ENDPATH**/ ?>