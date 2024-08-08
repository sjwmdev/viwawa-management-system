<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'Ripoti ya Michango ya Mwezi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ripoti ya Michango ya Mwezi</h4>
            <div class="float-right">
                <form id="year-form" method="GET" action="<?php echo e(route('admin.monthlz.contributions.report')); ?>">
                    <label for="year" class="mr-2">Chagua Mwaka:</label>
                    <select id="year" name="year" class="form-control"
                            onchange="document.getElementById('year-form').submit();">
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year); ?>" <?php echo e($currentYear == $year ? 'selected' : ''); ?>>
                                <?php echo e($year); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body">
            <?php if($contributions->isEmpty()): ?>
                <div class="alert alert-light text-danger" role="alert">
                    Hakuna michango ya mwezi kwa mwaka ulioteuliwa.
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $contributions->groupBy('member.user.full_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memberName => $memberContributions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h4 class="pt-4 pb-2"><?php echo e($memberName); ?></h4>
                    <?php $__currentLoopData = $memberContributions->groupBy('year'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $yearContributions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Mwezi</th>
                                <th>Kiasi Kilicholipwa (TZS)</th>
                                <th>Kiasi Kilichobaki (TZS)</th>
                                <th class="not-printable" width="13%">Hali</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $yearContributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Carbon\Carbon::create()->month($contribution->month)->format('F')); ?></td>
                                    <td><?php echo e(number_format($contribution->total_paid, 0, ',', '.')); ?></td>
                                    <td><?php echo e(number_format($contribution->remaining_amount, 0, ',', '.')); ?></td>
                                    <td><?php echo e(strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/contributions/monthly/report.blade.php ENDPATH**/ ?>