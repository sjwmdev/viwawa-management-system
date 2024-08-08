<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            $(document).ready(function() {
                toastr.error('<?php echo e($error); ?>', '', {
                    positionClass: 'toast-top-right',
                    preventDuplicates: true,
                    timeOut: 6000,
                    extendedTimeOut: 900,
                });
            });
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(session('success')): ?>
    <script>
        $(document).ready(function() {
            toastr.success('<?php echo e(session('success')); ?>', '', {
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: 3000,
                extendedTimeOut: 600,
            });
        });
    </script>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/backend/layout/partials/_toastr_message.blade.php ENDPATH**/ ?>