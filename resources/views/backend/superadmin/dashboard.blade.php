@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container-fluid">

        <!-- Stats Widgets -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--tulip-tree);">
                            <div class="inner text-auto">
                                <h3>{{ $usersCount }}</h3>
                                <p>Watumiaji</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            @can('superadmin.users.index')
                                <a href="{{ route('superadmin.users.index') }}" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endcan
                        </div>
                    </div>

                    <!-- Total roles -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--matisse);">
                            <div class="inner text-white">
                                <h3>{{ $rolesCount }}</h3>
                                <p>Majukumu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shield"></i>
                            </div>
                            @can('superadmin.roles.index')
                                <a href="{{ route('superadmin.roles.index') }}" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endcan
                        </div>
                    </div>

                    <!-- Unread Notifications -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--teal-blue);">
                            <div class="inner text-white">
                                <h3>{{ $unreadNotifications }}</h3>
                                <p>Arifa ambazo hazijasomwa</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            @can('common.notifications.index')
                                <a href="{{ route('common.notifications.index') }}" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endcan
                        </div>
                    </div>

                    <!-- System Logs -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box" style="background-color: var(--cabaret);">
                            <div class="inner text-white">
                                <h3>{{ $totalLogs }}</h3>
                                <p>Kumbukumbu za Mfumo</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            @can('common.logs.index')
                                <a href="{{ route('common.logs.index') }}" class="small-box-footer">Maelezo Zaidi <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endcan
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
                        @if ($notifications->isEmpty())
                            <div class="alert">Hakuna arifa mpya kwa sasa!</div>
                        @else
                            <div id="notificationsCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($notifications as $index => $notification)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-2">{{ $notification->message }}</h5>
                                                    <p class="card-text">
                                                        <strong>Notification type:</strong> {{ $notification->type }}<br>
                                                        <small>{{ $notification->created_at->format('M d, Y H:i') }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Custom css -->
@section('css')
    <style>
        .card-body p {
            margin-bottom: 0.5rem;
        }

        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }
    </style>
@endsection

<!-- Custom js -->
@section('js')
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 5000
            });
        });
    </script>
@endsection
