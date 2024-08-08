<!-- All form css -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $user = $user ?? new \App\Models\User;
?>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="first_name" class="control-label">Jina la Kwanza&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="first_name" class="form-control" value="<?php echo e(old('first_name', $user->first_name ?? '')); ?>"
            placeholder="Jina la Kwanza" required>
        <?php if($errors->has('first_name')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('first_name')); ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="middle_name" class="control-label">Jina la Kati (Hiari)</label>
        <input type="text" name="middle_name" class="form-control" value="<?php echo e(old('middle_name', $user->middle_name ?? '')); ?>"
            placeholder="Jina la Kati">
        <?php if($errors->has('middle_name')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('middle_name')); ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="last_name" class="control-label">Jina la Mwisho&nbsp;<span style="color:red">*</span></label>
        <input type="text" name="last_name" class="form-control" value="<?php echo e(old('last_name', $user->last_name ?? '')); ?>"
            placeholder="Jina la Mwisho" required>
        <?php if($errors->has('last_name')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('last_name')); ?></span>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="email" class="control-label">Barua Pepe (Hiari)</label>
        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email ?? '')); ?>" placeholder="Barua Pepe">
        <?php if($errors->has('email')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('email')); ?></span>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="phone_number" class="control-label">Namba ya Simu (Hiari)</label>
        <div class="form-group d-flex align-items-center">
            <div class="input-group-prepend no-right-border">
                <span class="input-group-text">+255</span>
            </div>
            <input type="text" name="phone_number" class="form-control phone-input" value="<?php echo e(old('phone_number', $user->getPhoneNumberWithoutCountryCode() ?? '')); ?>"
                placeholder="Namba ya Simu" pattern="[0-9]{9}" title="Enter 9 digit phone number">
        </div>
        <?php if($errors->has('phone_number')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('phone_number')); ?></span>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label class="control-label">Jukumu&nbsp;<span style="color:red">*</span> </label>
        <select name="role" id="role" class="form-control select2" required>
            <option value="">Chagua Jukumu</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($role->id); ?>" <?php echo e((old('role') ?? ($user->roles->first()->id ?? '')) == $role->id ? 'selected' : ''); ?>>
                    <?php echo e($role->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('role')): ?>
            <span class="text-danger text-left"><?php echo e($errors->first('role')); ?></span>
        <?php endif; ?>
    </div>
</div>

<!-- Action Buttons -->
<div class="form-group mt-4">
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block"><?php echo e($buttonText ?? 'Ongeza Mtumiaji'); ?></button>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
            <div class="col-md-2">
                <a href="<?php echo e(route('superadmin.users.index')); ?>" class="btn btn-default btn-block">Ghairi</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .input-group-prepend.no-right-border .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right: 0;
        }

        .phone-input {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -1px;
            /* Prevent double border */
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- js -->
<?php $__env->startSection('js'); ?>
    <!-- Select2 -->
    <script src="<?php echo e(asset('adminlte/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/superadmin/users/form.blade.php ENDPATH**/ ?>