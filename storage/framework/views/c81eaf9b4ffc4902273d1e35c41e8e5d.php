<!DOCTYPE html>
<html>

<head>
    <title>VMS</title>

    <?php $__currentLoopData = asset_files('adminlte/plugins', 'adminlte/dist/css'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $css): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <link rel="stylesheet" href="<?php echo e($css); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = asset_files('adminlte/plugins', 'adminlte/dist/js'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $js): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script src="<?php echo e($js); ?>"></script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <img src="<?php echo e(asset('images/preloader-05.gif')); ?>" alt="VIWAWA MT. ZITA" width="120px" height="120px">
    </div>
</body>

</html>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/layout/partials/_preload.blade.php ENDPATH**/ ?>