@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Orodha ya Wanachama Waliosajiliwa Kwenye Mfumo">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Orodha ya Wanachama</h4>
                @can('admin.members.create')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <a href="{{ route('admin.members.create') }}" class="btn btn-outline-light" title="Ongeza Mwanachama Mpya">
                            <i class="fas fa-fw fa-plus-circle" aria-hidden="true"></i>
                            Sajili Mwanachama Mpya
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-body datatable_wrapper">
                <div class="table-responsive">
                    <table id="datatable" class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">Namba.</th>
                                <th>Jina</th>
                                <th>Jinsia</th>
                                <th>Makazi</th>
                                <th>Hali ya Ndoa</th>
                                <th>Hali ya Uwanachama</th>
                                <th class="not-printable" width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($member->user->full_name) }}</td>
                                    <td>{{ $member->gender == 'male' ? 'Kiume' : 'Kike' }}</td>
                                    <td>{{ $member->residence }}</td>
                                    <td>
                                        @if ($member->family_status == 'married')
                                            Ndoa
                                        @elseif($member->family_status == 'divoced')
                                            Talaka
                                        @elseif($member->family_status == 'widowed')
                                            Mjane/Mgane
                                        @else
                                            Ameoa/Ameolewa
                                        @endif
                                    </td>
                                    <td>
                                        @if ($member->presence_status == 'active')
                                            Hai
                                        @else
                                            Si Hai
                                        @endif
                                    </td>
                                    <td>
                                        @can('admin.members.show')
                                            <a href="{{ route('admin.members.show', $member->id) }}"
                                                class="btn btn-outline-secondary btn-md" title="Tazama">
                                                Tazama Zaidi
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
