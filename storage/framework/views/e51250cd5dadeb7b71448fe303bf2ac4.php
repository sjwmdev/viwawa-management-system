<div class="mt-4 mb-4">
    <div class="form-floating" id="phone-field">
        <input type="text" class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone_number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder=" " required>
        <label for="phone_number">Namba ya Simu</label>
        <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    
    <div class="form-floating position-relative">
        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder=" " required>
        <label for="password">Nenosiri</label>
        <div class="input-group-text" id="togglePassword">
            <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
        </div>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>

<div class="form-group mb-3 mt-4">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="remember" value="1" checked>
        <label class="custom-control-label" for="remember">Nikumbuke</label>
    </div>
</div>

<button type="submit" class="btn btn-login btn-block">Ingia</button>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/auth/partials/_login_form.blade.php ENDPATH**/ ?>