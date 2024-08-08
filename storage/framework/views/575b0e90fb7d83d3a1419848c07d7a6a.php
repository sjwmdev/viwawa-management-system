<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="cardz">
            <div class="card-header">
                <h4 class="my-1 float-left">Mapato ya Jumamosi</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.store')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addIncomeModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Mapato
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($incomes->isEmpty()): ?>
                    <!-- No Income Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna mapato iliyorekodiwa.
                    </div>
                <?php else: ?>
                    <?php
                        $groupedIncomes = $incomes->groupBy('year');
                    ?>

                    <?php $__currentLoopData = $groupedIncomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $yearIncomes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4>Mwaka <?php echo e($year); ?></h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mwezi</th>
                                            <th>Jumla ya Kiasi (TZS)</th>
                                            <th>Vitendo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $yearIncomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(\Carbon\Carbon::create()->month($income->month)->format('F')); ?></td>
                                                <td><?php echo e(number_format($income->total_amount, 2)); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.incomes.saturday.details', ['year' => $year, 'month' => $income->month])); ?>"
                                                        class="btn btn-outline-secondary view-details-btn">
                                                        Mchanganua
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.store')): ?>
        <!-- Add Income Modal -->
        <div class="modal fade" id="addIncomeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addIncomeModalLabel">Ongeza Mapato ya Jumamosi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.incomes.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="amount">Kiasi (TZS)</label>
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Tarehe ya Mapato</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <input type="hidden" name="type" value="sadaka ya jumamosi">
                            <input type="hidden" name="income_type_id" value="<?php echo e($incomeTypeId); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Hifadhi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .view-details-btn {
            margin-left: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/incomes/saturday/index.blade.php ENDPATH**/ ?>