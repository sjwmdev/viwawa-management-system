<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>@yield('title', 'Mt.Zita - Michango ya Ujenzi')</title>

    <!-- Google Font: Source Sans Pro for a Clean Professional Look -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/frontend.min.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    @yield('css')
</head>

<body class="hold-transition layout-top-nav layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark">
            <div class="container">
                <!-- Brand Logo -->
                <a href="{{ url()->current() }}" class="navbar-brand">
                    <img src="{{ asset('logo/viwawa-logo.jpg') }}" alt="Logo" class="brand-image">
                    <span>&nbsp;@yield('brandtitle', 'Jumuiya ya Mt.Zita')</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Centered Header -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <h5 class="m-0">@yield('header', 'Michango ya Ujenzi wa Kanisa')</h5>
                        </li>
                    </ul>

                    <!-- Year Selection Dropdown -->
                    @yield('chaguamwaka')
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Month Filter Section -->
            <div class="content-header">
                <div class="container">
                    <div class="row mt-4">
                        <div class="col-12">
                            <!-- Share Button Implementation -->
                            <p>
                                <button class="btn btn-sm btn-primary" id="shareButton">
                                    <i class="fas fa-share-alt"></i> Shiriki Ukurasa
                                </button>
                            </p>
                        </div>
                        <div class="col-sm-12 text-center">
                            @yield('month-filter')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <!-- Left side: Copyright message -->
                    <div class="col-sm-6 text-left">
                        <strong>&copy; 2024 VMS.</strong> Haki zote zimehifadhiwa.
                    </div>

                    <!-- Right side: Developed by Nafsi Labs Limited -->
                    <div class="col-sm-6 text-right font-italic">
                        <span>Developed and maintained by <b>Nafsi Labs Limited</b></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    @yield('js')
    <script>
        // Function to handle year selection
        function selectYear(year) {
            document.getElementById('selectedYear').value = year;
            document.getElementById('yearForm').submit(); // Submit the form when year is selected
        }

        // Ensure the dropdown retains the selected value
        $(document).ready(function() {
            let selectedYear = '{{ request('year', now()->year) }}'; // Default to current year
            $('#dropdownYear').text('Mwaka ' + selectedYear); // Set dropdown button label

            // Share functionality using Web Share API
            let shareData = {
                title: 'Michango ya Ujenzi wa Kanisa',
                text: 'Tazama michango ya ujenzi wa kanisa kupitia jumuiya ya Mt.Zita.',
                url: window.location.href
            };

            $('#shareButton').click(function() {
                if (navigator.share) {
                    navigator.share(shareData)
                        .then(() => console.log('Shared successfully'))
                        .catch(error => console.error('Error sharing:', error));
                } else {
                    alert('Sharing is not supported on this browser.');
                }
            });
        });
    </script>
</body>

</html>
