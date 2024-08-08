@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">            
            <div class="card-header">
                <h4 class="my-1 float-left">Ongeza Mwanachama</h4>
                @can('superadmin.users.index')
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="{{ route('superadmin.users.index') }}" class="btn btn-outline-primary" title="List All">
                            <i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                @endcan
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form action="{{ route('superadmin.users.store') }}" method="post" class="form">
                    @csrf
                    @include('backend.superadmin.users.form')
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
