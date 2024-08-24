<?php $__env->startSection('content'); ?>
    <div class="container p-4 shadow-sm rounded" style="background-color: #f0f4f8;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark">Arifa</h1>
            <?php if($notifications->count() > 1): ?>
                <button id="clearAllBtn" class="btn btn-danger btn-sm" onclick="clearAllNotifications()">Futa Arifa
                    Zote</button>
            <?php endif; ?>
        </div>
        <?php if($notifications->isEmpty()): ?>
            <div class="alert alert-info">Hakuna arifa zilizopatikana.</div>
        <?php else: ?>
            <ul class="list-group" id="notificationList">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item mb-3 shadow-sm" id="notification-<?php echo e($notification->id); ?>">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold text-primary"><?php echo e($notification->title); ?></div>
                                <p class="mb-1"><?php echo e($notification->message); ?></p>
                                <small class="text-muted">Aina:
                                    <?php echo e(ucfirst(str_replace('_', ' ', $notification->type))); ?></small>
                            </div>
                            <div class="d-flex flex-column text-end">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="badge bg-secondary-c rounded-pill-0 p-1"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                    <button type="button" class="close ms-2" aria-label="Close"
                                        onclick="removeNotification(<?php echo e($notification->id); ?>)"
                                        style="font-size: 1.2rem; line-height: 1; margin-left: 10px">
                                        <span aria-hidden="true" title="remove">&times;</span>
                                    </button>
                                </div>
                                <?php if($notification->read_at): ?>
                                    <div class="mt-1">
                                        <span class="badge bg-success rounded-pill">Imesomwa</span>
                                    </div>
                                <?php else: ?>
                                    <div class="mt-1">
                                        <span class="badge bg-danger rounded-pill">Haijasomwa</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.notifications.index')): ?>
                            <button class="btn btn-link mt-2" type="button" data-toggle="collapse"
                                data-target="#collapse<?php echo e($notification->id); ?>" aria-expanded="false"
                                aria-controls="collapse<?php echo e($notification->id); ?>" onclick="markAsRead(<?php echo e($notification->id); ?>)">
                                Tazama Maelezo
                            </button>
                        <?php endif; ?>

                        <div class="collapse mt-2" id="collapse<?php echo e($notification->id); ?>">
                            <div class="card card-body">
                                <p><strong>Maelezo ya Arifa:</strong></p>
                                <p><?php echo e($notification->message); ?></p>
                                <p><strong>Aina:</strong> <?php echo e(ucfirst(str_replace('_', ' ', $notification->type))); ?></p>
                                <p><strong>Imetengenezwa Tarehe:</strong>
                                    <?php echo e($notification->created_at->format('M d, Y H:i:s')); ?></p>
                                <p><strong>Imesomwa Tarehe:</strong>
                                    <?php echo e($notification->read_at ? $notification->read_at->format('M d, Y H:i:s') : 'Haijasomwa'); ?>

                                </p>
                                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                                    <p><strong>Taarifa za Mfano:</strong></p>
                                    <ul>
                                        <?php $__currentLoopData = json_decode($notification->model_info, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><strong><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</strong>
                                                <?php echo e($value); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<!-- Custom css -->
<?php $__env->startSection('css'); ?>
    <style>
        .container {
            max-width: 900px;
        }

        h1 {
            color: var(--matisse);
        }

        .list-group-item {
            border-radius: 0.5rem;
            background-color: #ffffff;
            position: relative;
        }

        .list-group-item .fw-bold {
            font-size: 1.2rem;
        }

        .badge {
            font-size: 0.75rem;
            color: #666;
        }

        .badge.bg-secondary-c {
            font-size: 0.8rem;
        }

        .badge.bg-success {
            background-color: var(--tulip-tree);
        }

        .badge.bg-danger {
            background-color: var(--cabaret);
        }

        .btn-link {
            color: var(--dodger-blue);
            text-decoration: none;
            padding: 0;
        }

        .btn-link:hover {
            color: var(--cabaret);
            text-decoration: underline;
        }

        .card {
            margin-bottom: 1rem;
            border: none;
        }

        .close {
            background: none;
            border: none;
            font-size: 1.2rem;
            line-height: 1;
            margin-left: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- Custom js -->
<?php $__env->startSection('js'); ?>
    <script>
        function clearAllNotifications() {
            if (confirm('Una uhakika unataka kufuta arifa zote?')) {
                fetch('<?php echo e(route('common.notifications.clearAll')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('notificationList').innerHTML =
                                '<div class="alert alert-info">Hakuna arifa zilizopatikana.</div>';
                        } else {
                            alert('Kuna tatizo limejitokeza, tafadhali jaribu tena.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Kuna tatizo limejitokeza, tafadhali jaribu tena.');
                    });
            }
        }

        function markAsRead(notificationId) {
            fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`notification-${notificationId}`).querySelector('.badge.bg-danger')
                            .classList.replace('bg-danger', 'bg-success');
                        document.getElementById(`notification-${notificationId}`).querySelector('.badge.bg-success')
                            .textContent = 'Imesomwa';
                    }
                });
        }

        function removeNotification(notificationId) {
            fetch(`/notifications/remove-notification/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`notification-${notificationId}`).remove();
                    }
                });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/backend/common/notifications/index.blade.php ENDPATH**/ ?>