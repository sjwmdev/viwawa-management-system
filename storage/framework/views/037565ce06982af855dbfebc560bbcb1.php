<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ruhusa Zote</h4>
            <div class="btn-group btn-group-md float-right" role="group">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.create')): ?>
                    <a href="<?php echo e(route('superadmin.permissions.create')); ?>" class="btn btn-outline-light" title="Ongeza Ruhusa">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Ongeza Ruhusa
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="5%">Na.</th>
                        <th>Jina</th>
                        <th>Mlinzi</th>
                        <th width="5%" hidden>Vitendo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($permission->name); ?></td>
                            <td><?php echo e($permission->guard_name); ?></td>
                            <td hidden>
                                <div class="btn-group btn-group-md" role="group">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.edit.allowed')): ?>
                                        <a href="<?php echo e(route('superadmin.permissions.edit', $permission->id)); ?>"
                                            class="btn btn-outline-dark" title="Hariri">
                                            Hariri
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.destroy.allowed')): ?>
                                        <!-- Modal for confirmation before deletion -->
                                        <div class="modal fade" id="deleteModal<?php echo e($permission->id); ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Una uhakika unataka kufuta ruhusa hii?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Ghairi</button>
                                                        <form action="<?php echo e(route('superadmin.permissions.destroy', $permission->id)); ?>"
                                                            method="post">
                                                            <?php echo method_field('delete'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-danger">Futa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button to trigger the modal -->
                                        <button class="btn btn-outline-dark" title="Futa" data-toggle="modal"
                                            data-target="#deleteModal<?php echo e($permission->id); ?>">
                                            Futa
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/permissions/index.blade.php ENDPATH**/ ?>