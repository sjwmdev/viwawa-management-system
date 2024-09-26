<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Aina za Michango</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.type.store')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button class="btn btn-outline-light" title="Ongeza Aina ya Michango" data-toggle="modal" data-target="#addContributionTypeModal">
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
                            <th>Malengo</th>
                            <th>Kiasi cha Malengo</th>
                            <th>Kitambulisho</th>
                            <th class="not-printable" width="10%">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contributionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($type->name); ?></td>
                                <td><?php echo e($type->goal ?? 'Hakuna'); ?></td>
                                <td><?php echo e(number_format($type->goal_amount, 2) ?? '0.00'); ?></td>
                                <td><?php echo e($type->identifier); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.type.update')): ?>
                                        <button class="btn btn-outline-secondary btn-md" title="Hariri Aina ya Michango"
                                            data-toggle="modal" data-target="#editContributionTypeModal<?php echo e($type->id); ?>">
                                            Hariri
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.type.store')): ?>
        <!-- Add Contribution Type Modal -->
        <div class="modal fade" id="addContributionTypeModal" tabindex="-1" role="dialog" aria-labelledby="addContributionTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContributionTypeModalLabel">Ongeza Aina ya Michango</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo e(route('admin.contributions.type.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Jina la Aina</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="goal">Malengo</label>
                                <textarea name="goal" id="goal" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="goal_amount">Kiasi cha Malengo (TZS)</label>
                                <input type="number" name="goal_amount" id="goal_amount" class="form-control" step="0.01">
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

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.type.update')): ?>
        <?php $__currentLoopData = $contributionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Edit Contribution Type Modal -->
            <div class="modal fade" id="editContributionTypeModal<?php echo e($type->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editContributionTypeModalLabel<?php echo e($type->id); ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editContributionTypeModalLabel<?php echo e($type->id); ?>">Hariri Aina ya Michango</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?php echo e(route('admin.contributions.type.update', $type->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                
                                <div class="form-group">
                                    <label for="name">Jina la Aina</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e($type->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="goal">Malengo</label>
                                    <textarea name="goal" id="goal" class="form-control"><?php echo e($type->goal); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="goal_amount">Kiasi cha Malengo (TZS)</label>
                                    <input type="number" name="goal_amount" id="goal_amount" class="form-control" step="0.01" value="<?php echo e($type->goal_amount); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="identifier">Kitambulisho</label>
                                    <input type="text" name="identifier" id="identifier" class="form-control" value="<?php echo e($type->identifier); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Hariri Aina</button>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/type.blade.php ENDPATH**/ ?>