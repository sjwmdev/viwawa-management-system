@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Ruhusa (Permissions) Zote">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ruhusa Zote</h4>
            <div class="btn-group btn-group-md float-right" role="group">
                @can('superadmin.permissions.create')
                    <a href="{{ route('superadmin.permissions.create') }}" class="btn btn-outline-light" title="Ongeza Ruhusa">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Ongeza Ruhusa
                    </a>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="5%">Na.</th>
                        <th>Jina</th>
                        <th>Mlinzi</th>
                        <th class="not-printable" width="5%" hidden>Vitendo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td hidden>
                                <div class="btn-group btn-group-md" role="group">
                                    @can('superadmin.permissions.edit.allowed')
                                        <a href="{{ route('superadmin.permissions.edit', $permission->id) }}"
                                            class="btn btn-outline-dark" title="Hariri">
                                            Hariri
                                        </a>
                                    @endcan
                                    @can('superadmin.permissions.destroy.allowed')
                                        <!-- Modal for confirmation before deletion -->
                                        <div class="modal fade" id="deleteModal{{ $permission->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Una uhakika unataka kufuta ruhusa hii?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Ghairi</button>
                                                        <form action="{{ route('superadmin.permissions.destroy', $permission->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Futa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button to trigger the modal -->
                                        <button class="btn btn-outline-dark" title="Futa" data-toggle="modal"
                                            data-target="#deleteModal{{ $permission->id }}">
                                            Futa
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
