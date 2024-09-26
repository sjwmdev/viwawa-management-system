<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mahudhurio ya Wanachama</h4>
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

                    <!-- Attendance Form -->
                    <form action="<?php echo e(route('admin.attendance.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="date" value="<?php echo e($date); ?>" id="hiddenDate">

                        <!-- Buttons to Mark All Attendance -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-light" id="mark-all-present">
                                    <i class="fas fa-check fa-md text-success"></i> &nbsp;Wote Wamehudhuria
                                </button>
                                <button type="button" class="btn btn-light" id="mark-all-absent">
                                    <i class="fas fa-times fa-md text-danger"></i> &nbsp;Wote Hawajahudhuria
                                </button>
                            </div>
                        </div>

                        <!-- Members Table -->
                        <div class="table-responsive">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jina la Mwanachama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="attendance[<?php echo e($member->id); ?>][present]" value="1"
                                                    <?php echo e(isset($attendances[$member->id]) && $attendances[$member->id]->present ? 'checked' : ''); ?>>
                                                <input type="hidden" name="attendance[<?php echo e($member->id); ?>][member_id]" value="<?php echo e($member->id); ?>">
                                            </td>
                                            <td><?php echo e($member->user->full_name); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.attendance.store')): ?>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-block btn-primary">Hifadhi Mahudhurio</button>
                            </div>
                        <?php endif; ?>
                    </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        const markAllPresentButton = document.getElementById('mark-all-present');
        const markAllAbsentButton = document.getElementById('mark-all-absent');
        const dateField = document.getElementById('date');
        const hiddenDateField = document.getElementById('hiddenDate');

        markAllPresentButton.addEventListener('click', function() {
            document.querySelectorAll('input[name^="attendance["][type="checkbox"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        });

        markAllAbsentButton.addEventListener('click', function() {
            document.querySelectorAll('input[name^="attendance["][type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        });

        dateField.addEventListener('change', function() {
            hiddenDateField.value = this.value;
        });
    });

    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/attendance/create.blade.php ENDPATH**/ ?>