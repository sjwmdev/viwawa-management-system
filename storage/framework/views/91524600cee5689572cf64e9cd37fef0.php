<?php $__env->startSection('meta'); ?>
    <meta name="report-title"
        content="Taarifa ya Mchango wa Ujenzi wa Kanisa familia ya <?php echo e($churchContribution->family_name); ?>">
<?php $__env->stopSection(); ?>

<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: var(--matisse); color: white;">
                <h5 class="my-1">Mchango wa Ujenzi wa Kanisa familia ya: <?php echo e($churchContribution->family_name); ?></h5>

                <div class="btn-group btn-group-md ml-auto" role="group">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.create')): ?>
                        <a href="<?php echo e(route($routeBaseUrl . '.create', ['fmid' => $churchContribution->id])); ?>"
                            class="btn btn-outline-light">
                            <i class="fa fa-plus-circle"></i> Ongeza Mchango
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.index')): ?>
                        <a href="<?php echo e(route('admin.church.contributions.index')); ?>" class="btn btn-outline-light"
                            title="Rudi kwenye orodha">
                            <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <!-- Display Family Details -->
                <div class="mb-4">
                    <table class="table table-hover">
                        <tr>
                            <th>Jina la Familia</th>
                            <td><?php echo e($churchContribution->family_name); ?></td>
                        </tr>
                        <tr>
                            <th>Kiasi Kilichochangwa</th>
                            <td><?php echo e(number_format($churchContribution->amount, 2)); ?> TZS</td>
                        </tr>
                        <tr>
                            <th>Maelezo</th>
                            <td><?php echo e($churchContribution->description ?? 'Hakuna Maelezo'); ?></td>
                        </tr>
                        <tr>
                            <th>Tarehe ya Mchango</th>
                            <td><?php echo e(\Carbon\Carbon::parse($churchContribution->contribution_date)->format('d M Y')); ?></td>
                        </tr>
                        <tr>
                            <th>Mwezi</th>
                            <td><?php echo e(\Carbon\Carbon::create()->month($churchContribution->month)->translatedFormat('F')); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Mwaka</th>
                            <td><?php echo e($churchContribution->year); ?></td>
                        </tr>
                        <tr>
                            <th>Hali ya Mchango</th>
                            <td>
                                <span
                                    class="badge <?php echo e($churchContribution->status == 'paid' ? 'badge-success p-2' : ($churchContribution->status == 'ahadi' ? 'badge-info p-2' : 'badge-warning p-2')); ?>">
                                    <?php echo e($churchContribution->status == 'paid' ? 'Imelipwa' : ($churchContribution->status == 'ahadi' ? 'Ahadi' : 'Haijalipwa')); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <hr>

                <!-- Contributions Table -->
                <div class="table-responsive mt-4">
                    <!-- Filter by year -->
                    <div class="d-flex justify-content-end mb-3">
                        <form method="GET" action="<?php echo e(route($routeBaseUrl . '.show', $churchContribution->id)); ?>"
                            class="form-inline">
                            <label for="year" class="mr-2">Chagua Mwaka:</label>
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                <option value="">Mwaka</option>
                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $availableYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($availableYear); ?>" <?php echo e($year == $availableYear ? 'selected' : ''); ?>>
                                        <?php echo e($availableYear); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>

                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mwezi</th>
                                <th>Kiasi Kilichochangwa (TZS)</th>
                                <th>Hali</th>
                                <th>Tarehe ya Mchango</th>
                                <th class="table-td-md not-printable">Vitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contributionsByMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $contributions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(\Carbon\Carbon::create()->month($month)->translatedFormat('F')); ?></td>
                                        <td><?php echo e(number_format($contribution->amount, 2)); ?></td>
                                        <td>
                                            <span
                                                class="badge <?php echo e($contribution->status == 'paid' ? 'badge-success' : ($contribution->status == 'ahadi' ? 'badge-info' : 'badge-warning')); ?>">
                                                <?php echo e($contribution->status == 'paid' ? 'Imelipwa' : ($contribution->status == 'ahadi' ? 'Ahadi' : 'Haijalipwa')); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($contribution->contribution_date)->format('d M Y')); ?>

                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="<?php echo e(route($routeBaseUrl . '.edit', $contribution->id)); ?>"
                                                class="btn btn-sm btn-outline-secondary" title="Hariri">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Delete Button with Modal Confirmation -->
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-toggle="modal" data-target="#deleteModal<?php echo e($contribution->id); ?>"
                                                title="Futa">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Modal for confirmation before deletion -->
                                            <div class="modal fade" id="deleteModal<?php echo e($contribution->id); ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">Je, una uhakika unataka kufuta
                                                            mchango huu?</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Ghairi</button>
                                                            <form
                                                                action="<?php echo e(route($routeBaseUrl . '.destroy', $contribution->id)); ?>"
                                                                method="POST">
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Jumla ya Kiasi:</th>
                                <th><?php echo e(number_format($totalAmount, 2)); ?> TZS</th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- All show js -->
<?php echo $__env->make('backend.components.show.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/church/show.blade.php ENDPATH**/ ?>