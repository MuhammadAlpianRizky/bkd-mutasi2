<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <h2 class="mb-4">Riwayat Mutasi</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Alert jika ada pesan error -->
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tombol Tambah Mutasi -->
        <div class="mb-4">
            <a href="<?php echo e(route('mutasi.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mutasi
            </a>
        </div>

        <!-- Tabel Riwayat Mutasi -->
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tambahkan kelas table-responsive untuk tabel yang lebih responsif -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Registrasi</th>
                                <th>Tanggal Diajukan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $mutasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($item->no_registrasi); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d-m-Y')); ?></td>
                                    <td>
                                        <?php switch($item->status):
                                            case ('draft'): ?>
                                                <span class="badge bg-secondary">Draft</span>
                                                <?php break; ?>
                                            <?php case ('proses'): ?>
                                                <span class="badge bg-info">Proses</span>
                                                <?php break; ?>
                                            <?php case ('diterima'): ?>
                                                <span class="badge bg-success">Diterima</span>
                                                <?php break; ?>
                                            <?php case ('ditolak'): ?>
                                                <span class="badge bg-danger">Ditolak</span>
                                                <?php break; ?>
                                            <?php case ('dibatalkan'): ?>
                                                <span class="badge bg-dark">Dibatalkan</span>
                                                <?php break; ?>
                                            <?php default: ?>
                                                <span class="badge bg-light text-dark">Unknown</span>
                                        <?php endswitch; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('mutasi.edit', $item->id)); ?>"
                                        class="btn <?php echo e($item->is_final ? 'btn-secondary' : 'btn-warning'); ?> btn-sm">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                    </td>
                                    <td><?php echo e($item->keterangan); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php
    $noFooter = true;
?>

<?php echo $__env->make('users.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views/mutasi/index.blade.php ENDPATH**/ ?>