<?php $__env->startSection('content'); ?>
    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <strong>Lo!</strong> Kulikuwa na matatizo katika taarifa zako.<br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ongeza Jukumu Jipya</h4>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                <div class="btn-group btn-group-md float-right" role="group">
                    <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-list"></i> Majukumu Yote
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <form action="<?php echo e(route('superadmin.roles.store')); ?>" method="post" class="form">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('backend.superadmin.roles.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/roles/create.blade.php ENDPATH**/ ?>