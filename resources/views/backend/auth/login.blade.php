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
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header">
                VIWAWA MT. ZITA
            </div>
            <div class="card-body">
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    @include('backend.auth.partials._login_form')
                </form>
                <div class="mt-3 text-center" hidden>
                    <a href="{{--{{ route('password.request') }}--}}" class="text-warning">Weka upya nenosiri lako</a>
                </div>
                <div class="mt-3 text-center" hidden>
                    <a href="{{ route('register') }}" style="color: var(--teal-blue); opacity: 0.8">Huna akaunti? Jisajili hapa</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- All JS -->
    @include('backend.auth.partials._alljs')
</body>

</html>
