<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Notification Section -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell" style="font-size: 1.8rem"></i>
            <span class="badge badge-danger  text-white" id="unread-notifications-count">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Arifa</span>
            <div class="dropdown-divider"></div>
            <div id="unread-notifications"></div>
            <div class="dropdown-divider"></div>
            <a href="{{ route('common.notifications.index') }}" class="dropdown-item dropdown-footer">Tazama Arifa Zote</a>
        </div>
    </li>

    <!-- UserLogout Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="{{ asset('adminlte/dist/img/dp-avatar-01.png') }}" style="height: 40px; width: 50px;"
                alt="picha-wasifu" class="img-size-0 mr-2 img-circle">
            <span class="mr-2">
                @auth
                    {{ auth()->user()->full_name ?? Str::ucfirst(auth()->user()->email) }}
                @endauth
                @guest
                    Mgeni
                @endguest
            </span>
            <span class="fas fa-caret-down"></span>
        </a>
        @auth
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('common.profile.edit') }}" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Wasifu Wangu 
                            </h3>
                            <p class="text-sm text-muted">Mipangilio ya Akaunti</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>

                <a href="{{ route('common.logout') }}" class="dropdown-item" role="button">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Ondoka
                                <span class="float-right text-md text-danger"><i
                                        class="fas fa-power-off red fa-md"></i></span>
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
        @endauth
    </li>
</ul>
