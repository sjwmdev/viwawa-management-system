<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Michango ya Ujenzi wa Kanisa">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-2">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="background-color: var(--matisse); color: white;">
            <h4 class="my-1">Michango ya Ujenzi wa Kanisa - <?php echo e($year); ?></h4>

            <div class="btn-group btn-group-md ml-auto" role="group">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.index')): ?>
                    <!-- Year Dropdown -->
                    <form method="GET" action="<?php echo e(route('admin.church.contributions.index')); ?>" class="form-inline mr-2">
                        <select name="year" class="form-control" onchange="this.form.submit()">
                            <option value="">Mwaka</option>
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($y); ?>" <?php echo e($y == $year ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.create')): ?>
                    <!-- Ongeza Mchango Button -->
                    <a href="<?php echo e(route('admin.church.contributions.create')); ?>" class="btn btn-light">
                        <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('frontend.church.contributions.index')); ?>" class="btn btn-light" title="Tazama michango">
                    <i class="fas fa-fw fa-home" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!-- Month Filter -->
        <div class="card-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.index')): ?>
                <div class="d-flex flex-wrap justify-content-end mb-4">
                    <div class="btn-group btn-group-sm d-flex flex-wrap">
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $monthName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('admin.church.contributions.index', ['year' => $year, 'month' => str_pad($index + 1, 2, '0', STR_PAD_LEFT)])); ?>"
                            class="btn btn-sm flex-fill <?php echo e(request('month') == str_pad($index + 1, 2, '0', STR_PAD_LEFT) ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                            <?php echo e($monthName); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contributions Table -->
            <div class="table-responsive">
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Jina la Familia</th>
                            <th>Kiasi (TZS)</th>
                            <th><?php echo e($month != null ? 'Tarehe'  : 'Mwezi'); ?></th>
                            <th class="table-td-md not-printable">Hali</th>
                            <th class="table-td-md not-printable text-center">Vitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($contribution->family_name); ?></td>
                            <td><?php echo e(number_format($contribution->amount, 2)); ?></td>
                            <?php if($month != null): ?>
                                <td><?php echo e(\Carbon\Carbon::parse($contribution->contribution_date)->format('d M Y')); ?></td>
                            <?php else: ?>
                                <td><?php echo e(\Carbon\Carbon::create()->month($contribution->month)->format('M')); ?></td>
                            <?php endif; ?>
                            <td>
                                <span class="badge <?php echo e($contribution->status == 'paid' ? 'badge-success p-2' : 'badge-warning p-2'); ?>">
                                    <?php echo e($contribution->status == 'paid' ? 'Imelipwa' : 'Haijalipwa'); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <!-- Show, Edit, Delete Actions -->
                                <a href="<?php echo e(route('admin.church.contributions.show', $contribution->id)); ?>" class="btn btn-sm btn-outline-secondary" title="Tazama">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.church.contributions.edit', $contribution->id)); ?>" class="btn btn-sm btn-outline-secondary" title="Hariri">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Delete Button with Modal Confirmation -->
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#deleteModal<?php echo e($contribution->id); ?>" title="Futa">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal for confirmation before deletion -->
                                <div class="modal fade" id="deleteModal<?php echo e($contribution->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">Je, una uhakika unataka kufuta mchango huu?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                                <form action="<?php echo e(route('admin.church.contributions.destroy', $contribution->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Futa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Jumla ya Kiasi (TZS):</th>
                            <th><?php echo e(number_format($totalAmount, 2)); ?></th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
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

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/church/index.blade.php ENDPATH**/ ?>