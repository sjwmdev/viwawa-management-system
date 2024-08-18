<?php $__env->startSection('css'); ?>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">

    <style>
        .card-header {
            background-color: var(--matisse);
            color: white;
        }

        .btn-outline-light,
        .btn-outline-success {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover,
        .btn-outline-success:hover {
            background-color: white;
            color: var(--matisse);
        }

        .btn-outline-primary {
            border-color: var(--matisse);
            color: var(--blue-whale);
        }

        .btn-outline-primary:hover {
            border-color: var(--matisse);
            background-color: var(--matisse);
            color: white;
        }

        .btn-outline-danger {
            border-color: var(--cabaret);
            color: var(--cabaret);
        }

        .btn-outline-danger:hover {
            background-color: var(--cabaret);
            color: white;
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

        .btn-group .btn {
            margin-right: 5px;
        }

        .badge-size {
            padding: 0.5em 0.75em;
            font-size: 0.85em;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-td-sm {
            font-size: 1rem
        }

        .table-td-md {
            font-size: 1.1rem;
        }

        .table-td-lg {
            font-size: 1.8rem;
        }

        .tfooter-mr {
            margin-right: 0;
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

        .balance-amount {
            font-size: 2.5rem;
            font-weight: bold;
            /* color: #28a745; */
            color: #208a39;
        }

        .balance-date {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .badge.even-larger-badge {
            font-size: 1.2em;
        }

        .badge.even-md-badge {
            font-size: .7em;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/backend/components/index/allcss.blade.php ENDPATH**/ ?>