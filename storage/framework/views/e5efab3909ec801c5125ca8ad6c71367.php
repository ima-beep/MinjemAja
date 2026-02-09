

<?php $__env->startSection('title', 'Manajemen Buku'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px;">

    <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">📚 Manajemen Buku</h1>

    
    <div style="margin-bottom: 24px;">
        <a href="<?php echo e(route('admin.books.create')); ?>"
           style="display:inline-block; padding:12px 24px; background:#2563eb; color:#fff;
                  text-decoration:none; border-radius:8px; font-weight:600; transition:all 0.3s;">
            + Tambah Buku
        </a>
    </div>

    
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;">
        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="background:#fff; border-radius:8px; overflow:hidden;
                        box-shadow:0 1px 3px rgba(0,0,0,.05); border:1px solid #e2e8f0;
                        display:flex; flex-direction:column;
                        transition:all 0.3s ease;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,.1)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,.05)'"
                 >
                
                <div style="width:100%; height:200px; background:#f1f5f9; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                    <?php if($book->cover_image): ?>
                        <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" 
                             style="width:100%; height:100%; object-fit:cover;"
                             alt="<?php echo e($book->name); ?>">
                    <?php else: ?>
                        <div style="text-align:center; color:#94a3b8;">
                            <div style="font-size:36px; margin-bottom:6px;">📖</div>
                            <p style="margin:0; font-size:11px;">Tidak ada cover</p>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div style="padding:12px; flex:1; display:flex; flex-direction:column;">
                    <h3 style="margin:0 0 6px; font-size:13px; font-weight:700; line-height:1.3; color:#1e293b;">
                        <?php echo e($book->name); ?>

                    </h3>

                    <p style="margin:0 0 4px; font-size:11px; color:#64748b;">
                        ✍️ <?php echo e($book->author->name ?? '-'); ?>

                    </p>

                    <p style="margin:0 0 4px; font-size:11px; color:#64748b;">
                        🏢 <?php echo e($book->publisher->name ?? '-'); ?>

                    </p>

                    <p style="margin:0 0 6px; font-size:11px; color:#64748b;">
                        📅 <?php echo e($book->publication_date ? $book->publication_date->format('Y') : '-'); ?>

                    </p>

                    <div style="background:#eff6ff; border:1px solid #bfdbfe; color:#1e40af;
                                padding:6px 10px; border-radius:6px; font-size:11px; font-weight:600; text-align:center;">
                        Stok: <?php echo e($book->stok ?? 0); ?>

                    </div>

                    
                    <div style="display:flex; gap:6px; margin-top:auto; padding-top:8px;">
                        <a href="<?php echo e(route('admin.books.edit', $book->id)); ?>"
                           style="flex:1; padding:6px 10px; background:#2563eb; color:#fff;
                                  text-align:center; text-decoration:none; border-radius:6px;
                                  font-size:12px; font-weight:600; transition:all 0.3s;"
                           onmouseover="this.style.background='#1d4ed8'"
                           onmouseout="this.style.background='#2563eb'">
                            Edit
                        </a>

                        <form method="POST"
                              action="<?php echo e(route('admin.books.destroy', $book->id)); ?>"
                              onsubmit="return confirm('Yakin hapus buku ini?')"
                              style="flex:1;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                style="width:100%; padding:6px 10px; background:#ef4444; color:#fff;
                                       border:none; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;
                                       transition:all 0.3s;"
                                onmouseover="this.style.background='#dc2626'"
                                onmouseout="this.style.background='#ef4444'">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <div style="grid-column:1/-1; padding:60px 40px; text-align:center;
                        background:#fff; border-radius:8px; border:1px solid #e2e8f0;">
                <div style="font-size:64px; margin-bottom:16px;">📚</div>
                <p style="color:#64748b; margin:0 0 8px; font-size:16px; font-weight:600;">
                    Belum ada buku
                </p>
                <p style="color:#94a3b8; margin:0; font-size:14px;">
                    Tambahkan buku pertama Anda dengan klik tombol "Tambah Buku" di atas
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/admin/books/index.blade.php ENDPATH**/ ?>