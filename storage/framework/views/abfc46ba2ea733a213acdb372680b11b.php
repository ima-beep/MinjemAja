

<?php $__env->startSection('title', 'Penerbit'); ?>
<?php $__env->startSection('page_title', 'Manajemen Penerbit'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">

        <!-- Add Publisher Button -->
        <div style="margin-bottom: 20px;">
            <a href="<?php echo e(route('teacher.publishers.create')); ?>"
               style="display: inline-block; padding: 10px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                + Tambah Penerbit
            </a>
        </div>

<?php if(session('success')): ?>
<div style="margin-bottom:16px;padding:12px;background:#dcfce7;color:#166534;border-radius:6px">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div style="margin-bottom:16px;padding:12px;background:#fee2e2;color:#991b1b;border-radius:6px">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>


<?php if($publishers->count() === 0): ?>
<div style="
    background:#fff;
    border-radius:10px;
    padding:32px;
    text-align:center;
    color:#6b7280;
    border:1px solid #e5e7eb;
">
    Belum ada penerbit
</div>
<?php else: ?>


<?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div style="background:#fff;border-radius:10px;margin-bottom:16px;border:1px solid #e5e7eb">

<div style="padding:16px;display:flex;justify-content:space-between;align-items:center;background:#f8fafc">
    <div>
        <h3 style="margin:0;color:#0f172a"><?php echo e($publisher->name); ?></h3>
        <p style="margin:4px 0;color:#6b7280;font-size:14px">
            <?php echo e(data_get($publisher,'address','-')); ?>

        </p>
        <p style="margin:0;color:#6b7280;font-size:14px">
            <?php echo e(data_get($publisher,'phone','-')); ?> |
            <?php echo e(data_get($publisher,'email','-')); ?>

        </p>
        <small style="color:#6b7280">
            <?php echo e($publisher->books->count()); ?> buku
        </small>
    </div>

    <div style="display:flex;gap:8px">
        <button class="btn-toggle-books"
            data-id="<?php echo e($publisher->id); ?>"
            style="flex:0 0 140px;padding:8px 12px;background:#10b981;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
            📚 Lihat (<?php echo e($publisher->books->count()); ?>)
        </button>

        <a href="<?php echo e(route('teacher.publishers.edit',$publisher)); ?>"
           style="flex:0 0 80px;padding:8px 12px;background:#2563eb;color:#fff;border-radius:4px;font-size:12px;text-decoration:none;text-align:center;font-weight:600;">
           Edit
        </a>

        <form method="POST" action="<?php echo e(route('teacher.publishers.destroy',$publisher)); ?>" style="flex:0 0 80px;">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button onclick="return confirm('Hapus penerbit?')"
                style="width:100%;padding:8px 12px;background:#dc2626;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
                Hapus
            </button>
        </form>
    </div>
</div>

<div id="books-<?php echo e($publisher->id); ?>" style="display:none;margin-top:16px;background:#fff;border-radius:10px;padding:20px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
        <div>
            <strong style="font-size:16px;">Buku <?php echo e($publisher->name); ?></strong>
            <p style="margin:4px 0 0;font-size:14px;color:#6b7280;">
                Total: <strong style="color:#2563eb;"><?php echo e($publisher->books->count()); ?></strong> buku terdaftar
            </p>
        </div>
        <button onclick="document.getElementById('books-<?php echo e($publisher->id); ?>').style.display='none'"
            style="background:#e5e7eb;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;">
            Tutup
        </button>
    </div>

    <?php if($publisher->books->count() > 0): ?>
        <div style="display:grid;grid-template-columns:repeat(4, 1fr);gap:16px;">
            <?php $__currentLoopData = $publisher->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('teacher.books.show', $book->id)); ?>" style="text-decoration: none; color: inherit;">
                    <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;height:100%;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';this.style.transform='translateY(-4px)';this.style.borderColor='#2563eb';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='#e5e7eb';">
                        <div style="width:100%;height:150px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;">
                            <?php if($book->cover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                                <div style="font-size:32px;">📖</div>
                            <?php endif; ?>
                        </div>
                        <div style="padding:12px;">
                            <h4 style="margin:0 0 4px;font-size:14px;"><?php echo e($book->name); ?></h4>
                            <p style="margin:0;font-size:12px;color:#6b7280;">
                                Penulis: <?php echo e($book->author?->name ?? '-'); ?>

                            </p>
                            <p style="margin:0;font-size:12px;color:#6b7280;">
                                <?php echo e($book->publication_date?->format('d M Y') ?? '-'); ?>

                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p style="color:#6b7280;font-style:italic;">Belum ada buku diterbitkan oleh penerbit ini</p>
    <?php endif; ?>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-toggle-books').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const el = document.getElementById('books-' + id);
            el.style.display = el.style.display === 'none' || el.style.display === '' ? 'block' : 'none';
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.teacher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ukk-peminjaman-buku\resources\views/teacher/publishers/index.blade.php ENDPATH**/ ?>