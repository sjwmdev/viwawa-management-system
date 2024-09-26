<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta tags -->
    <?php echo $__env->yieldContent('meta'); ?>

    <title>VMS</title>
    <!-- Google Font: Source Sans Pro Offline -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/fonts/source-sans-pro.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/custom.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/bs-stepper/css/bs-stepper.min.css')); ?>">

    <!-- CSS toastr alert -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.css')); ?>">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon">

    <?php echo $__env->yieldContent('css'); ?>
    <?php echo $__env->make('backend.layout.partials._preload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="hold-transition sidebar-mini layout-footer-fixed layout-navbar-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-md">
            <?php echo $__env->make('backend.layout.partials._navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </nav>

        <div id="leftsidebar">
            <?php echo $__env->make('backend.layout.partials._leftsidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <?php echo $__env->make('backend.layout.partials._breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <div class="content" style="margin-top: -2rem;">
                <div class="container-fluid">
                    <div class="box-body">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/dist/js/adminlte.min.js')); ?>"></script>

    <script src="<?php echo e(asset('adminlte/dist/icons/ionicons-esm.min')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/dist/icons/ionicons.min.js')); ?>"></script>

    <!-- JS and logic for toastr alert -->
    <script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>
    <?php echo $__env->make('backend.components.notification_dropdown_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.layout.partials._toastr_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {
            // Get the current state of the pushmenu
            var pushMenuState = localStorage.getItem('pushMenuState');

            // If the pushmenu is currently open, keep it open
            if (pushMenuState === 'open') {
                $('body').addClass('sidebar-collapse');
            }

            // Add a listener to the pushmenu button
            $('[data-widget="pushmenu"]').on('click', function() {
                // Get the new state of the pushmenu
                var newPushMenuState = $('body').hasClass('sidebar-collapse') ? 'closed' : 'open';

                // Save the new state of the pushmenu to local storage
                localStorage.setItem('pushMenuState', newPushMenuState);
            });
        });
    </script>

    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/layout/master.blade.php ENDPATH**/ ?>