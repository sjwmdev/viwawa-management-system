@extends('backend.layout.master')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Lo!</strong> Kulikuwa na matatizo katika taarifa zako.<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ongeza Jukumu Jipya</h4>
            @can('superadmin.roles.index')
                <div class="btn-group btn-group-md float-right" role="group">
                    <a href="{{ route('superadmin.roles.index') }}" class="btn btn-outline-light" title="Orodha ya Majukumu">
                        <i class="fas fa-list"></i> Majukumu Yote
                    </a>
                </div>
            @endcan
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <form action="{{ route('superadmin.roles.store') }}" method="post" class="form">
                @csrf
                @include('backend.superadmin.roles.form')
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
