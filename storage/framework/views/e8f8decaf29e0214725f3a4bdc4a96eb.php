<!-- All form css -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="form-row">
    <div class="form-group col-md-12">
        <?php if(Route::currentRouteName() == 'superadmin.permissions.create'): ?>
            <label for="name" class="control-label">Jina la Njia&nbsp;<span style="color:red">*</span></label>
            <div class="select2-dark">
                <select name="name[]" class="select2" id="name" multiple="multiple" data-placeholder="Jina"
                    data-dropdown-css-class="select2-dark" style="width: 100%;"
                    <?php echo e(count($routeNames) == 0 ? 'disabled' : ''); ?>>
                    <?php $__currentLoopData = $routeNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($routeName); ?>"><?php echo e($routeName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php else: ?>
            <label for="name" class="control-label">Jina&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="name" class="form-control" aria-describedby="Name"
                value="<?php echo e($permission->name ?? old('name')); ?>" required>
        <?php endif; ?>
        <?php if($errors->has('name')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('name')); ?></span>
        <?php endif; ?>
    </div>
</div>

<!-- Vitufe vya Vitendo -->
<div class="form-group mt-4 d-flex justify-content-between">
    <?php if(Route::currentRouteName() == 'superadmin.permissions.create'): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.store')): ?>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block" <?php echo e(count($routeNames) == 0 ? 'disabled' : ''); ?>>Ongeza
                    Rekodi</button>
            </div>
        <?php endif; ?>
    <?php elseif(Route::currentRouteName() == 'superadmin.permissions.edit'): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.update')): ?>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info btn-block">Sasisha Rekodi</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.index')): ?>
        <div class="col-md-2">
            <a href="<?php echo e(route('superadmin.permissions.index')); ?>" class="btn btn-default btn-block">Ghairi</a>
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
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/superadmin/permissions/form.blade.php ENDPATH**/ ?>