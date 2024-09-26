<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Profaili Yangu</h4>
                    </div>

                    <div class="card-body">
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', ['admin', 'viwawa'])): ?>
                            <?php if(Auth::user()->hasDefaultPassword()): ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>&nbsp;Nenosiri lako la awali ni:
                                    <b>nenosiri</b>. Kwa usalama wako, tafadhali sasisha nenosiri lako kabla ya kuendelea.
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <h4><?php echo e(Str::ucfirst($user->full_name) ?? 'N/A'); ?></h4>
                        <h5><?php echo e($user->email ?? 'N/A'); ?></h5>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.profile.update')): ?>
                            <!-- Personal Details -->
                            <div class="persona-details-container">
                                <form class="mt-4" method="POST" action="<?php echo e(route('common.profile.update', $user->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('patch'); ?>

                                    <fieldset>
                                        <legend><i class="fas fa-user-circle"></i> Taarifa Binafsi</legend>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="first_name">Jina la Kwanza</label>
                                                <input type="text" id="first_name" name="first_name"
                                                    class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('first_name', $user->first_name)); ?>" required>
                                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger text-left"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="middle_name">Jina la Kati</label>
                                                <input type="text" id="middle_name" name="middle_name"
                                                    class="form-control <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('middle_name', $user->middle_name)); ?>">
                                                <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger text-left"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="last_name">Jina la Mwisho</label>
                                                <input type="text" id="last_name" name="last_name"
                                                    class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('last_name', $user->last_name)); ?>" required>
                                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger text-left"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_number">Namba ya Simu</label>
                                                <div class="form-group d-flex align-items-center">
                                                    <div class="input-group-prepend no-right-border">
                                                        <span class="input-group-text">+255</span>
                                                    </div>
                                                    <input type="text" id="phone_number" name="phone_number"
                                                        class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        value="<?php echo e(old('phone_number', $user->getPhoneNumberWithoutCountryCode())); ?>"
                                                        required>
                                                    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger text-left"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Barua Pepe</label>
                                                    <input type="email" id="email" name="email"
                                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        value="<?php echo e(old('email', $user->email)); ?>" required>
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger text-left"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-block btn-primary">Sasisha Profaili</button>
                                    </fieldset>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.profile.change-password')): ?>
                            <div class="change-password-container" style="margin-top: 50px;">
                                <!-- Change Password -->
                                <form class="mt-4" method="POST"
                                    action="<?php echo e(route('common.profile.change-password', $user->id)); ?>" id="change_password_form"
                                    novalidate>
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('patch'); ?>

                                    <fieldset class="mt-4">
                                        <legend><i class="fas fa-lock"></i> Badilisha Nenosiri</legend>

                                        <div class="form-group">
                                            <label for="old_password">Nenosiri la Zamani</label>
                                            <input type="password" id="old_password" name="old_password"
                                                class="form-control <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Nenosiri la zamani" required>
                                            <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger text-left"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- New Password -->
                                        <div class="form-group">
                                            <label for="password">Nenosiri Jipya</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Nenosiri jipya" required>
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger text-left"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- Confirm New Password -->
                                        <div class="form-group">
                                            <label for="password_confirmation">Thibitisha Nenosiri</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="Thibitisha nenosiri" required>
                                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger text-left"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <button type="submit" class="btn btn-block btn-primary">Badilisha Nenosiri</button>
                                    </fieldset>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
        }

        .card-header {
            background-color: var(--matisse);
            color: white;
        }

        h2 {
            color: var(--matisse);
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: bold;
            color: var(--matisse);
        }

        .form-control:focus {
            border-color: var(--matisse);
            box-shadow: none;
        }

        .btn-primary {
            background-color: var(--matisse);
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--tulip-tree);
        }

        .btn-outline-primary {
            border-color: var(--matisse);
            color: var(--matisse);
        }

        .btn-outline-primary:hover {
            background-color: var(--matisse);
            border: 1px solid var(--matisse);
            color: white;
        }

        .alert-success,
        .alert-danger {
            margin-top: 1rem;
            font-size: 1rem;
        }

        .text-danger {
            font-size: 0.875rem;
            color: var(--cabaret);
        }

        fieldset {
            border: 1px solid var(--matisse);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
        }

        legend {
            width: auto;
            padding: 0 10px;
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--matisse);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group {
            flex: 0 0 48%;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- Custom js -->
<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var oldPassword = document.getElementById('old_password');
            var hashedPassword = document.getElementById('hashed_password').value;

            oldPassword.addEventListener('input', function() {
                var enteredOldPassword = oldPassword.value;

                if (!checkPasswordMatch(enteredOldPassword, hashedPassword)) {
                    oldPassword.setCustomValidity('Nenosiri la zamani halilingani.');
                } else {
                    oldPassword.setCustomValidity('');
                }
            });

            function checkPasswordMatch(enteredPassword, hashedPassword) {
                return enteredPassword !== '' && bcrypt.compareSync(enteredPassword, hashedPassword);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/common/profile/edit.blade.php ENDPATH**/ ?>