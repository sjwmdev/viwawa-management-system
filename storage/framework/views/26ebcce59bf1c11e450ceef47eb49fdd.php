<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Ongeza Mchango wa Mwezi</h4>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.index')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <a href="<?php echo e(route('admin.monthly.contributions.index')); ?>" class="btn btn-outline-light" title="Michango yote">
                         Rudi Kwenye Orodha
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <?php if(isset($goalAmount)): ?>
                            <div class="alert alert-light text-danger k-lengo">
                                Kiasi cha Lengo: <?php echo e(number_format($goalAmount, 2)); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <form action="<?php echo e(route('admin.contributions.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <?php echo $__env->make('backend.admin.viwawa.contributions.monthly.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.store')): ?>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-block btn-primary">Hifadhi Mchango</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/contributions/monthly/create.blade.php ENDPATH**/ ?>