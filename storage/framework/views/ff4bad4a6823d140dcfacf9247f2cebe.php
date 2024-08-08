<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="card-header">
                <h4 class="my-1 float-left">Maelezo ya Jukumu</h4>
                <div class="float-right">
                    <div class="btn-group btn-group-md" role="group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                            <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="btn btn-outline-light" title="Orodha ya Majukumu">
                                <i class="fas fa-list"></i> Majukumu Yote
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.create')): ?>
                            <a href="<?php echo e(route('superadmin.roles.create')); ?>" class="btn btn-outline-light" title="Ongeza Jukumu Jipya">
                                <i class="fas fa-plus"></i> Ongeza Jukumu Jipya
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item h4"><?php echo e(ucfirst($role->name)); ?></li>
                    <?php if($rolePermissions->count() > 0): ?>
                        <li class="list-group-item">
                            <div class="container mt-3 float-left table-container">
                                <h4>Ruhusa Zilizotolewa</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="70%">Jina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($permission->name); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="list-group-item text-center">Hakuna ruhusa zilizotolewa</li>
                    <?php endif; ?>
                </ul>
                <div class="float-right mt-4">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.edit')): ?>
                        <a href="<?php echo e(route('superadmin.roles.edit', $role->id)); ?>" class="btn btn-primary">Hariri Rekodi</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                        <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="btn btn-default">Ghairi</a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .card-header {
            background-color: var(--matisse);
            color: white;
        }

        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: var(--matisse);
        }

        .btn-primary {
            background-color: var(--tulip-tree);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--matisse);
        }

        .btn-default {
            background-color: var(--iron);
            border: none;
            color: #333;
        }

        .btn-default:hover {
            background-color: var(--slate-gray);
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
        }

        .table-container {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/roles/show.blade.php ENDPATH**/ ?>