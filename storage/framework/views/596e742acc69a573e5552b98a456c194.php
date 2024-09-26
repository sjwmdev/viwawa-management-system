<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-md" style="background: #042a46">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('common.dashboard')); ?>" class="brand-link"
        style="background-image: url('<?php echo e(asset('logo/viwawa_logo.svg')); ?>'); background-size: cover; background-position: center center; background-color: #343a40;">&nbsp;
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if(auth()->guard()->check()): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.dashboard')): ?>
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('common.dashboard')); ?>" class="nav-link <?php echo e(isRouteActive('dashboard*')); ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p title="Muktasari na Takwimu">Dashibodi</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('common.profile.edit')): ?>
                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('common.profile.edit')); ?>" class="nav-link <?php echo e(isRouteActive('profile*')); ?>">
                                <i class="nav-icon fa fa-user"></i>
                                <p title="Badili Wasifu Wako">Wasifu Wangu</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'superadmin')): ?>
                        <!-- User & Access (Roles & Permissions) Management -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.users.index')): ?>
                            <li class="nav-item mt-2">
                                <a href="<?php echo e(route('superadmin.users.index')); ?>" class="nav-link <?php echo e(isRouteActive('super/users*')); ?>">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Watumiaji</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.roles.index')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('superadmin.roles.index')); ?>" class="nav-link <?php echo e(isRouteActive('super/roles*')); ?>">
                                    <i class="fa fa-key nav-icon"></i>
                                    <p>Majukumu</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin.permissions.index')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('superadmin.permissions.index')); ?>" class="nav-link <?php echo e(isRouteActive('super/permissions*')); ?>">
                                    <i class="fa fa-user-shield nav-icon"></i>
                                    <p>Haki</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.members.index')): ?>
                            <!-- Wanachama -->
                            <li class="nav-item <?php echo e(isMenuOpen(['admin.members', 'admin.monthlz'])); ?> mt-3">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p title="Usimamizi wa Wanachama">
                                        Wanachama
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.members.index')); ?>" class="nav-link <?php echo e(isRouteActive('members*')); ?>">
                                            <i class="fa fa-user-friends nav-icon"></i>
                                            <p>Taarifa za Wanachama</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.monthlz.contributions.report')); ?>" class="nav-link <?php echo e(isRouteActive('monthlz/contributions/report*')); ?>">
                                            <i class="fa fa-file-pdf nav-icon"></i>
                                            <p>Ripoti ya Michango</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.monthly.contributions.index')): ?>
                            <!-- Contributions (Michango) -->
                            <li class="nav-item <?php echo e(isMenuOpen(['admin.monthly.contributions', 'admin.church.contributions'])); ?> mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-donate nav-icon"></i>
                                    <p title="Usimamizi wa Michango">
                                        Michango
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.monthly.contributions.index')); ?>" class="nav-link <?php echo e(isRouteActive('monthly/contributions*')); ?>">
                                            <i class="fa fa-calendar-alt nav-icon"></i>
                                            <p>Michango ya Mwezi</p>
                                        </a>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.church.contributions.index')): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('admin.church.contributions.index')); ?>" class="nav-link <?php echo e(isRouteActive('ujenzi/kanisa*')); ?>">
                                                <i class="fa fa-church nav-icon"></i>
                                                <p>Ujenzi wa Kanisa</p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Incomes (Mapato) -->
                        <li class="nav-item <?php echo e(isMenuOpen(['admin.incomes'])); ?> mt-2">
                            <a href="#" class="nav-link">
                                <i class="fa fa-hand-holding-usd nav-icon"></i>
                                <p title="Usimamizi wa Mapato">
                                    Mapato
                                    <i class="right fas fa-sm fa-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.saturday')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.incomes.saturday')); ?>" class="nav-link <?php echo e(isRouteActive('incomes/saturday*')); ?>">
                                            <i class="fa fa-donate nav-icon"></i>
                                            <p>Mapato ya Jumamosi</p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.other')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.incomes.other')); ?>" class="nav-link <?php echo e(isRouteActive('incomes/other*')); ?>">
                                            <i class="fa fa-hand-holding-usd nav-icon"></i>
                                            <p>Mapato Mengine</p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.expenditures.index')): ?>
                            <!-- Expenditures (Matumizi) -->
                            <li class="nav-item <?php echo e(isMenuOpen(['admin.expenditures'])); ?> mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-solid fa-money-bill nav-icon"></i>
                                    <p title="Usimamizi wa Matumizi">
                                        Matumizi
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.expenditures.index')); ?>" class="nav-link <?php echo e(isRouteActive('expenditures*')); ?>">
                                            <i class="fa fa-receipt nav-icon"></i>
                                            <p>Matumizi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.mfuko-balance.index')): ?>
                            <!-- Mfuko -->
                            <li class="nav-item <?php echo e(isMenuOpen(['admin.mfuko-balance'])); ?> mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-wallet nav-icon"></i>
                                    <p title="Usimamizi wa Mfuko">
                                        Mfuko
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.mfuko-balance.index')); ?>" class="nav-link <?php echo e(isRouteActive('mfuko-balance*')); ?>">
                                            <i class="fa fa-wallet nav-icon"></i>
                                            <p>Balance ya Mfuko</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.attendance.index')): ?>
                            <!-- Attendance -->
                            <li class="nav-item <?php echo e(isMenuOpen(['admin.attendance'])); ?> mt-3">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-calendar-week nav-icon"></i>
                                    <p title="Usimamizi wa Mahudhurio">
                                        Mahudhurio
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.attendance.index')); ?>" class="nav-link <?php echo e(isRouteActive('attendance*')); ?>">
                                            <i class="fa fa-calendar-alt nav-icon"></i>
                                            <p>Jumamosi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Management of Types -->
                        <li class="nav-item <?php echo e(isMenuOpen(['admin.contributions.type', 'admin.incomes.type'])); ?> mt-3">
                            <a href="#" class="nav-link">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p title="Usimamizi wa Aina">
                                    Aina za Usimamizi
                                    <i class="right fas fa-sm fa-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.contributions.type.index')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.contributions.type.index')); ?>" class="nav-link <?php echo e(isRouteActive('contributions/type*')); ?>">
                                            <i class="fa fa-list-alt nav-icon"></i>
                                            <p>Aina za Michango</p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.incomes.type.index')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('admin.incomes.type.index')); ?>" class="nav-link <?php echo e(isRouteActive('incomes/type*')); ?>">
                                            <i class="fa fa-list-alt nav-icon"></i>
                                            <p>Aina za Mapato</p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->hasAnyRole(['superadmin', 'admin', 'viwawa'])): ?>
                        <!-- Notifications -->
                        <li class="nav-header text-muted px-4 mt-2">Taarifa na Arifa</li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('common.notifications.index')); ?>" class="nav-link <?php echo e(isRouteActive('notifications*')); ?>">
                                <i class="fa fa-bell nav-icon"></i>
                                <p title="Arifa za Mfumo">Arifa</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', ['superadmin', 'admin'])): ?>
                        <!-- System Logs -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('common.logs.index')); ?>" class="nav-link <?php echo e(isRouteActive('logs*')); ?>">
                                <i class="fa fa-chart-line nav-icon"></i>
                                <p title="Rekodi za Mfumo">Rekodi</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    
                    <!-- System Logs -->
                    <li class="nav-item mt-2">
                        <a href="<?php echo e(route('superadmin.system.logs.index')); ?>" class="nav-link <?php echo e(isRouteActive('super/system/logs*')); ?>">
                            <i class="nav-icon fas fa-history"></i>
                            <p title="Angalia rekodi za mfumo">System Logs</p>
                        </a>
                    </li>
                    

                    <?php if(auth()->check()): ?>
                        <!-- Logout -->
                        <li class="nav-item bg-danger mt-3">
                            <a href="<?php echo e(route('common.logout')); ?>" class="nav-link">
                                <i class="nav-icon fa fa-sign-out-alt"></i>
                                <p>Ondoka</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /home/sjwmdev/dev/viwawa/resources/views/backend/layout/partials/_leftsidebar.blade.php ENDPATH**/ ?>