@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Watumiaji Waliosajiliwa">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Watumiaji Wote</h4>
                <div class="btn-group btn-group-md float-right" role="group">
                    @can('superadmin.students.create.allowed')
                        <a href="{{ route('superadmin.students.create') }}" class="btn btn-outline-light" title="Ongeza Mwanafunzi">
                            <i class="fas fa-fw fa-user-graduate"></i> Ongeza Mwanafunzi
                        </a>
                    @endcan
                    @can('superadmin.lecturers.create.allowed')
                        <a href="{{ route('superadmin.lecturers.create') }}" class="btn btn-outline-light" title="Ongeza Mhadhiri">
                            <i class="fas fa-fw fa-chalkboard-teacher"></i> Ongeza Mhadhiri
                        </a>
                    @endcan
                    @can('superadmin.users.create')
                        <a href="{{ route('superadmin.users.create') }}" class="btn btn-outline-light" title="Ongeza Mtumiaji">
                            <i class="fas fa-fw fa-user-plus"></i> Ongeza Mtumiaji Mpya
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Namba</th>
                            <th>Jina</th>
                            <th>Anuani ya Barua Pepe</th>
                            <th>Majukumu</th>
                            <th class="not-printable" width="5%">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::ucfirst($user->full_name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge" style="background-color: var(--matisse);">
                                            <a href="{{ route('superadmin.roles.show', $role->id) }}" class="text-white">{{ $role->name }}</a>
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group btn-group-md" role="group">
                                        @php
                                            $role = $user->roles->first();
                                            $routeName = '';
                                            $endpoint = '';

                                            if ($role) {
                                                switch ($role->name) {
                                                    case 'admin':
                                                        $routeName = 'superadmin.users.show';
                                                        $endpoint = $user;
                                                        break;
                                                    case 'viwawa':
                                                        $routeName = 'admin.members.show';
                                                        $endpoint = $user->member;
                                                        break;
                                                    default:
                                                        $routeName = 'superadmin.users.show';
                                                        $endpoint = $user;
                                                        break;
                                                }
                                            }
                                        @endphp
                                        @if ($endpoint)
                                            <a href="{{ route($routeName, $endpoint->id) }}" class="btn btn-outline-secondary" title="Onyesha">
                                                Tazama
                                            </a>
                                        @else
                                            <span class="btn btn-outline-secondary disabled" title="Onyesha">
                                                Tazama
                                            </span>
                                        @endif
                                        <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-outline-secondary" title="Hariri">
                                            Hariri
                                        </a>
                                        <button class="btn btn-outline-secondary" title="Futa" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                                            Futa
                                        </button>
                                    </div>

                                    <!-- Modal for confirmation before deletion -->
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Je, una uhakika unataka kufuta mtumiaji huyu?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                                    <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Futa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
