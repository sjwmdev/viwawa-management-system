<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Matumizi ya Mfuko">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Matumizi ya Mfuko</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.expenditures.store')): ?>
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addMatumiziModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Matumizi
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($expenditures->isEmpty()): ?>
                    <!-- No Expenditures Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna matumizi yaliyorekodiwa.
                    </div>
                <?php else: ?>
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tarehe</th>
                                <th>Maelezo</th>
                                <th>Kiasi (TZS)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $expenditures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Carbon\Carbon::parse($item->date)->format('d M Y')); ?></td>
                                    <td><?php echo e($item->description); ?></td>
                                    <td><?php echo e(number_format($item->amount, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Jumla ya Matumizi:</strong></td>
                                <td><strong><?php echo e(number_format($totalAmount, 2)); ?> TZS</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.expenditures.store')): ?>
        <!-- Add Matumizi Modal -->
        <div class="modal fade" id="addMatumiziModal" tabindex="-1" role="dialog" aria-labelledby="addMatumiziModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMatumiziModalLabel">Ongeza Matumizi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.expenditures.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="amount">Kiasi (TZS)</label>
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Maelezo</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Tarehe ya Matumizi</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Funga</button>
                            <button type="submit" class="btn btn-primary">Hifadhi</button>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/expenditures/index.blade.php ENDPATH**/ ?>