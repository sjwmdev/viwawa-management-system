<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Michango ya Mwezi">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="my-1">Michango ya Mwezi</h4>

                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.index')): ?>
                            <form id="year-form" method="GET" action="<?php echo e(route('admin.monthly.contributions.index')); ?>" class="mr-2">
                                <select id="year" name="year" class="form-control"
                                    onchange="document.getElementById('year-form').submit();">
                                    <option value="">Mwaka</option>
                                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($year); ?>" <?php echo e($currentYear == $year ? 'selected' : ''); ?>>
                                            <?php echo e($year); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.create')): ?>
                            <a href="<?php echo e(route('admin.monthly.contributions.create')); ?>" class="btn btn-light">
                                <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango
                            </a>
                        <?php endif; ?>
                    </div>
            </div>
            <div class="card-body">
                <?php if($months->isEmpty()): ?>
                    <div class="alert alert-light text-dark alert-md text-center" role="alert">
                        Hakuna michango iliyopatikana kwa mwaka uliochaguliwa.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="table-td-md" style="width: 20%;">Mwezi</th>
                                    <th class="table-td-md">Jina la Mwanachama</th>
                                    <th class="table-td-md">Kiasi Kilicholipwa (TZS)</th>
                                    <th class="table-td-md">Kiasi Kilichosalia (TZS)</th>
                                    <th class="table-td-md not-printable" style="width: 15%;"></th>
                                    <th class="table-td-md not-printable" style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="6" class="table-td-md bg-light font-weight-bold text-primary pt-4">
                                            <?php echo e(\Carbon\Carbon::createFromDate($currentYear, $month, 1)->format('F Y')); ?>

                                            <span class="badge badge-secondary badge-size p-2 ml-2">
                                                <?php echo e($data['count']); ?> / <?php echo e($data['total_members']); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    <?php $__currentLoopData = $data['members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <td class="table-td-md"><?php echo e($contribution->member->user->first_name); ?>

                                                <?php echo e($contribution->member->user->middle_name); ?>

                                                <?php echo e($contribution->member->user->last_name); ?></td>
                                            <td class="table-td-md"><?php echo e(number_format($contribution->total_paid, 2)); ?>

                                            </td>
                                            <td class="table-td-md"><?php echo e(number_format($contribution->remaining_amount, 2)); ?></td>
                                            <td class="table-td-md">
                                                <span
                                                    class="badge badge-size <?php echo e(strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark'); ?>">
                                                    <?php echo e(strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika'); ?>

                                                </span>
                                            </td>
                                            <td class="table-td-md">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.edit')): ?>
                                                    <a href="<?php echo e(route('admin.monthly.contributions.edit', $contribution->id)); ?>"
                                                        class="btn btn-outline-secondary btn-md" title="Hariri">
                                                        Hariri
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Custom js -->
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                document.getElementById('year-form').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/monthly/index.blade.php ENDPATH**/ ?>