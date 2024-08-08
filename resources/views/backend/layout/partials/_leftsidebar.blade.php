<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-md" style="background: #042a46">
    <!-- Brand Logo -->
    <a href="{{ route('common.dashboard') }}" class="brand-link"
        style="background-image: url('{{ asset('logo/viwawa_logo.svg') }}'); background-size: cover; background-position: center center; background-color: #343a40;">&nbsp;
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                    @can('common.dashboard')
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('common.dashboard') }}" class="nav-link {{ isRouteActive('dashboard*') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p title="Muktasari na Takwimu">Dashibodi</p>
                            </a>
                        </li>
                    @endcan

                    @can('common.profile.edit')
                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="{{ route('common.profile.edit') }}" class="nav-link {{ isRouteActive('profile*') }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p title="Badili Wasifu Wako">Wasifu Wangu</p>
                            </a>
                        </li>
                    @endcan

                    @hasrole('superadmin')
                        <!-- User & Access (Roles & Permissions) Management -->
                        @can('superadmin.users.index')
                            <li class="nav-item mt-2">
                                <a href="{{ route('superadmin.users.index') }}" class="nav-link {{ isRouteActive('super/users*') }}">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Watumiaji</p>
                                </a>
                            </li>
                        @endcan
                        @can('superadmin.roles.index')
                            <li class="nav-item">
                                <a href="{{ route('superadmin.roles.index') }}" class="nav-link {{ isRouteActive('super/roles*') }}">
                                    <i class="fa fa-key nav-icon"></i>
                                    <p>Majukumu</p>
                                </a>
                            </li>
                        @endcan
                        @can('superadmin.permissions.index')
                            <li class="nav-item">
                                <a href="{{ route('superadmin.permissions.index') }}" class="nav-link {{ isRouteActive('super/permissions*') }}">
                                    <i class="fa fa-user-shield nav-icon"></i>
                                    <p>Haki</p>
                                </a>
                            </li>   
                        @endcan  
                    @endhasrole

                    @hasrole('admin')
                        @can('admin.members.index')
                            <!-- Wanachama -->
                            <li class="nav-item {{ isMenuOpen(['admin.members', 'admin.monthlz']) }} mt-3">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p title="Usimamizi wa Wanachama">
                                        Wanachama
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.members.index') }}" class="nav-link {{ isRouteActive('members*') }}">
                                            <i class="fa fa-user-friends nav-icon"></i>
                                            <p>Taarifa za Wanachama</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.monthlz.contributions.report') }}" class="nav-link {{ isRouteActive('monthlz/contributions/report*') }}">
                                            <i class="fa fa-file-pdf nav-icon"></i>
                                            <p>Ripoti ya Michango</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.monthly.contributions.index')
                            <!-- Contributions (Michango) -->
                            <li class="nav-item {{ isMenuOpen(['admin.monthly.contributions']) }} mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-donate nav-icon"></i>
                                    <p title="Usimamizi wa Michango">
                                        Michango
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.monthly.contributions.index') }}" class="nav-link {{ isRouteActive('monthly/contributions*') }}">
                                            <i class="fa fa-calendar-alt nav-icon"></i>
                                            <p>Michango ya Mwezi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        <!-- Incomes (Mapato) -->
                        <li class="nav-item {{ isMenuOpen(['admin.incomes']) }} mt-2">
                            <a href="#" class="nav-link">
                                <i class="fa fa-hand-holding-usd nav-icon"></i>
                                <p title="Usimamizi wa Mapato">
                                    Mapato
                                    <i class="right fas fa-sm fa-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin.incomes.saturday')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.incomes.saturday') }}" class="nav-link {{ isRouteActive('incomes/saturday*') }}">
                                            <i class="fa fa-donate nav-icon"></i>
                                            <p>Mapato ya Jumamosi</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.incomes.other')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.incomes.other') }}" class="nav-link {{ isRouteActive('incomes/other*') }}">
                                            <i class="fa fa-hand-holding-usd nav-icon"></i>
                                            <p>Mapato Mengine</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @can('admin.expenditures.index')
                            <!-- Expenditures (Matumizi) -->
                            <li class="nav-item {{ isMenuOpen(['admin.expenditures']) }} mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-solid fa-money-bill nav-icon"></i>
                                    <p title="Usimamizi wa Matumizi">
                                        Matumizi
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.expenditures.index') }}" class="nav-link {{ isRouteActive('expenditures*') }}">
                                            <i class="fa fa-receipt nav-icon"></i>
                                            <p>Matumizi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.mfuko-balance.index')
                            <!-- Mfuko -->
                            <li class="nav-item {{ isMenuOpen(['admin.mfuko-balance']) }} mt-2">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-wallet nav-icon"></i>
                                    <p title="Usimamizi wa Mfuko">
                                        Mfuko
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.mfuko-balance.index') }}" class="nav-link {{ isRouteActive('mfuko-balance*') }}">
                                            <i class="fa fa-wallet nav-icon"></i>
                                            <p>Balance ya Mfuko</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('admin.attendance.index')
                            <!-- Attendance -->
                            <li class="nav-item {{ isMenuOpen(['admin.attendance']) }} mt-3">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-check-square nav-icon"></i>
                                    <p title="Usimamizi wa Mahudhurio">
                                        Mahudhurio
                                        <i class="right fas fa-sm fa-caret-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.attendance.index') }}" class="nav-link {{ isRouteActive('attendance*') }}">
                                            <i class="fa fa-check-square nav-icon"></i>
                                            <p>Mahudhurio ya Wanachama</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        <!-- Management of Types -->
                        <li class="nav-item {{ isMenuOpen(['admin.contributions.type', 'admin.incomes.type']) }} mt-3">
                            <a href="#" class="nav-link">
                                <i class="fa fa-cogs nav-icon"></i>
                                <p title="Usimamizi wa Aina">
                                    Aina za Usimamizi
                                    <i class="right fas fa-sm fa-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin.contributions.type.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.contributions.type.index') }}" class="nav-link {{ isRouteActive('contributions/type*') }}">
                                            <i class="fa fa-list-alt nav-icon"></i>
                                            <p>Aina za Michango</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.incomes.type.index')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.incomes.type.index') }}" class="nav-link {{ isRouteActive('incomes/type*') }}">
                                            <i class="fa fa-list-alt nav-icon"></i>
                                            <p>Aina za Mapato</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endhasrole
                    
                    @if (auth()->user()->hasAnyRole(['superadmin', 'admin', 'viwawa']))
                        <!-- Notifications -->
                        <li class="nav-header text-muted px-4 mt-2">Taarifa na Arifa</li>
                        <li class="nav-item">
                            <a href="{{ route('common.notifications.index') }}" class="nav-link {{ isRouteActive('notifications*') }}">
                                <i class="fa fa-bell nav-icon"></i>
                                <p title="Arifa za Mfumo">Arifa</p>
                            </a>
                        </li>
                    @endif

                    @hasrole(['superadmin', 'admin'])
                        <!-- System Logs -->
                        <li class="nav-item">
                            <a href="{{ route('common.logs.index') }}" class="nav-link {{ isRouteActive('logs*') }}">
                                <i class="fa fa-chart-line nav-icon"></i>
                                <p title="Rekodi za Mfumo">Rekodi</p>
                            </a>
                        </li>
                    @endhasrole

                    {{-- @hasrole('superadmin') --}}
                    <!-- System Logs -->
                    <li class="nav-item mt-2">
                        <a href="{{ route('superadmin.system.logs.index') }}" class="nav-link {{ isRouteActive('super/system/logs*') }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p title="Angalia rekodi za mfumo">System Logs</p>
                        </a>
                    </li>
                    {{-- @endhasrole --}}

                    @if (auth()->check())
                        <!-- Logout -->
                        <li class="nav-item bg-danger mt-3">
                            <a href="{{ route('common.logout') }}" class="nav-link">
                                <i class="nav-icon fa fa-sign-out-alt"></i>
                                <p>Ondoka</p>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
