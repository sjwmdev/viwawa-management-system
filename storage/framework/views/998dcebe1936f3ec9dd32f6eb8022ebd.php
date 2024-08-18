<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Mapato ya Jumamosi Mwezi">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="my-1 float-left">Mapato ya Jumamosi Mwezi,
                    <?php echo e(\Carbon\Carbon::create()->month($month)->format('F')); ?> <?php echo e($year); ?></h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.saturday')): ?>
                    <a href="<?php echo e(route('admin.incomes.saturday')); ?>" class="btn btn-outline-light float-right">Rudi kwenye
                        Orodha</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($incomes->isEmpty()): ?>
                    <!-- No Income Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyorekodiwa kwa mwezi huu.
                    </div>
                <?php else: ?>
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tarehe</th>
                                <th>Kiasi (TZS)</th>
                                <th>Maelezo</th>
                                <th class="not-printable">Vitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Carbon\Carbon::parse($income->date)->format('d M Y')); ?></td>
                                    <td><?php echo e(number_format($income->amount, 2)); ?></td>
                                    <td><?php echo e(ucfirst($income->description)); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.update')): ?>
                                            <button class="btn btn-outline-secondary edit-btn" data-toggle="modal"
                                                data-target="#editIncomeModal-<?php echo e($income->id); ?>">
                                                Hariri
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.update')): ?>
                                    <!-- Edit Income Modal -->
                                    <div class="modal fade" id="editIncomeModal-<?php echo e($income->id); ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="editIncomeModalLabel-<?php echo e($income->id); ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editIncomeModalLabel-<?php echo e($income->id); ?>">Hariri
                                                        Mapato</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?php echo e(route('admin.incomes.update', $income->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="edit-amount-<?php echo e($income->id); ?>">Kiasi (TZS)</label>
                                                            <input type="number" name="amount"
                                                                id="edit-amount-<?php echo e($income->id); ?>" class="form-control"
                                                                value="<?php echo e($income->amount); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-date-<?php echo e($income->id); ?>">Tarehe ya Mapato</label>
                                                            <input type="date" name="date"
                                                                id="edit-date-<?php echo e($income->id); ?>" class="form-control"
                                                                value="<?php echo e(\Carbon\Carbon::parse($income->date)->format('Y-m-d')); ?>"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-description-<?php echo e($income->id); ?>">Maelezo</label>
                                                            <textarea name="description" id="edit-description-<?php echo e($income->id); ?>" class="form-control" rows="3"><?php echo e($income->description); ?></textarea>
                                                        </div>
                                                        <input type="hidden" name="type" value="sadaka ya jumamosi">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Funga</button>
                                                        <button type="submit" class="btn btn-primary">Hifadhi
                                                            Mabadiliko</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-right"><strong>Jumla:</strong></td>
                                <td class="total-amount"><strong><?php echo e(number_format($incomes->sum('amount'), 2)); ?>

                                        TZS</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

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

        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .edit-btn {
            margin-left: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/incomes/saturday/details.blade.php ENDPATH**/ ?>