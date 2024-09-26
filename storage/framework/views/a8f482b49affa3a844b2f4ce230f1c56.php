<?php $__env->startSection('title', 'Michango ya Ujenzi'); ?>

<?php $__env->startSection('header', 'Michango ya Ujenzi wa Kanisa'); ?>

<?php $__env->startSection('css'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Title Message -->
    <div class="alert alert-light mb-3">
        <?php if(request('year') && request('month')): ?>
            <strong>Onyesho:</strong> Michango ya Ujenzi wa Kanisa kwa mwezi
            <?php echo e(\Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F')); ?>

            <?php echo e(request('year')); ?>.
        <?php elseif(request('year')): ?>
            <strong>Onyesho:</strong> Michango ya Ujenzi wa Kanisa kwa mwaka <?php echo e(request('year')); ?>.
        <?php else: ?>
            <strong>Onyesho:</strong> Michango yote ya Ujenzi wa Kanisa.
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
                    <a href="<?php echo e(route('frontend.church.contributions.index', ['year' => request('year', now()->year), 'month' => $num])); ?>"
                        class="btn btn-outline-secondary <?php echo e(request('month') == $num ? 'btn-primary text-white' : ''); ?>">
                        <?php echo e($monthName); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-borderless table-condensed table-hover elevation-top-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jina la Familia</th>
                            <th>Kiasi (TZS)</th>
                            <?php if(!request('month')): ?>
                                <!-- Only show 'Mwezi' column if 'month' query is not present -->
                                <th>Mwezi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contributions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($contribution->family_name); ?></td>
                                <td><?php echo e(number_format($contribution->amount, 2)); ?></td>
                                <?php if(!request('month')): ?>
                                    <!-- Display the month name in Swahili -->
                                    <td><?php echo e(\Carbon\Carbon::create()->month($contribution->month)->locale('sw')->translatedFormat('F')); ?></td>
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
            var table = $('#datatable').DataTable({
                "paging": true,
                "pageLength": 10, // Show 10 entries per page
                "lengthChange": false, // Disable the ability to change the number of records per page
                "searching": false, // Enable search
                "ordering": false, // Disable ordering
                "info": false, // Hide info
                "autoWidth": false, // Disable automatic column width calculation
                "responsive": true, // Make table responsive
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Swahili.json",
                    "search": "Tafuta Jina la Familia"
                }
            });

            // Handle share button functionality
            $('#shareButton').click(function() {
                if (navigator.share) {
                    navigator.share({
                        title: 'Michango ya Ujenzi wa Kanisa',
                        text: 'Angalia michango ya ujenzi wa kanisa Jumuiya ya Mt. Zita.',
                        url: window.location.href
                    }).then(() => {
                        console.log('Successfully shared');
                    }).catch((error) => {
                        console.error('Error sharing:', error);
                    });
                } else {
                    alert('Kisakuzi chako hakiungi mkono kushiriki moja kwa moja.');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/frontend/church/contributions/index.blade.php ENDPATH**/ ?>