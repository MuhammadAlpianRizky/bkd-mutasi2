<?php $__env->startSection('content'); ?>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
    style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box row">
        <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
        </div>
        <div class="col-lg-5 col-md-7 bg-white">
            <div class="p-3">
                <div class="text-center">
                    <img src="../assets/images/big/icon.png" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">Login</h2>
                <p class="text-center">SIMUT BKD - Pemko Banjarmasin</p>
                
                <form class="mt-4" method="POST" action="<?php echo e(route('login')); ?>"> <!-- Updated route -->
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">NIP</label>
                                <input class="form-control" id="nip" name="nip" type="text" placeholder="Enter your NIP" required>
                                <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on">Password</label>
                                <input class="form-control" id="acc_on" name="acc_on" type="password" placeholder="Enter your password" required>
                                <?php $__errorArgs = ['acc_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <?php if(Route::has('password.request')): ?>
                            <div class="col-lg-12 text-center mb-3">
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Lupa Password?')); ?>

                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn w-100 btn-dark">Login</button>
                        </div>

                        <div class="col-lg-12 text-center mt-5">
                            Belum memiliki akun? <a href="<?php echo e(route('register')); ?>" class="text-danger">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Integration -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if($errors->any()): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            html: `
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            `,
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\Punya Alpian\bkd-mutasi2\resources\views/auth/login.blade.php ENDPATH**/ ?>