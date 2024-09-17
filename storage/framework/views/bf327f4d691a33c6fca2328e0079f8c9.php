<?php $__env->startSection('content'); ?>
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="<?php echo e(route('mutasi.update', $mutasi->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Card untuk Data Pribadi (Step 1) -->
                        <div id="step-1" class="card shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Pengajuan Mutasi - Data Diri</h4>
                            </div>
                            <div class="card-body">

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>


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
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $mutasi->no_hp)); ?>">
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
                                </div>

                                <!-- Button untuk Lanjut ke Step 2 -->
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary" id="next-btn" onclick="nextStep()">
                                        <i class="fas fa-arrow-right"></i> Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Card untuk Upload File (Step 2) -->
                        <div id="step-2" class="card d-none shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Pengajuan Mutasi - Upload Dokumen</h4>
                            </div>
                            <div class="card-body">
                                <?php $__currentLoopData = $persyaratans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persyaratan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label for="<?php echo e($persyaratan->id); ?>" class="form-label fw-bold"><?php echo e($persyaratan->nama_persyaratan); ?></label>

                                            <?php
                                                // Ambil path file dari tabel upload_persyaratan
                                                $uploadPersyaratan = $mutasi->uploads->where('persyaratan_id', $persyaratan->id)->first();
                                                $filePath = $uploadPersyaratan ? $uploadPersyaratan->file_path : null;
                                            ?>

                                            <?php if($filePath): ?>
                                                <!-- Jika file sudah di-upload -->
                                                <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                    <span>File sudah di-upload. Anda dapat <a href="<?php echo e(Storage::url($filePath)); ?>" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                    <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('<?php echo e($persyaratan->id); ?>')">Ubah File</button>
                                                </div>

                                                <!-- Kontainer input file untuk ubah file, tersembunyi secara default -->
                                                <div id="fileInputContainer-<?php echo e($persyaratan->id); ?>" style="display: none;">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="<?php echo e($persyaratan->id); ?>" name="persyaratan[<?php echo e($persyaratan->id); ?>]" accept=".<?php echo e($persyaratan->jenis_file); ?>"
                                                            aria-describedby="upload-help-<?php echo e($persyaratan->id); ?>" onchange="showFileLink('<?php echo e($persyaratan->id); ?>', 'view-<?php echo e($persyaratan->id); ?>')">
                                                        <span class="input-group-append">
                                                            <a id="view-<?php echo e($persyaratan->id); ?>" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <small id="upload-help-<?php echo e($persyaratan->id); ?>" class="form-text text-danger">Format <?php echo e(strtoupper($persyaratan->jenis_file)); ?>, ukuran maksimal <?php echo e($persyaratan->ukuran); ?>KB</small>
                                                </div>
                                            <?php else: ?>
                                                <!-- Jika file belum di-upload -->
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" id="<?php echo e($persyaratan->id); ?>" name="persyaratan[<?php echo e($persyaratan->id); ?>]" accept=".<?php echo e($persyaratan->jenis_file); ?>"
                                                        aria-describedby="upload-help-<?php echo e($persyaratan->id); ?>" onchange="showFileLink('<?php echo e($persyaratan->id); ?>', 'view-<?php echo e($persyaratan->id); ?>')">
                                                    <a id="view-<?php echo e($persyaratan->id); ?>" href="#" target="_blank" class="btn btn-outline-info d-none"
                                                    style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <small id="upload-help-<?php echo e($persyaratan->id); ?>" class="form-text text-danger">Format <?php echo e(strtoupper($persyaratan->jenis_file)); ?>, ukuran maksimal <?php echo e($persyaratan->ukuran); ?>KB</small>
                                            <?php endif; ?>

                                            <!-- Pesan error validasi -->
                                            <?php if($errors->has("persyaratan.{$persyaratan->id}")): ?>
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-triangle"></i> <?php echo e($errors->first("persyaratan.{$persyaratan->id}")); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" id="prev-btn" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                     <button type="submit" name="action" value="finish" class="btn btn-warning" id="finish-btn">
                                        <i class="fas fa-save"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo e(asset('js-mutasi/mutasi.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('users.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views/mutasi/edit-mutasi.blade.php ENDPATH**/ ?>