<!-- resources/views/partials/alert.blade.php -->
<?php if(session('alert')): ?>
    <div class="alert alert-<?php echo e(session('alert.type')); ?> alert-dismissible fade show" role="alert">
        <?php echo e(session('alert.message')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\partials\alert.blade.php ENDPATH**/ ?>