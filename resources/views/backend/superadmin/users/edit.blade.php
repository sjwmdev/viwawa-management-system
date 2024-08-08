@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card mx-auto" style="max-width: 800px;">
            <div class="card-header">
                <h4 class="my-1 float-left">Hariri Mtumiaji</h4>
                @can('superadmin.users.index')
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="{{ route('superadmin.users.index') }}" class="btn btn-outline-light" title="List All">
                            <i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                @endcan
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('superadmin.users.update', $user->id) }}" method="post" class="form">
                        @method('patch')
                        @csrf
                        @include('backend.superadmin.users.form')
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
