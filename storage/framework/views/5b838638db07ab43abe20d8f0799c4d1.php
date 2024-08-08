<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="h4">Rekodi za Mfumo</h4>
                    </div>
                    <div class="card-body">
                        <?php if($logs->isEmpty()): ?>
                            <div class="alert alert-light text-danger" role="alert">
                                Hakuna rekodi zilizopatikana.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kitendo</th>
                                            <th>Mtumiaji</th>
                                            <th>Jedwali</th>
                                            <th>Maelezo</th>
                                            <th>Tarehe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(ucfirst($log->action)); ?></td>
                                                <td><?php echo e($log->user ? $log->user->name : 'N/A'); ?></td>
                                                <td><?php echo e($log->table_name); ?></td>
                                                <td>
                                                    <button class="btn btn-link" data-toggle="modal"
                                                        data-target="#logModal<?php echo e($log->id); ?>">
                                                        Tazama Zaidi
                                                    </button>
                                                    <div class="modal fade" id="logModal<?php echo e($log->id); ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="logModalLabel<?php echo e($log->id); ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="logModalLabel<?php echo e($log->id); ?>">Maelezo ya
                                                                        Rekodi</h5>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Kitendo:</strong> <?php echo e(ucfirst($log->action)); ?>

                                                                    </p>
                                                                    <p><strong>Mtumiaji:</strong>
                                                                        <?php echo e($log->user ? $log->user->name : 'N/A'); ?></p>
                                                                    <p><strong>Jedwali:</strong> <?php echo e($log->table_name); ?></p>
                                                                    <p><strong>Taarifa za Zamani:</strong></p>
                                                                    <pre><?php echo e(json_encode(array_diff_key(json_decode($log->old_data, true) ?? [], array_flip(['password', 'rsvd_1', 'rsvd_2', 'rsvd_3', 'rsvd_4', 'rsvd_5'])), JSON_PRETTY_PRINT)); ?></pre>
                                                                    <p><strong>Taarifa Mpya:</strong></p>
                                                                    <pre><?php echo e(json_encode(array_diff_key(json_decode($log->new_data, true) ?? [], array_flip(['password', 'rsvd_1', 'rsvd_2', 'rsvd_3', 'rsvd_4', 'rsvd_5'])), JSON_PRETTY_PRINT)); ?></pre>
                                                                    <p><strong>Ombi URL:</strong> <?php echo e($log->request_url); ?>

                                                                    </p>
                                                                    <p><strong>Njia ya Ombi:</strong>
                                                                        <?php echo e($log->request_method); ?></p>
                                                                    <p><strong>Namba ya Hali:</strong>
                                                                        <?php echo e($log->status_code); ?>

                                                                    </p>
                                                                    <p><strong>Anwani ya Mbali:</strong>
                                                                        <?php echo e($log->remote_address); ?></p>
                                                                    <p><strong>Njia:</strong> <?php echo e($log->path); ?></p>
                                                                    <p><strong>Mwenyeji:</strong> <?php echo e($log->host); ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Funga</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo e($log->created_at->format('M d, Y H:i')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .card-body p {
            margin-bottom: 0.5rem;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/common/logs/index.blade.php ENDPATH**/ ?>