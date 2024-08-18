<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'Ripoti ya Michango ya Mwezi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header text-white">
                <h4 class="my-1 float-left">Ripoti ya Michango ya Mwezi</h4>
                <div class="float-right">
                    <form id="year-form" method="GET" action="<?php echo e(route('admin.monthlz.contributions.report')); ?>">
                        <label for="year" class="mr-2 text-white">Chagua Mwaka:</label>
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
                    <div class="alert alert-light text-danger text-center" role="alert">
                        Hakuna michango ya mwezi kwa mwaka ulioteuliwa.
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $contributions->groupBy('member.user.full_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memberName => $memberContributions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h5 class="font-weight-bold pt-4 pb-2"><?php echo e($memberName); ?></h5>
                        <?php $__currentLoopData = $memberContributions->groupBy('year'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $yearContributions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <table class="table table-hover table-lg">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="table-td-md" style="width: 20%;">Mwezi</th>
                                        <th class="table-td-md">Kiasi Kilicholipwa (TZS)</th>
                                        <th class="table-td-md">Kiasi Kilichobaki (TZS)</th>
                                        <th class="table-td-md not-printable" style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $yearContributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::create()->month($contribution->month)->format('F')); ?>

                                            </td>
                                            <td class="table-td-md">
                                                <?php echo e(number_format($contribution->total_paid, 2)); ?></td>
                                            <td class="table-td-md">
                                                <?php echo e(number_format($contribution->remaining_amount, 2)); ?></td>
                                            <td>
                                                <span
                                                    class="badge badge-size <?php echo e(strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark'); ?>">
                                                    <?php echo e(strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika'); ?>

                                                </span>
                                            </td>
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