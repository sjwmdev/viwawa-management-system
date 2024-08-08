@extends('backend.layout.master')

@section('content')
    <div class="card card-info card-outline">
        <div class="card-header">
            <h4 class="my-1 float-left">Sasisha Ruhusa</h4>
            <div class="btn-group btn-group-sm float-right" role="group">
                @can('superadmin.permissions.index')
                    <a href="{{ route('superadmin.permissions.index') }}" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;&nbsp;Ruhusa Zote
                    </a>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="col-md-12">
                @can('superadmin.permissions.update.allowed')
                    <form action="{{ route('superadmin.permissions.update', $permission->id) }}" method="post" class="form">
                        @method('patch')
                        @csrf
                        @include('backend.superadmin.permissions.form')
                    </form>
                @endcan
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
