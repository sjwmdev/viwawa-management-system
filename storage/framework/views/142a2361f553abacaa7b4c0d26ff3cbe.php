<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Watumiaji Waliosajiliwa">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Watumiaji Wote</h4>
                <div class="btn-group btn-group-md float-right" role="group">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.students.create.allowed')): ?>
                        <a href="<?php echo e(route('superadmin.students.create')); ?>" class="btn btn-outline-light" title="Ongeza Mwanafunzi">
                            <i class="fas fa-fw fa-user-graduate"></i> Ongeza Mwanafunzi
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.lecturers.create.allowed')): ?>
                        <a href="<?php echo e(route('superadmin.lecturers.create')); ?>" class="btn btn-outline-light" title="Ongeza Mhadhiri">
                            <i class="fas fa-fw fa-chalkboard-teacher"></i> Ongeza Mhadhiri
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.create')): ?>
                        <a href="<?php echo e(route('superadmin.users.create')); ?>" class="btn btn-outline-light" title="Ongeza Mtumiaji">
                            <i class="fas fa-fw fa-user-plus"></i> Ongeza Mtumiaji Mpya
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba</th>
                            <th>Jina</th>
                            <th>Anuani ya Barua Pepe</th>
                            <th>Majukumu</th>
                            <th class="not-printable" width="5%">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e(Str::ucfirst($user->full_name)); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge" style="background-color: var(--matisse);">
                                            <a href="<?php echo e(route('superadmin.roles.show', $role->id)); ?>" class="text-white"><?php echo e($role->name); ?></a>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-md" role="group">
                                        <?php
                                            $role = $user->roles->first();
                                            $routeName = '';
                                            $endpoint = '';

                                            if ($role) {
                                                switch ($role->name) {
                                                    case 'admin':
                                                        $routeName = 'superadmin.users.show';
                                                        $endpoint = $user;
                                                        break;
                                                    case 'viwawa':
                                                        $routeName = 'admin.members.show';
                                                        $endpoint = $user->member;
                                                        break;
                                                    default:
                                                        $routeName = 'superadmin.users.show';
                                                        $endpoint = $user;
                                                        break;
                                                }
                                            }
                                        ?>
                                        <?php if($endpoint): ?>
                                            <a href="<?php echo e(route($routeName, $endpoint->id)); ?>" class="btn btn-outline-secondary" title="Onyesha">
                                                Tazama
                                            </a>
                                        <?php else: ?>
                                            <span class="btn btn-outline-secondary disabled" title="Onyesha">
                                                Tazama
                                            </span>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('superadmin.users.edit', $user->id)); ?>" class="btn btn-outline-secondary" title="Hariri">
                                            Hariri
                                        </a>
                                        <button class="btn btn-outline-secondary" title="Futa" data-toggle="modal" data-target="#deleteModal<?php echo e($user->id); ?>">
                                            Futa
                                        </button>
                                    </div>

                                    <!-- Modal for confirmation before deletion -->
                                    <div class="modal fade" id="deleteModal<?php echo e($user->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Je, una uhakika unataka kufuta mtumiaji huyu?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                                    <form action="<?php echo e(route('superadmin.users.destroy', $user->id)); ?>" method="post">
                                                        <?php echo method_field('delete'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-danger">Futa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/users/index.blade.php ENDPATH**/ ?>