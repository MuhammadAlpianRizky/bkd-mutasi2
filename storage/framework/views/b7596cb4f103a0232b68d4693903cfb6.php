<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Detail Pengguna: <?php echo e($user->nama_lengkap); ?></h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>NIP:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->nip); ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Alamat:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->alamat_tinggal); ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No HP:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->no_hp); ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Email:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->email); ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No KTP:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->no_ktp); ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No Karpeg:</strong>
        </div>
        <div class="col-md-8">
            <p><?php echo e($user->no_karpeg); ?></p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <strong>Foto KTP:</strong>
        </div>
        <div class="col-md-8">
            <?php if($user->photo_ktp): ?>
                <img src="<?php echo e(Storage::url(Crypt::decrypt($user->photo_ktp))); ?>" alt="Foto KTP" class="img-thumbnail" style="max-width: 300px; max-height: 200px; width: auto; height: auto;">
            <?php else: ?>
                <p>No photo available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <strong>Foto Karpeg:</strong>
        </div>
        <div class="col-md-8">
            <?php if($user->photo_karpeg): ?>
                <img src="<?php echo e(Storage::url(Crypt::decrypt($user->photo_karpeg))); ?>" alt="Foto Karpeg" class="img-thumbnail" style="max-width: 300px; max-height: 200px; width: auto; height: auto;">
            <?php else: ?>
                <p>No photo available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\admin\user_detail.blade.php ENDPATH**/ ?>