<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">            
            <div class="card-header">
                <h4 class="my-1 float-left">Ongeza Mwanachama</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="<?php echo e(route('superadmin.users.index')); ?>" class="btn btn-outline-primary" title="List All">
                            <i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form action="<?php echo e(route('superadmin.users.store')); ?>" method="post" class="form">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('backend.superadmin.users.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/users/create.blade.php ENDPATH**/ ?>