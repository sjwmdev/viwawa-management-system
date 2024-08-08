<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="my-1 float-left">Majukumu ya Mfumo</h4>
                <div class="btn-group btn-group-md float-right" role="group">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.create')): ?>
                        <a href="<?php echo e(route('superadmin.roles.create')); ?>" class="btn btn-outline-light" title="Ongeza Jukumu Jipya">
                            <i class="fas fa-md fa-plus"></i>&nbsp;&nbsp;Ongeza Jukumu Jipya
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba.</th>
                            <th>Jina</th>
                            <th width="18%">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($role->name); ?></td>
                                <td>
                                    <div class="btn-group btn-group-md" role="group">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.show')): ?>
                                            <a href="<?php echo e(route('superadmin.roles.show', $role->id)); ?>" class="btn btn-outline-dark"
                                                title="Onyesha">
                                                Tazama
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.edit')): ?>
                                            <a href="<?php echo e(route('superadmin.roles.edit', $role->id)); ?>" class="btn btn-outline-dark"
                                                title="Hariri">
                                                Hariri
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.destroy')): ?>
                                            <button class="btn btn-outline-dark" title="Futa" data-toggle="modal"
                                                data-target="#deleteModal<?php echo e($role->id); ?>">
                                                Futa
                                            </button>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.destroy')): ?>
                                        <!-- Modal for confirmation before deletion -->
                                        <div class="modal fade" id="deleteModal<?php echo e($role->id); ?>" tabindex="-1"
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
                                                        Una uhakika unataka kufuta jukumu hili?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Ghairi</button>
                                                        <form action="<?php echo e(route('superadmin.roles.destroy', $role->id)); ?>"
                                                            method="post">
                                                            <?php echo method_field('delete'); ?>
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-danger">Futa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/roles/index.blade.php ENDPATH**/ ?>