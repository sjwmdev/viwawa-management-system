<?php $__env->startSection('title', 'Michango ya Mwezi - Viwawa'); ?>

<?php $__env->startSection('brandtitle', 'Viwawa Mt.Zita'); ?>
<?php $__env->startSection('header', 'Michango ya Kila Mwezi'); ?>

<?php $__env->startSection('chaguamwaka'); ?>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownYear" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">
                Chagua Mwaka
            </a>
            <ul aria-labelledby="dropdownYear" class="dropdown-menu border-0 shadow">
                <form id="yearForm" method="GET" action="<?php echo e(route('frontend.viwawa.contributions.monthly.index')); ?>">
                    <?php for($i = now()->year; $i >= now()->year - 4; $i--): ?>
                        <li>
                            <a href="javascript:void(0)" onclick="selectYear(<?php echo e($i); ?>)"
                                class="dropdown-item <?php echo e(request('year', now()->year) == $i ? 'active' : ''); ?>">
                                <?php echo e($i); ?>

                            </a>
                        </li>
                    <?php endfor; ?>
                    <!-- Hidden input to store selected year -->
                    <input type="hidden" name="year" id="selectedYear" value="<?php echo e(request('year', now()->year)); ?>">
                </form>
            </ul>
        </li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Title Message -->
    <div class="alert alert-light mb-3">
        <?php if(request('year') && request('month')): ?>
            <strong>Onyesho:</strong> Michango ya mwezi
            <?php echo e(\Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F')); ?>

            mwaka <?php echo e(request('year')); ?>.
        <?php elseif(request('year')): ?>
            <strong>Onyesho:</strong> Michango ya mwezi kwa mwaka <?php echo e(request('year')); ?>.
        <?php else: ?>
            <strong>Onyesho:</strong> Michango ya kila mwezi ya mwanachama.
        <?php endif; ?>
    </div>

    <div class="card elevation-1">
        <div class="card-body">
            <!-- Month Filter Buttons -->
            <div class="month-filter-container mb-4">
                <?php
                    $months = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Machi',
                        '04' => 'Aprili',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Julai',
                        '08' => 'Agosti',
                        '09' => 'Septemba',
                        '10' => 'Oktoba',
                        '11' => 'Novemba',
                        '12' => 'Desemba',
                    ];
                ?>
                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $monthName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('frontend.viwawa.contributions.monthly.index', ['year' => request('year', now()->year), 'month' => $num])); ?>"
                        class="btn btn-outline-secondary <?php echo e(request('month') == $num ? 'btn-primary text-white' : ''); ?>">
                        <?php echo e($monthName); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="border: none;">#</th>
                            <th class="text-nowrap" style="border: none;">Jina la Mwanachama</th>
                            <?php if(!request('month')): ?>
                                <!-- Display all month columns if no month is selected -->
                                <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $monthName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th style="border: none;"><?php echo e(mb_substr($monthName, 0, 3)); ?></th>
                                    <!-- Abbreviated month names -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <!-- Display only the selected month if a month is selected -->
                                <th style="border: none;">
                                    <?php echo e(\Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F')); ?>

                                </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member => $contributionByMonth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td class="text-nowrap"><?php echo e($member); ?></td>
                                <?php if(!request('month')): ?>
                                    <!-- Display contributions for all months -->
                                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php echo e(isset($contributionByMonth[$num]) ? number_format($contributionByMonth[$num], 2) : ''); ?>

                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <!-- Display only the contribution for the selected month -->
                                    <td>
                                        <?php echo e(isset($contributionByMonth[request('month')]) ? number_format($contributionByMonth[request('month')], 2) : ''); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- DataTables JS -->
    <script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Swahili.json",
                    "search": "Tafuata Jina lako: ",
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/frontend/viwawa/contributions/monthly/index.blade.php ENDPATH**/ ?>