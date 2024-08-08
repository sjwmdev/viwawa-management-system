<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ruhusa Mpya</h4>
            <div class="btn-group btn-group-md float-right" role="group">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.index')): ?>
                    <a href="<?php echo e(route('superadmin.permissions.index')); ?>" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;&nbsp;Ruhusa Zote
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <form action="<?php echo e(route('superadmin.permissions.store')); ?>" method="post" class="form">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('backend.superadmin.permissions.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/permissions/create.blade.php ENDPATH**/ ?>