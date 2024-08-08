<!DOCTYPE html>
<html>

<head>
    <title>VMS</title>

    @foreach (asset_files('adminlte/plugins', 'adminlte/dist/css') as $css)
        <link rel="stylesheet" href="{{ $css }}">
    @endforeach

    @foreach (asset_files('adminlte/plugins', 'adminlte/dist/js') as $js)
        <script src="{{ $js }}"></script>
    @endforeach

    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <img src="{{ asset('images/preloader-05.gif') }}" alt="VIWAWA MT. ZITA" width="120px" height="120px">
    </div>
</body>

</html>
