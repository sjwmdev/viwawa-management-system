@extends('backend.layout.master')

<!-- All show css -->
@include('backend.components.show.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <h4 class="my-1 float-left">Maelezo ya Mtumiaji</h4>

                <div class="float-right">
                    <div class="btn-group btn-group-md" role="group">
                        @can('superadmin.users.index')
                            <a href="{{ route('superadmin.users.index') }}" class="btn btn-outline-light"
                                title="Orodha ya Watumiaji">
                                <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;Watumiaji Wote
                            </a>
                        @endcan
                        @can('superadmin.users.create')
                            <a href="{{ route('superadmin.users.create') }}" class="btn btn-outline-light"
                                title="Ongeza Mtumiaji Mpya">
                                <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>&nbsp;Ongeza Mtumiaji
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <fieldset>
                    <legend>Taarifa Binafsi</legend>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Jina:</b> {{ ucwords($user->full_name) }}</li>
                        <li class="list-group-item"><b>Barua Pepe:</b> {{ $user->email ?? '-' }}</li>
                        <li class="list-group-item"><b>Namba ya Simu:</b> {{ $user->phone_number }}</li>
                        <li class="list-group-item"><b>Nenosiri la Mwanzo:&nbsp;</b><span
                                class="text-danger">{{ $user->getPasswordStatus($user->password) }}</span></li>
                        <li class="list-group-item"><b>Majukumu:</b>
                            @foreach ($user->roles as $role)
                                <span class="badge p-2 ml-2" style="background-color: var(--matisse); font-size: 1rem">
                                    <a href="{{ route('superadmin.roles.show', $role->id) }}"
                                        class="text-white">{{ $role->name }}</a>
                                </span>
                            @endforeach
                        </li>
                    </ul>
                </fieldset>

                @role('superadmin')
                    <fieldset>
                        <legend>Taarifa za Ukaguzi</legend>
                        <ul class="list-group list-group-flush">
                            @if ($user && $user->creator && $user->creator->id != auth()->id())
                                <li class="list-group-item"><b>Amesajiliwa na:</b>
                                    {{ $user->creator->full_name ?? '-' }}</li>
                            @endif
                            <li class="list-group-item"><b>Mwanachama
                                    Tangu:</b>&nbsp;{{ $user->created_at ?? '-' }},
                                {{ $user->created_at_human ?? '-' }}</li>
                            @if ($user && $user->updater && $user->updater->id != auth()->id())
                                <li class="list-group-item"><b>Imesasishwa na:</b>
                                    {{ $user->updater->full_name ?? '-' }}</li>
                            @endif
                            <li class="list-group-item"><b>Imesasishwa:</b>&nbsp;{{ $user->updated_at ?? '-' }},
                                {{ $user->updated_at_human ?? '-' }}</li>
                        </ul>
                    </fieldset>
                @endrole

                <div class="float-left ml-4 mt-4">
                    @can('superadmin.users.edit')
                        <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-primary">Hariri Taarifa</a>
                    @endcan
                    @can('superadmin.users.index')
                        <a href="{{ route('superadmin.users.index') }}" class="btn btn-default">Ghairi</a>
                    @endcan
                </div>

                @role('superadmin')
                    @can('superadmin.users.forceDelete')
                        <div class="float-right mt-4">
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thibitisha Kufuta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Kubofya kitufe cha kufuta kutaondoa mtumiaji huyu milele. Uko tayari?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                            <form action="{{ route('superadmin.users.forceDelete', $user->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Futa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button to trigger the modal -->
                            <button class="btn btn-danger" title="Futa" data-toggle="modal"
                                data-target="#deleteModal{{ $user->id }}">
                                Futa Milele
                            </button>
                        </div>
                    @endcan
                @endrole
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
