@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Majukumu ya Mfumo">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="my-1 float-left">Majukumu ya Mfumo</h4>
                <div class="btn-group btn-group-md float-right" role="group">
                    @can('superadmin.roles.create')
                        <a href="{{ route('superadmin.roles.create') }}" class="btn btn-outline-light" title="Ongeza Jukumu Jipya">
                            <i class="fas fa-md fa-plus"></i>&nbsp;&nbsp;Ongeza Jukumu Jipya
                        </a>
                    @endcan
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba.</th>
                            <th>Jina</th>
                            <th class="not-printable" width="18%">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="btn-group btn-group-md" role="group">
                                        @can('superadmin.roles.show')
                                            <a href="{{ route('superadmin.roles.show', $role->id) }}" class="btn btn-outline-dark"
                                                title="Onyesha">
                                                Tazama
                                            </a>
                                        @endcan
                                        @can('superadmin.roles.edit')
                                            <a href="{{ route('superadmin.roles.edit', $role->id) }}" class="btn btn-outline-dark"
                                                title="Hariri">
                                                Hariri
                                            </a>
                                        @endcan
                                        @can('superadmin.roles.destroy')
                                            <button class="btn btn-outline-dark" title="Futa" data-toggle="modal"
                                                data-target="#deleteModal{{ $role->id }}">
                                                Futa
                                            </button>
                                        @endcan
                                    </div>

                                    @can('superadmin.roles.destroy')
                                        <!-- Modal for confirmation before deletion -->
                                        <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
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
                                                        Una uhakika unataka kufuta jukumu hili?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Ghairi</button>
                                                        <form action="{{ route('superadmin.roles.destroy', $role->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Futa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
