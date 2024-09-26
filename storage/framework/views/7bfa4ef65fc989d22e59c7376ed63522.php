<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Balance ya Mfuko">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h5 class="my-1 float-left">Balance ya Mfuko</h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.mfuko-balance.calculate')): ?>
                    <button id="calculateBalanceBtn" class="btn btn-outline-light float-right calculate-btn"><i class="fa fa-md fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Pakua Salio</button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($balance): ?>
                    <div class="row mb-4">
                        <div class="col-md-12 text-center">
                            <h4 class="display-5 font-weight-bold text-secondary">
                                <?php echo e(number_format($balance->total_balance, 2)); ?> TZS</h4>
                            <p class="text-muted">Tarehe ya Maingizo: <?php echo e($balance->date->format('d M Y')); ?></p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                  <h5>Mapato na Matumizi</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 1.25rem;">Kundi</th>
                                                <th style="font-size: 1.25rem;">Kiasi (TZS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="td-fsize">Jumpla ya Mapato</td>
                                                <td class="text-success" class="td-fsize">+
                                                    <?php echo e(number_format($balance->income_balance, 2)); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="td-fsize">Jumla ya Michango ya Mwezi</td>
                                                <td class="text-success" class="td-fsize">+
                                                    <?php echo e(number_format($balance->contribution_balance, 2)); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="td-fsize">Jumla ya Matumizi</td>
                                                <td class="text-danger" class="td-fsize">-
                                                    <?php echo e(number_format($balance->expenditure_balance, 2)); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                <!-- No Mfuko Balance Records Message -->
                <div class="alert alert-light text-dark alert-md" role="alert">
                    Hakuna rekodi ya salio iliyopo.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('calculateBalanceBtn').addEventListener('click', function() {
            if (confirm('Je, una uhakika unataka kupakia salio?')) {
                fetch('<?php echo e(route('admin.mfuko-balance.calculate')); ?>', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            sessionStorage.setItem('toastrMessage', data.message);
                            sessionStorage.setItem('toastrType', 'success');
                        } else {
                            sessionStorage.setItem('toastrMessage', data.message);
                            sessionStorage.setItem('toastrType', 'error');
                        }
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        sessionStorage.setItem('toastrMessage', 'Hitilafu ilitokea wakati wa kuhesabu salio.');
                        sessionStorage.setItem('toastrType', 'error');
                        location.reload();
                    });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var message = sessionStorage.getItem('toastrMessage');
            var type = sessionStorage.getItem('toastrType');

            if (message && type) {
                toastr[type](message);
                sessionStorage.removeItem('toastrMessage');
                sessionStorage.removeItem('toastrType');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .td-fsize {
            font-size: 1.1rem;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- All js -->
<?php echo $__env->make('backend.components.index.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/mfuko/index.blade.php ENDPATH**/ ?>