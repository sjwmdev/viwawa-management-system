<?php $__env->startSection('content'); ?>
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
            <p class="mt-4">
                We could not find the page you were looking for. 
                Meanwhile, you may <a href="<?php echo e(route('common.dashboard')); ?>">return to dashboard</a>.
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/errors/404.blade.php ENDPATH**/ ?>