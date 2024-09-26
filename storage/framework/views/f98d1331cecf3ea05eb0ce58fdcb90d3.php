<!-- All CSS -->
<?php echo $__env->make('backend.components.form.allcss', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Check if creating a new record -->
<?php if(Route::currentRouteName() == 'admin.church.contributions.create'): ?>
    <input type="hidden" name="contribution_type_id" value="<?php echo e($contributionTypeId); ?>">
<?php endif; ?>

<!-- Family Name -->
<?php if(isset($familyName)): ?>
    <!-- Show disabled input field with the family name -->
    <div class="form-group">
        <label for="family_name">Jina la Familia</label>
        <input type="text" class="form-control" value="<?php echo e($familyName); ?>" disabled>
        <!-- Hidden field to pass the family name -->
        <input type="hidden" name="family_name" value="<?php echo e($familyName); ?>">
    </div>
<?php else: ?>
    <!-- Show editable input field if no family name is passed -->
    <div class="form-group">
        <label for="family_name">Jina la Familia</label>
        <input type="text" name="family_name" id="family_name" class="form-control" value="<?php echo e(old('family_name', $churchContribution->family_name ?? '')); ?>" placeholder="Jina la familia" required>
    </div>
<?php endif; ?>

<!-- Amount Field -->
<div class="form-group">
    <label for="amount">Kiasi Kilichochangwa</label>
    <input type="number" name="amount" id="amount" class="form-control" value="<?php echo e(old('amount', $churchContribution->amount ?? '')); ?>" placeholder="Kiasi" required>
</div>

<!-- Optional Description -->
<div class="form-group">
    <label for="description">Maelezo (Hiari)</label>
    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Maelezo ya mchango"><?php echo e(old('description', $churchContribution->description ?? '')); ?></textarea>
</div>

<!-- Contribution Date -->
<div class="form-group mb-4">
    <label for="contribution_date">Tarehe ya Mchango</label>
    <input type="date" name="contribution_date" id="contribution_date" class="form-control" value="<?php echo e(old('contribution_date', isset($churchContribution) ? \Carbon\Carbon::parse($churchContribution->contribution_date)->format('Y-m-d') : '')); ?>" required>
</div>

<!-- Month Selection -->
<div class="form-group">
    <label for="month">Mwezi</label>
    <select name="month" id="month" class="form-control" required>
        <?php
            $months = [
                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
            ];
        ?>
        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo e(old('month', $churchContribution->month ?? '') == $key ? 'selected' : ''); ?>>
                <?php echo e($month); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<!-- Year Selection -->
<div class="form-group">
    <label for="year">Mwaka</label>
    <select name="year" id="year" class="form-control" required>
        <?php
            $currentYear = now()->year;
            $startYear = $currentYear - 4; // Example: showing the last 5 years and forward
            $endYear = $currentYear + 6;
        ?>
        <?php for($i = $startYear; $i <= $endYear; $i++): ?>
            <option value="<?php echo e($i); ?>" <?php echo e(old('year', $churchContribution->year ?? $currentYear) == $i ? 'selected' : ''); ?>>
                <?php echo e($i); ?>

            </option>
        <?php endfor; ?>
    </select>
</div>

<!-- Status Field -->
<div class="form-group mb-4">
    <label for="status">Hali ya Mchango</label>
    <select name="status" id="status" class="form-control" required>
        <option value="paid" <?php echo e(old('status', $churchContribution->status ?? '') == 'paid' ? 'selected' : ''); ?>>Imelipwa</option>
        <option value="not_paid" <?php echo e(old('status', $churchContribution->status ?? '') == 'not_paid' ? 'selected' : ''); ?>>Haijalipwa</option>
        <option value="ahadi" <?php echo e(old('status', $churchContribution->status ?? '') == 'ahadi' ? 'selected' : ''); ?>>Ahadi</option>
    </select>
</div>

<!-- All JS -->
<?php echo $__env->make('backend.components.form.alljs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/admin/viwawa/contributions/church/form.blade.php ENDPATH**/ ?>