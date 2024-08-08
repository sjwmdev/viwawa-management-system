<!-- All show css -->
<?php echo $__env->make('backend.components.show.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Maelezo ya Mtumiaji</h4>

                <div class="float-right">
                    <div class="btn-group btn-group-md" role="group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
                            <a href="<?php echo e(route('superadmin.users.index')); ?>" class="btn btn-outline-light"
                                title="Orodha ya Watumiaji">
                                <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;Watumiaji Wote
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.create')): ?>
                            <a href="<?php echo e(route('superadmin.users.create')); ?>" class="btn btn-outline-light"
                                title="Ongeza Mtumiaji Mpya">
                                <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>&nbsp;Ongeza Mtumiaji
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <fieldset>
                    <legend>Taarifa Binafsi</legend>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Jina:</b> <?php echo e(ucwords($user->full_name)); ?></li>
                        <li class="list-group-item"><b>Barua Pepe:</b> <?php echo e($user->email ?? '-'); ?></li>
                        <li class="list-group-item"><b>Namba ya Simu:</b> <?php echo e($user->phone_number); ?></li>
                        <li class="list-group-item"><b>Nenosiri la Mwanzo:&nbsp;</b><span
                                class="text-danger"><?php echo e($user->getPasswordStatus($user->password)); ?></span></li>
                        <li class="list-group-item"><b>Majukumu:</b>
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge p-2 ml-2" style="background-color: var(--matisse); font-size: 1rem">
                                    <a href="<?php echo e(route('superadmin.roles.show', $role->id)); ?>"
                                        class="text-white"><?php echo e($role->name); ?></a>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </li>
                    </ul>
                </fieldset>

                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'superadmin')): ?>
                    <fieldset>
                        <legend>Taarifa za Ukaguzi</legend>
                        <ul class="list-group list-group-flush">
                            <?php if($user && $user->creator && $user->creator->id != auth()->id()): ?>
                                <li class="list-group-item"><b>Amesajiliwa na:</b>
                                    <?php echo e($user->creator->full_name ?? '-'); ?></li>
                            <?php endif; ?>
                            <li class="list-group-item"><b>Mwanachama
                                    Tangu:</b>&nbsp;<?php echo e($user->created_at ?? '-'); ?>,
                                <?php echo e($user->created_at_human ?? '-'); ?></li>
                            <?php if($user && $user->updater && $user->updater->id != auth()->id()): ?>
                                <li class="list-group-item"><b>Imesasishwa na:</b>
                                    <?php echo e($user->updater->full_name ?? '-'); ?></li>
                            <?php endif; ?>
                            <li class="list-group-item"><b>Imesasishwa:</b>&nbsp;<?php echo e($user->updated_at ?? '-'); ?>,
                                <?php echo e($user->updated_at_human ?? '-'); ?></li>
                        </ul>
                    </fieldset>
                <?php endif; ?>

                <div class="float-left ml-4 mt-4">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.edit')): ?>
                        <a href="<?php echo e(route('superadmin.users.edit', $user->id)); ?>" class="btn btn-primary">Hariri Taarifa</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
                        <a href="<?php echo e(route('superadmin.users.index')); ?>" class="btn btn-default">Ghairi</a>
                    <?php endif; ?>
                </div>

                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'superadmin')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.forceDelete')): ?>
                        <div class="float-right mt-4">
                            <div class="modal fade" id="deleteModal<?php echo e($user->id); ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Kubofya kitufe cha kufuta kutaondoa mtumiaji huyu milele. Uko tayari?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                            <form action="<?php echo e(route('superadmin.users.forceDelete', $user->id)); ?>" method="post">
                                                <?php echo method_field('delete'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger">Futa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button to trigger the modal -->
                            <button class="btn btn-danger" title="Futa" data-toggle="modal"
                                data-target="#deleteModal<?php echo e($user->id); ?>">
                                Futa Milele
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/users/show.blade.php ENDPATH**/ ?>