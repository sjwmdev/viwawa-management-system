<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Mapato Mengine">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="cardz" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="my-1">Mapato Mengine</h4>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.store')): ?>
                    <div class="btn-group btn-group-md ml-auto" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal"
                            data-target="#addOtherIncomeModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Mapato
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($incomes->isEmpty()): ?>
                    <div class="alert alert-light text-dark alert-md" role="alert">
                        Hakuna mapato yaliyorekodiwa.
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
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Mwezi</th>
                                            <th>Kiasi (TZS)</th>
                                            <th>Maelezo</th>
                                            <th class="not-printable" style="width: 15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $yearIncomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $month = str_pad($income->month, 2, '0', STR_PAD_LEFT);
                                                $groupKey = "{$income->year}-{$month}";
                                            ?>
                                            <tr>
                                                <td colspan="4">
                                                    <h5 class="font-weight-bold pt-2"><?php echo e(\Carbon\Carbon::create()->month($income->month)->format('F')); ?></h5>
                                                </td>
                                            </tr>
                                            <?php if(isset($details[$groupKey])): ?>
                                                <?php $__currentLoopData = $details[$groupKey]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e(\Carbon\Carbon::parse($detail->date)->format('d/m/Y')); ?></td>
                                                        <td><?php echo e(number_format($detail->amount, 2)); ?> TZS</td>
                                                        <td><?php echo e($detail->description); ?></td>
                                                        <td>
                                                            <button class="btn btn-outline-secondary btn-md edit-btn"
                                                                    data-toggle="modal"
                                                                    data-target="#editIncomeModal<?php echo e($detail->id); ?>">Hariri</button>
                                                        </td>
                                                    </tr>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.update')): ?>
                                                        <!-- Edit Income Modal -->
                                                        <div class="modal fade" id="editIncomeModal<?php echo e($detail->id); ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editIncomeModalLabel<?php echo e($detail->id); ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editIncomeModalLabel<?php echo e($detail->id); ?>">Hariri
                                                                            Mapato</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="editIncomeForm<?php echo e($detail->id); ?>"
                                                                        action="<?php echo e(route('admin.incomes.update', ['income' => $detail->id])); ?>"
                                                                        method="POST">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('PATCH'); ?>

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="amount<?php echo e($detail->id); ?>">Kiasi
                                                                                    (TZS)
                                                                                </label>
                                                                                <input type="number" name="amount"
                                                                                    id="amount<?php echo e($detail->id); ?>"
                                                                                    class="form-control"
                                                                                    value="<?php echo e($detail->amount); ?>" required>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="date<?php echo e($detail->id); ?>">Tarehe
                                                                                    ya Mapato</label>
                                                                                <input type="date" name="date"
                                                                                    id="date<?php echo e($detail->id); ?>"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(\Carbon\Carbon::parse($detail->date)->format('Y-m-d') ?? ''); ?>"
                                                                                    required>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="description<?php echo e($detail->id); ?>">Maelezo
                                                                                    (Hiari)</label>
                                                                                <textarea name="description" id="description<?php echo e($detail->id); ?>" class="form-control"><?php echo e($detail->description); ?></textarea>
                                                                            </div>
                                                                            <input type="hidden" name="income_type_id"
                                                                                value="<?php echo e($detail->income_type_id); ?>">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Funga</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Hifadhi
                                                                                Mabadiliko</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">Hakuna mapato kwa mwezi huu.</td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td class="text-right"><strong>Jumla ya Mwezi:</strong></td>
                                                <td colspan="3">
                                                    <strong><?php echo e(number_format($details[$groupKey]->sum('amount'), 2)); ?> TZS</strong>
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
        <!-- Add Other Income Modal -->
        <div class="modal fade" id="addOtherIncomeModal" tabindex="-1" role="dialog"
            aria-labelledby="addOtherIncomeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOtherIncomeModalLabel">Ongeza Mapato Mengine</h5>
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

                            <div class="form-group">
                                <label for="description">Maelezo (Hiari)</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="income_type_id" value="<?php echo e($incomeTypeId); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Funga</button>
                            <button type="submit" class="btn btn-primary">Hifadhi Mapato</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/incomes/other.blade.php ENDPATH**/ ?>