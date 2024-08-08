<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="card-header">
                <h4 class="my-1 float-left">Jaza Taarifa za Mwanachama</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.index')): ?>
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="<?php echo e(route('admin.members.index')); ?>" class="btn btn-outline-primary" title="List All">
                            <i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form action="<?php echo e(route('admin.members.store')); ?>" method="post" class="form">
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('backend.admin.viwawa.members.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/members/create.blade.php ENDPATH**/ ?>