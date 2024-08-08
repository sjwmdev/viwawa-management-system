@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            // Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endsection