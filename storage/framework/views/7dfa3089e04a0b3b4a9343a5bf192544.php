<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Aina za Mapato</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.type.store')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" title="Ongeza Aina Mpya" data-toggle="modal" data-target="#addIncomeTypeModal">
                            <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>
                            Ongeza Aina Mpya
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba.</th>
                            <th>Jina</th>
                            <th>Maelezo</th>
                            <th>Kitambulisho</th>
                            <th class="not-printable" width="10%">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $incomeTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($type->name); ?></td>
                                <td><?php echo e($type->description); ?></td>
                                <td><?php echo e($type->identifier); ?></td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-md" title="Hariri Aina" data-toggle="modal" data-target="#editIncomeTypeModal<?php echo e($type->id); ?>">
                                        Hariri
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.type.store')): ?>
        <!-- Add Income Type Modal -->
        <div class="modal fade" id="addIncomeTypeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addIncomeTypeModalLabel">Ongeza Aina Mpya ya Mapato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo e(route('admin.incomes.type.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Jina la Aina</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Maelezo</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="identifier">Kitambulisho</label>
                                <input type="text" name="identifier" id="identifier" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ongeza Aina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.type.update')): ?>
        <!-- Edit Income Type Modal -->
        <?php $__currentLoopData = $incomeTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="editIncomeTypeModal<?php echo e($type->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editIncomeTypeModalLabel<?php echo e($type->id); ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editIncomeTypeModalLabel<?php echo e($type->id); ?>">Hariri Aina ya Mapato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?php echo e(route('admin.incomes.type.update', $type->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <div class="form-group">
                                    <label for="name">Jina la Aina</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e($type->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Maelezo</label>
                                    <textarea name="description" id="description" class="form-control" rows="3"><?php echo e($type->description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="identifier">Kitambulisho</label>
                                    <input type="text" name="identifier" id="identifier" class="form-control" value="<?php echo e($type->identifier); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Hifadhi Mabadiliko</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/incomes/type.blade.php ENDPATH**/ ?>