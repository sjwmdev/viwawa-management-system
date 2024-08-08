@extends('backend.layout.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ruhusa Mpya</h4>
            <div class="btn-group btn-group-md float-right" role="group">
                @can('superadmin.permissions.index')
                    <a href="{{ route('superadmin.permissions.index') }}" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;&nbsp;Ruhusa Zote
                    </a>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <form action="{{ route('superadmin.permissions.store') }}" method="post" class="form">
                @csrf
                @include('backend.superadmin.permissions.form')
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
