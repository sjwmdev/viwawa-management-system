@extends('backend.layout.master')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lo!</strong> Kulikuwa na matatizo katika taarifa zako.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white h4">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Sasisha Jukumu</h4>
            @can('superadmin.roles.index')
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="{{ route('superadmin.roles.index') }}" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-list"></i> Majukumu Yote
                    </a>
                </div>
            @endcan
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="col-md-12">
                <form action="{{ route('superadmin.roles.update', $role->id) }}" method="post" class="form">
                    @method('patch')
                    @csrf
                    @include('backend.superadmin.roles.form')
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
