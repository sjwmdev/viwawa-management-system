<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Michango ya Mwezi">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="cardz mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Michango ya Mwezi</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.index')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <form id="year-form" method="GET" action="<?php echo e(route('admin.monthly.contributions.index')); ?>">
                            <label for="year" class="mr-2">Chagua Mwaka:</label>
                            <select id="year" name="year" class="form-control"
                                onchange="document.getElementById('year-form').submit();">
                                <option value="">Mwaka</option>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year); ?>" <?php echo e($currentYear == $year ? 'selected' : ''); ?>>
                                        <?php echo e($year); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.create')): ?>
                    <div class="btn-group btn-group-md float-right" role="group" style="margin-right: 50px;">
                        <a href="<?php echo e(route('admin.monthly.contributions.create')); ?>" class="btn btn-light"><i
                                class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($months->isEmpty()): ?>
                    <!-- No Monthly Contributions Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyopatikana kwa mwaka uliochaguliwa.
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4><?php echo e(\Carbon\Carbon::createFromDate($currentYear, $month, 1)->format('F Y')); ?>&nbsp;&nbsp;
                                    <span class="badge badge-secondary p-1"><?php echo e($data['count']); ?> /
                                        <?php echo e($data['total_members']); ?></span> 
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Jina la Mwanachama</th>
                                                <th>Kiasi Kilicholipwa (TZS)</th>
                                                <th>Kiasi Kilichosalia (TZS)</th>
                                                <th class="not-printable" width="13%">Hali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $data['members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($contribution->member->user->first_name); ?>

                                                        <?php echo e($contribution->member->user->middle_name); ?>

                                                        <?php echo e($contribution->member->user->last_name); ?></td>
                                                    <td><?php echo e(number_format($contribution->total_paid, 2)); ?> TZS</td>
                                                    <td><?php echo e(number_format($contribution->remaining_amount, 2)); ?> TZS</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-size <?php echo e(strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark'); ?>">
                                                            <?php echo e(strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika'); ?>

                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.details')): ?>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <a href="<?php echo e(route('admin.monthly.contributions.details', ['year' => $contribution->year, 'month' => $contribution->month])); ?>"
                                                            class="btn btn-outline-secondary tfooter-mr btn-sm">Tazama
                                                            Maelezo</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/contributions/monthly/index.blade.php ENDPATH**/ ?>