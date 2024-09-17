<!-- resources/views/partials/modal.blade.php -->

<div class="modal fade" id="<?php echo e($id ?? 'modal'); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo e($titleId ?? 'modalTitle'); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?php echo e($titleId ?? 'modalTitle'); ?>"><?php echo e($title ?? 'Modal Title'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo e($slot); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="<?php echo e($id ?? 'modal'); ?>-action" class="btn btn-primary" data-bs-dismiss="modal">
                    <?php echo e($saveButtonText ?? 'Save changes'); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\partials\modal.blade.php ENDPATH**/ ?>