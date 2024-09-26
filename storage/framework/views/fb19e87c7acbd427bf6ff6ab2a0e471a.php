<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VMS</title>
   
    <!-- All CSS -->
    <?php echo $__env->make('backend.auth.partials._allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header">
                VIWAWA MT. ZITA
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('login.authenticate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('backend.auth.partials._login_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
                <div class="mt-3 text-center" hidden>
                    <a href="" class="text-warning">Weka upya nenosiri lako</a>
                </div>
                <div class="mt-3 text-center" hidden>
                    <a href="<?php echo e(route('register')); ?>" style="color: var(--teal-blue); opacity: 0.8">Huna akaunti? Jisajili hapa</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- All JS -->
    <?php echo $__env->make('backend.auth.partials._alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/auth/login.blade.php ENDPATH**/ ?>