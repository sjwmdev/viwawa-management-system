<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="report-title" content="Ripoti ya Mahudhurio ya Jumuiya">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="max-height: 90vh; overflow-y: auto;">
                <div class="card-header">
                    <h4>Mahudhurio ya Jumuiya</h4>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.attendance.create')): ?>
                        <a href="<?php echo e(route('admin.attendance.create')); ?>" class="btn btn-light float-right"><i class="fa fa-calendar-alt fa-md"></i>&nbsp;&nbsp;Ongeza Mahudhurio</a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.attendance.index')): ?>
                        <!-- Date Selection Form -->
                        <form action="<?php echo e(route('admin.attendance.index')); ?>" method="GET" class="mb-4">
                            <div class="form-group">
                                <label for="date">Chagua Jumamosi ya Mwezi</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?php echo e($date); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary col-md-2">Tafuta</button>
                        </form>
                    <?php endif; ?>

                    <?php if(!$attendances->isEmpty()): ?>
                        <!-- Attendance Summary -->
                        <div class="mb-4 d-flex justify-content-between">
                            <p><strong>Waliohudhuria:</strong> <?php echo e($presentCount); ?> / <?php echo e($totalMembers); ?></p>
                            <p><strong>Wasiohudhuria:</strong> <?php echo e($absentCount); ?></p>
                        </div>
                        
                        <!-- Icon Information -->
                        <div class="mb-4">
                            <p><i class="fas fa-check text-success"></i> Mwanachama ame/alihudhuria</p>
                            <p><i class="fas fa-times text-danger"></i> Mwanachama ame/hakuhudhuria</p>
                        </div>

                        <!-- Attendance Table -->
                        <div class="table-responsive">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Jina la Mwanachama</th>
                                        <th>Mahudhurio</th>
                                        <th class="not-printable" width="25%">Badilisha Mahudhurio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e($member->user->full_name); ?></td>
                                            <td>
                                                <?php if(isset($attendances[$member->id])): ?>
                                                    <?php if($attendances[$member->id]->present): ?>
                                                        <i class="fas fa-check text-success"></i> <!-- Tick mark for present -->
                                                    <?php else: ?>
                                                        <i class="fas fa-times text-danger"></i> <!-- Cross mark for absent -->
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <i class="fas fa-times text-danger"></i> <!-- Cross mark for absent if no record -->
                                                <?php endif; ?>
                                            </td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.attendance.update')): ?>
                                                <td>
                                                    <?php if(isset($attendances[$member->id])): ?>
                                                        <form action="<?php echo e(route('admin.attendance.update', $attendances[$member->id]->id)); ?>" method="POST" class="update-form">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <select name="present" class="form-control update-attendance" data-id="<?php echo e($attendances[$member->id]->id); ?>">
                                                                <option value="1" <?php echo e($attendances[$member->id]->present ? 'selected' : ''); ?>>Alihudhuria</option>
                                                                <option value="0" <?php echo e(!$attendances[$member->id]->present ? 'selected' : ''); ?>>Hakuhudhuria</option>
                                                            </select>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <!-- No Attendance Records Message -->
                        <div class="alert alert-light text-danger" role="alert">
                            Hakuna mahudhurio yaliyoandikishwa kwa tarehe ya Jumamosi uliyochagua.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- DataTables JS -->
    <script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<script>
    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.update-attendance').forEach(function(select) {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/attendance/index.blade.php ENDPATH**/ ?>