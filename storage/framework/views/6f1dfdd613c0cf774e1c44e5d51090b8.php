<!-- All css -->
<?php echo $__env->make('backend.components.index.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <!-- Stats Widgets -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--tulip-tree);">
                            <div class="inner text-auto">
                                <h3><?php echo e($usersCount); ?></h3>
                                <p>Watumiaji</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
                                <a href="<?php echo e(route('superadmin.users.index')); ?>" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Total roles -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--matisse);">
                            <div class="inner text-white">
                                <h3><?php echo e($rolesCount); ?></h3>
                                <p>Majukumu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shield"></i>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                                <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Unread Notifications -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--teal-blue);">
                            <div class="inner text-white">
                                <h3><?php echo e($unreadNotifications); ?></h3>
                                <p>Arifa ambazo hazijasomwa</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.notifications.index')): ?>
                                <a href="<?php echo e(route('common.notifications.index')); ?>" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- System Logs -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--cabaret);">
                            <div class="inner text-white">
                                <h3><?php echo e($totalLogs); ?></h3>
                                <p>Kumbukumbu za Mfumo</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.logs.index')): ?>
                                <a href="<?php echo e(route('common.logs.index')); ?>" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications and Announcements -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Arifa Mpya</h3>
                    </div>
                    <div class="card-body">
                        <?php if($notifications->isEmpty()): ?>
                            <div class="alert">Hakuna arifa mpya kwa sasa!</div>
                        <?php else: ?>
                            <div id="notificationsCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-2"><?php echo e($notification->message); ?></h5>
                                                    <p class="card-text">
                                                        <strong>Notification type:</strong> <?php echo e($notification->type); ?><br>
                                                        <small><?php echo e($notification->created_at->format('M d, Y H:i')); ?></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
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
        .card-body p {
            margin-bottom: 0.5rem;
        }

        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- Custom js -->
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 5000
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/superadmin/dashboard.blade.php ENDPATH**/ ?>