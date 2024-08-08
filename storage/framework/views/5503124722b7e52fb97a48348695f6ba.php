<!-- All form css -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<fieldset>
    <legend>Taarifa Binafsi</legend>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="first_name" class="control-label">Jina la Kwanza&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="first_name" class="form-control"
                value="<?php echo e(old('first_name', $member->user->first_name ?? '')); ?>" placeholder="Jina la Kwanza" required>
            <?php if($errors->has('first_name')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('first_name')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
            <label for="middle_name" class="control-label">Jina la Kati</label>
            <input type="text" name="middle_name" class="form-control"
                value="<?php echo e(old('middle_name', $member->user->middle_name ?? '')); ?>" placeholder="Jina la Kati">
            <?php if($errors->has('middle_name')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('middle_name')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
            <label for="last_name" class="control-label">Jina la Mwisho&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="last_name" class="form-control"
                value="<?php echo e(old('last_name', $member->user->last_name ?? '')); ?>" placeholder="Jina la Mwisho" required>
            <?php if($errors->has('last_name')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('last_name')); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="family_status" class="control-label">Hali ya Ndoa&nbsp;<span style="color:red">*</span></label>
            <select name="family_status" class="form-control" required>
                <option value="">Chagua Hali ya Ndoa</option>
                <option value="single"
                    <?php echo e(old('family_status', $member->family_status ?? '') === 'single' ? 'selected' : ''); ?>>
                    Ameoa/Ameolewa</option>
                <option value="married"
                    <?php echo e(old('family_status', $member->family_status ?? '') === 'married' ? 'selected' : ''); ?>>Ndoa
                </option>
                <option value="divorced"
                    <?php echo e(old('family_status', $member->family_status ?? '') === 'divorced' ? 'selected' : ''); ?>>Talaka
                </option>
                <option value="widowed"
                    <?php echo e(old('family_status', $member->family_status ?? '') === 'widowed' ? 'selected' : ''); ?>>
                    Mjane/Mgane</option>
            </select>
            <?php if($errors->has('family_status')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('family_status')); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="occupation" class="control-label">Kazi</label>
            <input type="text" name="occupation" class="form-control"
                value="<?php echo e(old('occupation', $member->occupation ?? '')); ?>" placeholder="mfano: Mwanafunzi au Mfanyabiashara" required>
            <?php if($errors->has('occupation')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('occupation')); ?></span>
            <?php endif; ?>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend class="mt-2">Taarifa Zingine</legend>
    <div class="form-row mt-1">
        <div class="form-group col-md-6">
            <label for="gender" class="control-label">Jinsia&nbsp;<span style="color:red">*</span></label>
            <select name="gender" class="form-control" required>
                <option value="">Chagua Jinsia</option>
                <option value="male" <?php echo e(old('gender', $member->gender ?? '') === 'male' ? 'selected' : ''); ?>>Kiume
                </option>
                <option value="female" <?php echo e(old('gender', $member->gender ?? '') === 'female' ? 'selected' : ''); ?>>
                    Kike</option>
            </select>
            <?php if($errors->has('gender')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('gender')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-6">
            <label for="email" class="control-label">Barua Pepe</label>
            <input type="email" name="email" class="form-control"
                value="<?php echo e(old('email', $member->user->email ?? '')); ?>" placeholder="Barua Pepe">
            <?php if($errors->has('email')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-row mt-2">
        <div class="form-group col-md-6">
            <label for="residence" class="control-label">Makazi&nbsp;<span style="color:red">*</span></label>
            <input type="text" name="residence" class="form-control"
                value="<?php echo e(old('residence', $member->residence ?? '')); ?>" placeholder="mfano: Kigamboni, mjimwema" required>
            <?php if($errors->has('residence')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('residence')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group col-md-6">
            <label for="phone_number" class="control-label">Namba ya Simu</label>
            <div class="form-group d-flex align-items-center">
                <div class="input-group-prepend no-right-border">
                    <span class="input-group-text">+255</span>
                </div>
                <?php if(Route::currentRouteName() == 'admin.members.create'): ?>
                    <input type="text" name="phone_number" class="form-control phone-input"
                        value="<?php echo e(old('phone_number')); ?>" placeholder="Namba ya Simu" pattern="[0-9]{9}"
                        title="Enter 9 digit phone number">
                <?php else: ?>
                    <input type="text" name="phone_number" class="form-control phone-input"
                        value="<?php echo e($member->user->getPhoneNumberWithoutCountryCode() ?? ''); ?>"
                        placeholder="Namba ya Simu" pattern="[0-9]{9}" title="Enter 9 digit phone number">
                <?php endif; ?>
            </div>
            <?php if($errors->has('phone_number')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('phone_number')); ?></span>
            <?php endif; ?>
        </div>
    </div>


    <!-- Conditionally include presence_status field -->
    <?php if(Route::currentRouteName() == 'admin.members.edit'): ?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="presence_status" class="control-label">Hali ya Uwanachama</label>
                <select name="presence_status" class="form-control" required>
                    <option value="">Chagua Hali ya Uwepo</option>
                    <option value="active"
                        <?php echo e(old('presence_status', $member->presence_status ?? '') === 'active' ? 'selected' : ''); ?>>Hai
                    </option>
                    <option value="inactive"
                        <?php echo e(old('presence_status', $member->presence_status ?? '') === 'inactive' ? 'selected' : ''); ?>>
                        Si Hai</option>
                </select>
                <?php if($errors->has('presence_status')): ?>
                    <span class="text-danger text-left"><?php echo e($errors->first('presence_status')); ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

</fieldset>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.store')): ?>
<!-- Action Buttons -->
<div class="form-group mt-4">
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block"><?php echo e($buttonText ?? 'Hifadhi'); ?></button>
        </div>
    </div>
</div>
<?php endif; ?>

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
        $(function() {
            // Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/members/form.blade.php ENDPATH**/ ?>