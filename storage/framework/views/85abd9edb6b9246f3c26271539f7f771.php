<!-- All css -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(Route::currentRouteName() == 'admin.monthly.contributions.create'): ?>
    <div class="form-group">
        <label for="contribution_type">Aina ya Mchango</label>
        <input type="text" name="contribution_type_name" id="contribution_type" class="form-control"
            value="Mchango wa Mwezi" disabled>
        <input type="hidden" name="contribution_type_id" value="<?php echo e($contributionTypeId); ?>">
    </div>
<?php else: ?>
    <div class="form-group">
        <label for="contribution_type">Aina ya Mchango</label>
        <select name="contribution_type_id" id="contribution_type" class="form-control" required>
            <?php $__currentLoopData = $contributionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contributionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($contributionType->id); ?>"
                    <?php echo e(isset($contribution) && $contribution->contribution_type == $contributionType->id ? 'selected' : ''); ?>>
                    <?php echo e(ucwords($contributionType->name)); ?> (Lengo: <?php echo e($contributionType->goal_amount); ?>)
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php endif; ?>

<div class="form-group">
    <label for="member_id">Mwanachama</label>
    <select name="member_id" id="member_id" class="form-control" required>
        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($member->id); ?>"
                <?php echo e(isset($contribution) && $contribution->member_id == $member->id ? 'selected' : ''); ?>>
                <?php echo e($member->user->full_name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group">
    <label for="paid_amount">Kiasi Kilicholipwa</label>
    <input type="number" name="paid_amount" id="paid_amount" class="form-control"
        value="<?php echo e(old('paid_amount', $contribution->paid_amount ?? '')); ?>" required>
</div>

<div class="form-group">
    <label for="goal_amount">Kiasi cha Lengo</label>
    <input type="number" name="goal_amount" id="goal_amount" class="form-control" value="<?php echo e($goalAmount); ?>" disabled>
</div>

<div class="form-group mb-4">
    <label for="date">Tarehe</label>
    <?php if(Route::currentRouteName() == 'admin.monthly.contributions.edit'): ?>
        <input type="date" name="date" id="date" class="form-control"
            value="<?php echo e(old('date', \Carbon\Carbon::parse($contribution->date)->format('Y-m-d') ?? '')); ?>" required>
    <?php else: ?>
        <input type="date" name="date" id="date" class="form-control" value="<?php echo e(old('date')); ?>" required>
    <?php endif; ?>
</div>

<!-- All js -->
<?php echo $__env->make('backend.components.form.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/resources/views/backend/admin/viwawa/contributions/monthly/form.blade.php ENDPATH**/ ?>