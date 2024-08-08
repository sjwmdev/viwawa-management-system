@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            $(document).ready(function() {
                toastr.error('{{ $error }}', '', {
                    positionClass: 'toast-top-right',
                    preventDuplicates: true,
                    timeOut: 6000,
                    extendedTimeOut: 900,
                });
            });
        </script>
    @endforeach
@endif

@if (session('success'))
    <script>
        $(document).ready(function() {
            toastr.success('{{ session('success') }}', '', {
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: 3000,
                extendedTimeOut: 600,
            });
        });
    </script>
@endif
