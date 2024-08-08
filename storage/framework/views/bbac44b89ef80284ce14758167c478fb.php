<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Orodha ya Wanachama Waliosajiliwa Kwenye Mfumo">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Orodha ya Wanachama</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.create')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <a href="<?php echo e(route('admin.members.create')); ?>" class="btn btn-outline-light" title="Ongeza Mwanachama Mpya">
                            <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>
                            Sajili Mwanachama Mpya
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body datatable_wrapper">
                <div class="table-responsive">
                    <table id="datatable" class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">Namba.</th>
                                <th>Jina</th>
                                <th>Jinsia</th>
                                <th>Makazi</th>
                                <th>Hali ya Ndoa</th>
                                <th>Hali ya Uwanachama</th>
                                <th class="not-printable" width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(ucwords($member->user->full_name)); ?></td>
                                    <td><?php echo e($member->gender == 'male' ? 'Kiume' : 'Kike'); ?></td>
                                    <td><?php echo e($member->residence); ?></td>
                                    <td>
                                        <?php if($member->family_status == 'married'): ?>
                                            Ndoa
                                        <?php elseif($member->family_status == 'divoced'): ?>
                                            Talaka
                                        <?php elseif($member->family_status == 'widowed'): ?>
                                            Mjane/Mgane
                                        <?php else: ?>
                                            Ameoa/Ameolewa
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($member->presence_status == 'active'): ?>
                                            Hai
                                        <?php else: ?>
                                            Si Hai
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.show')): ?>
                                            <a href="<?php echo e(route('admin.members.show', $member->id)); ?>"
                                                class="btn btn-outline-secondary btn-md" title="Tazama">
                                                Tazama Zaidi
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/members/index.blade.php ENDPATH**/ ?>