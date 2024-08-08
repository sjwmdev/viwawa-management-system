<!-- All show css -->
<?php echo $__env->make('backend.components.show.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Maelezo ya Mwanachama</h4>

                <div class="float-right">
                    <div class="btn-group btn-group-md" role="group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.index')): ?>
                            <a href="<?php echo e(route('admin.members.index')); ?>" class="btn btn-outline-light"
                                title="Orodha ya Wanachama Wote">
                                <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;Rudi kwenye Orodha
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.edit')): ?>
                            <a href="<?php echo e(route('admin.members.edit', $member->id)); ?>" class="btn btn-outline-light">
                                <i class="fas fa-fw fa-edit" aria-hidden="true"></i>&nbsp;Sasisha Taarifa
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
                        <li class="list-group-item"><b>Jina Kamili:</b> <?php echo e(ucwords($member->user->full_name)); ?></li>
                        <li class="list-group-item"><b>Barua Pepe:</b> <?php echo e($member->user->email ?? 'N/A'); ?></li>
                        <li class="list-group-item"><b>Namba ya Simu:</b> <?php echo e($member->user->phone_number); ?></li>
                        <li class="list-group-item"><b>Nenosiri:&nbsp;</b><span
                                class="text-danger"><?php echo e($member->user->getPasswordStatus($member->user->password)); ?></span>
                        </li>
                        <?php if(auth()->user()->hasRole('superadmin')): ?>
                            <li class="list-group-item"><b>Majukumu:</b>
                                <?php $__currentLoopData = $member->user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge p-2 ml-2" style="background-color: var(--matisse); font-size: 1rem">
                                        <a href="<?php echo e(route('superadmin.roles.show', $role->id)); ?>"
                                            class="text-white"><?php echo e($role->name); ?></a>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        <?php else: ?>
                            <li class="list-group-item"><b>Majukumu:</b>
                                <?php $__currentLoopData = $member->user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge p-2 ml-2 text-white"
                                        style="background-color: var(--matisse); font-size: 1rem">
                                        <?php echo e($role->name); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </fieldset>

                <fieldset>
                    <legend>Taarifa za Mwanachama</legend>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Jinsia:</b> <?php echo e($member->gender == 'male' ? 'M' : 'F'); ?></li>
                        <li class="list-group-item"><b>Makazi:</b> <?php echo e($member->residence); ?></li>
                        <li class="list-group-item"><b>Kazi:</b> <?php echo e(ucwords($member->occupation)); ?></li>
                        <li class="list-group-item"><b>Hali ya Ndoa:</b>
                            <?php if($member->family_status == 'married'): ?>
                                Ndoa
                            <?php elseif($member->family_status == 'divoced'): ?>
                                Talaka
                            <?php elseif($member->family_status == 'widowed'): ?>
                                Mjane/Mgane
                            <?php else: ?>
                                Sijaoa/Sijaolewa
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item"><b>Hali ya Uwanachama:</b>
                            <?php if($member->presence_status == 'active'): ?>
                                Hai
                            <?php else: ?>
                                Si Hai
                            <?php endif; ?>
                        </li>
                    </ul>
                </fieldset>

                <fieldset>
                    <legend>Michango ya Mwezi ya Mwanachama</legend>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Mwezi</th>
                                    <th>Kiasi Kilicholipwa (TZS)</th>
                                    <th>Kiasi Kilichobaki (TZS)</th>
                                    <th>Hali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $member->contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(\Carbon\Carbon::parse($contribution->contributed_at)->format('F Y')); ?></td>
                                        <td><?php echo e(number_format($contribution->paid_amount, 2)); ?> TZS</td>
                                        <td><?php echo e(number_format($contribution->remaining_amount, 2)); ?> TZS</td>
                                        <td>
                                            <span
                                                class="badge badge-size <?php echo e(strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark'); ?>">
                                                <?php echo e(strtolower($contribution->status) == 'completed' ? 'Imekamilika' : 'Haijakamilika'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>

                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                    <fieldset>
                        <legend> Taarifa za ukaguzi</legend>
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <div class="col-12" id="accordion">
                                    <div class="cardz">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                                            <div class="card-header" style="background-color: var(--iron)">
                                                <h4 class="card-title w-100">
                                                    <i class="fa fa-arrow-circle-down fa-md text-dark"></i>
                                                </h4>
                                            </div>
                                        </a>
                                        <div id="collapseNine" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <?php if($member->user && $member->user->creator && $member->user->creator->id != auth()->id()): ?>
                                                        <li class="list-group-item"><b>Amesajiliwa na:</b>
                                                            <?php echo e($member->user->creator->full_name ?? '-'); ?></li>
                                                    <?php endif; ?>
                                                    <li class="list-group-item"><b>Mwanachama 
                                                        Tangu:</b>&nbsp;<?php echo e($member->user->created_at ?? '-'); ?>,
                                                        <?php echo e($member->user->created_at_human ?? '-'); ?></li>
                                                    <?php if($member->user && $member->user->updater && $member->user->updater->id != auth()->id()): ?>
                                                        <li class="list-group-item"><b>Imesasishwa na:</b>
                                                            <?php echo e($member->user->updater->full_name ?? '-'); ?></li>
                                                    <?php endif; ?>
                                                    <li class="list-group-item"><b>Imesasishwa:</b>&nbsp;<?php echo e($member->user->updated_at ?? '-'); ?>,
                                                        <?php echo e($member->user->updated_at_human ?? '-'); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /.content -->
                    </fieldset>
                <?php endif; ?>

                <div class="float-left ml-4 mt-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.edit')): ?>
                        <a href="<?php echo e(route('admin.members.edit', $member->id)); ?>" class="btn btn-primary"><i
                                class="fa fa-edit fa-md"></i>&nbsp;&nbsp;Sasisha Taarifa</a>
                    <?php endif; ?>
                </div>

                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.forceDelete')): ?>
                        <div class="float-right mt-4 mr-2">
                            <div class="modal fade" id="deleteModal<?php echo e($member->id); ?>" tabindex="-1"
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
                                            Kubofya kitufe cha kufuta kutaondoa mwanachama huyu milele. Uko tayari?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                            <form action="<?php echo e(route('admin.members.forceDelete', $member->id)); ?>" method="post">
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
                                data-target="#deleteModal<?php echo e($member->id); ?>">
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

<!-- Custom js -->


<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/members/show.blade.php ENDPATH**/ ?>