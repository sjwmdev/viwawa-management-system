@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: var(--matisse); color: white;">
                <h4 class="my-1 float-left">Michango Mwezi
                    {{ \Carbon\Carbon::createFromDate($year, $month, 1)->format('F Y') }}</h4>
                @can('admin.monthly.contributions.index')
                    <a href="{{ route('admin.monthly.contributions.index') }}" class="btn btn-outline-light float-right">Rudi</a>
                @endcan
            </div>
            <div class="card-body">
                @if ($contributions->isNotEmpty())
                    <table id="datatable" class="table table-hover p-2">
                        <thead>
                            <tr>
                                <th width="5%">Namba</th>
                                <th>Jina la Mwanachama</th>
                                <th>Kiasi Kilicholipwa (TZS)</th>
                                <th>Kiasi Kilichobaki (TZS)</th>
                                <th>Hali</th>
                                <th>Tarehe ya Michango</th>
                                <th class="not-printable">Hariri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contributions as $contribution)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('admin.members.show', $contribution->member->id) }}"
                                            class="text-dark"
                                            title="Tazama taarifa">{{ $contribution->member->user->full_name }}</a></td>
                                    <td>{{ number_format($contribution->paid_amount, 2) }}</td>
                                    <td>{{ number_format($contribution->remaining_amount, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge {{ strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark' }}">
                                            {{ strtolower($contribution->status) == 'completed' ? 'Imekamilisha' : 'Hajakamilisha' }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($contribution->date)->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.monthly.contributions.edit', $contribution->id) }}"
                                            class="btn btn-sm btn-outline-secondary" title="Hariri">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Jumla:</th>
                                <th>{{ number_format($totalPaidAmount, 2) }} TZS</th>
                                <th>{{ number_format($totalRemainingAmount, 2) }} TZS</th>
                                <th colspan="3"></th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Jumla ya Kiasi Kinachotarajiwa:</th>
                                <th colspan="3">{{ number_format($overallExpectedAmount, 2) }} TZS</th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <!-- No Monthly Contributions Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyopatikana kwa mwezi uliochaguliwa.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
