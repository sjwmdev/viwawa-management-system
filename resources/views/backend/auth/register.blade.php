<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VMS</title>
    
    <!-- All CSS -->
    @include('backend.auth.partials._allcss')
</head>

<body class="hold-transition login-page">
    <div class="register-box">
        <div class="card card-outline">
            <div class="card-header">
                VIWAWA MT. ZITA
            </div>
            <div class="card-body">
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    @include('backend.auth.partials._register_form')
                </form>
                <div class="mt-3 text-center">
                    <a href="{{ route('login.showLoginForm') }}" style="color: var(--teal-blue); opacity: 0.8">Tayari una akaunti? Ingia hapa</a>
                </div>
            </div>
        </div>
    </div>

    <!-- All JS -->
    @include('backend.auth.partials._alljs')
</body>

</html>
