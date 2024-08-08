@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="card-header">
                <h4 class="my-1 float-left">Maelezo ya Jukumu</h4>
                <div class="float-right">
                    <div class="btn-group btn-group-md" role="group">
                        @can('superadmin.roles.index')
                            <a href="{{ route('superadmin.roles.index') }}" class="btn btn-outline-light" title="Orodha ya Majukumu">
                                <i class="fas fa-list"></i> Majukumu Yote
                            </a>
                        @endcan
                        @can('superadmin.roles.create')
                            <a href="{{ route('superadmin.roles.create') }}" class="btn btn-outline-light" title="Ongeza Jukumu Jipya">
                                <i class="fas fa-plus"></i> Ongeza Jukumu Jipya
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item h4">{{ ucfirst($role->name) }}</li>
                    @if ($rolePermissions->count() > 0)
                        <li class="list-group-item">
                            <div class="container mt-3 float-left table-container">
                                <h4>Ruhusa Zilizotolewa</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="70%">Jina</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rolePermissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @else
                        <li class="list-group-item text-center">Hakuna ruhusa zilizotolewa</li>
                    @endif
                </ul>
                <div class="float-right mt-4">
                    @can('superadmin.roles.edit')
                        <a href="{{ route('superadmin.roles.edit', $role->id) }}" class="btn btn-primary">Hariri Rekodi</a>
                    @endcan
                    @can('superadmin.roles.index')
                        <a href="{{ route('superadmin.roles.index') }}" class="btn btn-default">Ghairi</a>
                    @endcan
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

<!-- Custom css -->
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
    </style>
@endsection