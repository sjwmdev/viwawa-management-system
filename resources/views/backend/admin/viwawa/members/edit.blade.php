@extends('backend.layout.master')

@section('content')
    <div class="container">
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="my-1">Hariri Taarifa za Mwanachama</h4>
                @can('admin.members.index')
                    <div class="btn-group btn-group-sm ml-auto" role="group">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-outline-primary" title="List All">
                            <i class=" fas fa-fw fa-th-list" aria-hidden="true"></i>
                        </a>
                    </div>
                @endcan
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form action="{{ route('admin.members.update', $member->id) }}" method="post" class="form">
                    @method('patch')
                    @csrf
                    @include('backend.admin.viwawa.members.form', ['buttonText' => 'Sasisha Mabadiliko'])
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
