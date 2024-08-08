<?php $__env->startSection('content'); ?>
    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lo!</strong> Kulikuwa na matatizo katika taarifa zako.<br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white h4">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Sasisha Jukumu</h4>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-list"></i> Majukumu Yote
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="col-md-12">
                <form action="<?php echo e(route('superadmin.roles.update', $role->id)); ?>" method="post" class="form">
                    <?php echo method_field('patch'); ?>
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('backend.superadmin.roles.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/roles/edit.blade.php ENDPATH**/ ?>