<!-- Card untuk Data Pribadi (Step 1) -->
<div id="step-1" class="card shadow-lg">
    <div class="card-header bg-dark text-white text-center">
        <h4 class="mb-0">Form Pengajuan Mutasi - Data Diri</h4>
    </div>
    <div class="card-body">
        <!-- Nama -->
        <div class="mb-4 row">
            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e(old('nama', $mutasi->nama)); ?>" required>
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- NIP -->
        <div class="mb-4 row">
            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="number" class="form-control" id="nip" name="nip" value="<?php echo e(old('nip', $mutasi->nip)); ?>" required>
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Pangkat/Gol. Ruang -->
        <div class="mb-4 row">
            <label for="pgol" class="col-sm-4 col-form-label">Pangkat/Gol. Ruang</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="pgol" name="pgol" value="<?php echo e(old('pgol', $mutasi->pgol)); ?>">
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['pgol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Jabatan -->
        <div class="mb-4 row">
            <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo e(old('jabatan', $mutasi->jabatan)); ?>">
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Unit Kerja -->
        <div class="mb-4 row">
            <label for="unit_kerja" class="col-sm-4 col-form-label">Unit Kerja</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="<?php echo e(old('unit_kerja', $mutasi->unit_kerja)); ?>">
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['unit_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Instansi -->
        <div class="mb-4 row">
            <label for="instansi" class="col-sm-4 col-form-label">Instansi</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" id="instansi" name="instansi" value="<?php echo e(old('instansi', $mutasi->instansi)); ?>">
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- No. HP -->
        <div class="mb-4 row">
            <label for="no_hp" class="col-sm-4 col-form-label">No. HP</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $mutasi->no_hp)); ?>" required>
                    <span class="input-group-text">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div><?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\partials\step1.blade.php ENDPATH**/ ?>