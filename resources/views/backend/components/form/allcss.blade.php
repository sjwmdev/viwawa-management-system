@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .card-header {
            background-color: var(--matisse);
            color: white;
        }

        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: var(--matisse);
        }

        .btn-primary {
            background-color: var(--matisse);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--tulip-tree);
        }

        .btn-info {
            background-color: var(--matisse);
            border: none;
        }

        .btn-info:hover {
            background-color: var(--tulip-tree);
        }

        .btn-default {
            background-color: var(--iron);
            border: none;
            color: #333;
        }

        .btn-default:hover {
            background-color: var(--slate-gray);
            color: white;
        }

        .btn-outline-primary {
            border-color: var(--tulip-tree);
            color: var(--tulip-tree);
        }

        .btn-outline-primary:hover {
            background-color: var(--tulip-tree);
            color: white;
        }

        .form-control:focus {
            border-color: var(--matisse);
            box-shadow: none;
        }

        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
        }

        .table-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .form-group label {
            font-weight: bold;
            color: var(--matisse);
        }
        
        .k-lengo {
            font-size: 1.2rem;
        }
    </style>
@endsection
