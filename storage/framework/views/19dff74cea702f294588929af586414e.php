<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Michango Mwezi
                    <?php echo e(\Carbon\Carbon::createFromDate($year, $month, 1)->format('F Y')); ?></h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.index')): ?>
                    <a href="<?php echo e(route('admin.monthly.contributions.index')); ?>" class="btn btn-outline-light float-right">Rudi</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($contributions->isNotEmpty()): ?>
                    <table id="datatable" class="table table-hover p-2">
                        <thead>
                            <tr>
                                <th width="5%">Namba</th>
                                <th>Jina la Mwanachama</th>
                                <th>Kiasi Kilicholipwa (TZS)</th>
                                <th>Kiasi Kilichobaki (TZS)</th>
                                <th>Hali</th>
                                <th>Tarehe ya Michango</th>
                                <th class="not-printable">Hariri</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><a href="<?php echo e(route('admin.members.show', $contribution->member->id)); ?>"
                                            class="text-dark"
                                            title="Tazama taarifa"><?php echo e($contribution->member->user->full_name); ?></a></td>
                                    <td><?php echo e(number_format($contribution->paid_amount, 2)); ?></td>
                                    <td><?php echo e(number_format($contribution->remaining_amount, 2)); ?></td>
                                    <td>
                                        <span
                                            class="badge <?php echo e(strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark'); ?>">
                                            <?php echo e(strtolower($contribution->status) == 'completed' ? 'Imekamilisha' : 'Hajakamilisha'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e(\Carbon\Carbon::parse($contribution->date)->format('d M, Y')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.monthly.contributions.edit', $contribution->id)); ?>"
                                            class="btn btn-sm btn-outline-secondary" title="Hariri">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Jumla:</th>
                                <th><?php echo e(number_format($totalPaidAmount, 2)); ?> TZS</th>
                                <th><?php echo e(number_format($totalRemainingAmount, 2)); ?> TZS</th>
                                <th colspan="3"></th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Jumla ya Kiasi Kinachotarajiwa:</th>
                                <th colspan="3"><?php echo e(number_format($overallExpectedAmount, 2)); ?> TZS</th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <!-- No Monthly Contributions Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyopatikana kwa mwezi uliochaguliwa.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/contributions/monthly/details.blade.php ENDPATH**/ ?>