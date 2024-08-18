@section('css')
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
            background-color: var(--tulip-tree);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--matisse);
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

        .badge-size {
            padding: 0.5em 0.75em;
            font-size: 0.85em;
        }
        
        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
        }

        fieldset {
            /* border: 1px solid var(--matisse); */
            border: 1px solid #dfdfdf;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        legend {
            width: auto;
            padding: 0 10px;
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--matisse);
        }
        .modal-header {
            background-color: var(--matisse);
            color: white;
        }

        .modal-footer .btn-secondary {
            background-color: var(--iron);
            color: #333;
        }

        .modal-footer .btn-danger {
            background-color: var(--cabaret);
        }
        .close {
            color: white;
        }
        .close:hover {
            color: white;
        }
    </style>
@endsection
