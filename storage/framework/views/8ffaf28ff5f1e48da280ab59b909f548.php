<!-- All form css -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="name" class="control-label">Jina&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="name" class="form-control" aria-describedby="Name"
            value="<?php echo e($role->name ?? old('name')); ?>" placeholder="Ingiza jina la jukumu" required>
    </div>
    <div class="form-group col-md-8 table-responsive p-0">
        <label for="permissions" class="control-label">Panga Ruhusa&nbsp;<span style="color:red">*</span></label>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="5%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="60%">Jina</th>
                        <th scope="col" width="35%">Mlinzi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="permission[<?php echo e($permission->name); ?>]"
                                    value="<?php echo e($permission->name); ?>" class='permission'
                                    <?php echo e(isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : ''); ?>>
                            </td>
                            <td><?php echo e($permission->name); ?></td>
                            <td><?php echo e($permission->guard_name); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Vitufe vya Vitendo -->
<div class="form-group mt-2 d-flex justify-content-end">
    <?php if(Route::currentRouteName() == 'superadmin.roles.create'): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.store')): ?>
            <div class="col-md-2 ml-2">
                <button type="submit" class="btn btn-primary btn-block">Ongeza Rekodi</button>
            </div>
        <?php endif; ?>
    <?php elseif(Route::currentRouteName() == 'superadmin.roles.edit'): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.update')): ?>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info btn-block">Sasisha Rekodi</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
        <div class="col-md-2">
            <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="btn btn-default btn-block">Ghairi</a>
        </div>
    <?php endif; ?>
</div>

<!-- js -->
<?php $__env->startSection('js'); ?>
    <!-- Select2 -->
    <script src="<?php echo e(asset('adminlte/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/superadmin/roles/form.blade.php ENDPATH**/ ?>