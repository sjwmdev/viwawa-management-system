<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta tags -->
    @yield('meta')

    <title>VMS</title>
    <!-- Google Font: Source Sans Pro Offline -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/fonts/source-sans-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bs-stepper/css/bs-stepper.min.css') }}">

    <!-- CSS toastr alert -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    @yield('css')
    @include('backend.layout.partials._preload')
</head>

<body class="hold-transition sidebar-mini layout-footer-fixed layout-navbar-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light text-md">
            @include('backend.layout.partials._navbar')
        </nav>

        <div id="leftsidebar">
            @include('backend.layout.partials._leftsidebar')
        </div>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @include('backend.layout.partials._breadcrumb')
                </div>
            </div>

            <div class="content" style="margin-top: -2rem;">
                <div class="container-fluid">
                    <div class="box-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('adminlte/dist/icons/ionicons-esm.min') }}"></script>
    <script src="{{ asset('adminlte/dist/icons/ionicons.min.js') }}"></script>

    <!-- JS and logic for toastr alert -->
    <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
    @include('backend.components.notification_dropdown_js')
    @include('backend.layout.partials._toastr_message')

    <script>
        $(document).ready(function() {
            // Get the current state of the pushmenu
            var pushMenuState = localStorage.getItem('pushMenuState');

            // If the pushmenu is currently open, keep it open
            if (pushMenuState === 'open') {
                $('body').addClass('sidebar-collapse');
            }

            // Add a listener to the pushmenu button
            $('[data-widget="pushmenu"]').on('click', function() {
                // Get the new state of the pushmenu
                var newPushMenuState = $('body').hasClass('sidebar-collapse') ? 'closed' : 'open';

                // Save the new state of the pushmenu to local storage
                localStorage.setItem('pushMenuState', newPushMenuState);
            });
        });
    </script>

    @yield('js')
</body>
</html>
