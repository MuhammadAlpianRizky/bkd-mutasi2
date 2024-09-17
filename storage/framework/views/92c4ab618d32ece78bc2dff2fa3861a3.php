<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .welcome-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .welcome-header h1 {
            font-size: 3rem;
            color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
        .alert {
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(auth()->guard()->guest()): ?>
        <?php if(session('alert')): ?>
                <div class="alert alert-<?php echo e(session('alert.type')); ?> alert-dismissible fade show" role="alert">
                    <?php echo e(session('alert.message')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="welcome-header">
                <h1>Welcome to Our Application</h1>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-custom btn-lg">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-custom btn-lg">Register</a>
            </div>
        <?php else: ?>
            <?php if(session('alert')): ?>
                <div class="alert alert-<?php echo e(session('alert.type')); ?> alert-dismissible fade show" role="alert">
                    <?php echo e(session('alert.message')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="welcome-header">
                <h1>Welcome <?php echo e(Auth::user()->name); ?></h1>
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-custom btn-lg">Dashboard</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\welcome.blade.php ENDPATH**/ ?>