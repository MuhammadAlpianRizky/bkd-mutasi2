<?php $__env->startSection('content'); ?>
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="<?php echo e(route('mutasi.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

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
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e(old('nama', $user->nama_lengkap)); ?>" required>
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
                                            <input type="number" class="form-control" id="nip" name="nip" value="<?php echo e(old('nip', $user->nip)); ?>" required>
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
                                            <input type="text" class="form-control" id="pgol" name="pgol">
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
                                            <input type="text" class="form-control" id="jabatan" name="jabatan">
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
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja">
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
                                            <input type="text" class="form-control" id="instansi" name="instansi" value="<?php echo e(old('instansi')); ?>">
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
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $user->no_hp)); ?>" required>
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
                                    <button type="button" class="btn btn-dark" onclick="nextStep()">
                                        <i class="fas fa-arrow-right"></i> Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card untuk Upload File (Step 2) -->
                        <div id="step-2" class="card d-none shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Pengajuan Mutasi - Upload Dokumen </h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="mb-4">
                                    <label for="sk_cpns" class="form-label">Copy + legalisir SK CPNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf"
                                            onchange="showFileLink('sk_cpns', 'view-sk_cpns')">
                                        <span class="input-group-append">
                                            <a id="view-sk_cpns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_cpns')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_cpns')); ?></div>
                                    <?php endif; ?>
                                </div>


                                
                                <div class="mb-4">
                                    <label for="sk_pns" class="form-label">Copy + legalisir SK PNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf"
                                            onchange="showFileLink('sk_pns', 'view-sk_pns')">
                                        <span class="input-group-append">
                                            <a id="view-sk_pns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_pns')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_pns')); ?></div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="mb-4">
                                    <label for="sk_pangkat_terakhir" class="form-label">Copy + legalisir SK Pangkat Terakhir</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_pangkat_terakhir" name="sk_pangkat_terakhir" accept=".pdf"
                                            onchange="showFileLink('sk_pangkat_terakhir', 'view-sk_pangkat_terakhir')">
                                        <span class="input-group-append">
                                            <a id="view-sk_pangkat_terakhir" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_pangkat_terakhir')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_pangkat_terakhir')); ?></div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="mb-4">
                                    <label for="sk_jabatan_struktural" class="form-label">Copy + legalisir SK Jabatan Struktural</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_jabatan_struktural" name="sk_jabatan_struktural" accept=".pdf"
                                            onchange="showFileLink('sk_jabatan_struktural', 'view-sk_jabatan_struktural')">
                                        <span class="input-group-append">
                                            <a id="view-sk_jabatan_struktural" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_jabatan_struktural')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_jabatan_struktural')); ?></div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="mb-4">
                                    <label for="sk_jabatan_fungsional" class="form-label">Copy + legalisir SK Jabatan Fungsional</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_jabatan_fungsional" name="sk_jabatan_fungsional" accept=".pdf"
                                            onchange="showFileLink('sk_jabatan_fungsional', 'view-sk_jabatan_fungsional')">
                                        <span class="input-group-append">
                                            <a id="view-sk_jabatan_fungsional" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_jabatan_fungsional')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_jabatan_fungsional')); ?></div>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="mb-4">
                                    <label for="sk_berkala_terakhir" class="form-label">Copy + legalisir SK Berkala Terakhir</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_berkala_terakhir" name="sk_berkala_terakhir" accept=".pdf"
                                            onchange="showFileLink('sk_berkala_terakhir', 'view-sk_berkala_terakhir')">
                                        <span class="input-group-append">
                                            <a id="view-sk_berkala_terakhir" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    <?php if($errors->has('sk_berkala_terakhir')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('sk_berkala_terakhir')); ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="previousStep()" id="prev-btn">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
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

<?php echo $__env->make('users.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\Punya Alpian\bkd-mutasi2\resources\views/mutasi/create-mutasi.blade.php ENDPATH**/ ?>