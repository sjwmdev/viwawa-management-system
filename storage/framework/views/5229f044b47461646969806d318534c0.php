<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Hariri Mchango wa Familia ya: <?php echo e($churchContribution->family_name); ?></h4>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.index')): ?>
                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <a href="<?php echo e(route('admin.church.contributions.index')); ?>" class="btn btn-outline-light"
                            title="Rudi kwenye orodha">
                            <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <?php if(isset($goalAmount)): ?>
                            <div class="alert alert-light text-dark k-lengo">
                                kiwango cha chini: <b> <?php echo e(number_format($goalAmount, 2)); ?> TZS</b>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <form action="<?php echo e(route('admin.church.contributions.update', $churchContribution->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <!-- Include the form partial -->
                    <?php echo $__env->make('backend.admin.viwawa.contributions.church.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.update')): ?>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-block btn-primary">Sasisha Mchango</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/church/edit.blade.php ENDPATH**/ ?>