@extends('backend.layout.master')

<!-- All show css -->
@include('backend.components.show.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="my-1">Maelezo ya Mwanachama</h4>

                    <div class="btn-group btn-group-md ml-auto" role="group">
                        @can('admin.members.index')
                            <a href="{{ route('admin.members.index') }}" class="btn btn-outline-light"
                                title="Orodha ya Wanachama Wote">
                                <i class="fas fa-fw fa-th-list" aria-hidden="true"></i>&nbsp;Rudi kwenye Orodha
                            </a>
                        @endcan
                        @can('admin.members.edit')
                            <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-outline-light">
                                <i class="fas fa-fw fa-edit" aria-hidden="true"></i>&nbsp;Sasisha Taarifa
                            </a>
                        @endcan
                    </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <fieldset>
                    <legend>Taarifa Binafsi</legend>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Jina Kamili:</b> {{ ucwords($member->user->full_name) }}</li>
                        <li class="list-group-item"><b>Barua Pepe:</b> {{ $member->user->email ?? 'N/A' }}</li>
                        <li class="list-group-item"><b>Namba ya Simu:</b> {{ $member->user->phone_number }}</li>
                        <li class="list-group-item"><b>Nenosiri:&nbsp;</b><span
                                class="text-danger">{{ $member->user->getPasswordStatus($member->user->password) }}</span>
                        </li>
                        @if (auth()->user()->hasRole('superadmin'))
                            <li class="list-group-item"><b>Majukumu:</b>
                                @foreach ($member->user->roles as $role)
                                    <span class="badge p-2 ml-2" style="background-color: var(--matisse); font-size: 1rem">
                                        <a href="{{ route('superadmin.roles.show', $role->id) }}"
                                            class="text-white">{{ $role->name }}</a>
                                    </span>
                                @endforeach
                            </li>
                        @else
                            <li class="list-group-item"><b>Majukumu:</b>
                                @foreach ($member->user->roles as $role)
                                    <span class="badge p-2 ml-2 text-white"
                                        style="background-color: var(--matisse); font-size: 1rem">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </li>
                        @endif
                    </ul>
                </fieldset>

                <fieldset>
                    <legend>Taarifa za Mwanachama</legend>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Jinsia:</b> {{ $member->gender == 'male' ? 'Kiume' : 'Kike' }}</li>
                        <li class="list-group-item"><b>Makazi:</b> {{ $member->residence }}</li>
                        <li class="list-group-item"><b>Kazi:</b> {{ ucwords($member->occupation) }}</li>
                        <li class="list-group-item"><b>Hali ya Ndoa:</b>
                            @if ($member->family_status == 'married')
                                Ndoa
                            @elseif($member->family_status == 'divoced')
                                Talaka
                            @elseif($member->family_status == 'widowed')
                                Mjane/Mgane
                            @else
                                Hajaoa/Hajaolewa
                            @endif
                        </li>
                        <li class="list-group-item"><b>Hali ya Uwanachama:</b>
                            @if ($member->presence_status == 'active')
                                Hai
                            @else
                                Si Hai
                            @endif
                        </li>
                    </ul>
                </fieldset>

                <fieldset>
                    <legend>Michango ya Mwezi ya Mwanachama</legend>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Mwezi</th>
                                    <th>Kiasi Kilicholipwa (TZS)</th>
                                    <th>Kiasi Kilichobaki (TZS)</th>
                                    <th>Hali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member->contributions as $contribution)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($contribution->date)->format('M') }}</td>
                                        <td>{{ number_format($contribution->paid_amount, 2) }}</td>
                                        <td>{{ number_format($contribution->remaining_amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge badge-size {{ strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark' }}">
                                                {{ strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilisha' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </fieldset>

                @role('admin')
                    <fieldset>
                        <legend> Taarifa za ukaguzi</legend>
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <div class="col-12" id="accordion">
                                    <div class="cardz">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                                            <div class="card-header" style="background-color: var(--iron)">
                                                <h4 class="card-title w-100">
                                                    <i class="fa fa-arrow-circle-down fa-md text-dark"></i>
                                                </h4>
                                            </div>
                                        </a>
                                        <div id="collapseNine" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    @if ($member->user && $member->user->creator && $member->user->creator->id != auth()->id())
                                                        <li class="list-group-item"><b>Amesajiliwa na:</b>
                                                            {{ $member->user->creator->full_name ?? '-' }}</li>
                                                    @endif
                                                    <li class="list-group-item"><b>Mwanachama
                                                        Tangu:</b>&nbsp;{{ $member->user->created_at ?? '-' }},
                                                        {{ $member->user->created_at_human ?? '-' }}</li>
                                                    @if ($member->user && $member->user->updater && $member->user->updater->id != auth()->id())
                                                        <li class="list-group-item"><b>Imesasishwa na:</b>
                                                            {{ $member->user->updater->full_name ?? '-' }}</li>
                                                    @endif
                                                    <li class="list-group-item"><b>Imesasishwa:</b>&nbsp;{{ $member->user->updated_at ?? '-' }},
                                                        {{ $member->user->updated_at_human ?? '-' }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /.content -->
                    </fieldset>
                @endrole

                <div class="float-left ml-4 mt-2">
                    @can('admin.members.edit')
                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-primary"><i
                                class="fa fa-edit fa-md"></i>&nbsp;&nbsp;Sasisha Taarifa</a>
                    @endcan
                </div>

                @role('admin')
                    @can('admin.members.forceDelete')
                        <div class="float-right mt-4 mr-2">
                            <div class="modal fade" id="deleteModal{{ $member->id }}" tabindex="-1"
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
                                            Kubofya kitufe cha kufuta kutaondoa mwanachama huyu milele. Uko tayari?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ghairi</button>
                                            <form action="{{ route('admin.members.forceDelete', $member->id) }}" method="post">
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
                                data-target="#deleteModal{{ $member->id }}">
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

<!-- Custom js -->
{{-- @section('js')
    <script>
        $(document).ready(function() {
            @if (session('success'))
                alert('{{ session('success') }}');
            @endif
        });
    </script>
@endsection --}}
