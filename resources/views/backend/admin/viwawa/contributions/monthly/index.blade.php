@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Michango ya Mwezi">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header text-white">
                <h4 class="my-1 float-left">Michango ya Mwezi</h4>
                @can('admin.monthly.contributions.index')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <form id="year-form" method="GET" action="{{ route('admin.monthly.contributions.index') }}">
                            <label for="year" class="mr-2 text-white">Chagua Mwaka:</label>
                            <select id="year" name="year" class="form-control"
                                onchange="document.getElementById('year-form').submit();">
                                <option value="">Mwaka</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endcan
                @can('admin.monthly.contributions.create')
                    <div class="btn-group btn-group-md float-right" role="group" style="margin-right: 50px; margin-top: 32px">
                        <a href="{{ route('admin.monthly.contributions.create') }}" class="btn btn-light">
                            <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($months->isEmpty())
                    <div class="alert alert-light text-danger alert-md text-center" role="alert">
                        Hakuna michango iliyopatikana kwa mwaka uliochaguliwa.
                    </div>
                @else
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="table-td-md" style="width: 20%;">Mwezi</th>
                                    <th class="table-td-md">Jina la Mwanachama</th>
                                    <th class="table-td-md">Kiasi Kilicholipwa (TZS)</th>
                                    <th class="table-td-md">Kiasi Kilichosalia (TZS)</th>
                                    <th class="table-td-md not-printable" style="width: 15%;"></th>
                                    <th class="table-td-md not-printable" style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($months as $month => $data)
                                    <tr>
                                        <td colspan="6" class="table-td-md bg-light font-weight-bold text-primary pt-4">
                                            {{ \Carbon\Carbon::createFromDate($currentYear, $month, 1)->format('F Y') }}
                                            <span class="badge badge-secondary badge-size p-2 ml-2">
                                                {{ $data['count'] }} / {{ $data['total_members'] }}
                                            </span>
                                        </td>
                                    </tr>
                                    @foreach ($data['members'] as $contribution)
                                        <tr>
                                            <td></td>
                                            <td class="table-td-md">{{ $contribution->member->user->first_name }}
                                                {{ $contribution->member->user->middle_name }}
                                                {{ $contribution->member->user->last_name }}</td>
                                            <td class="table-td-md">{{ number_format($contribution->total_paid, 2) }}
                                            </td>
                                            <td class="table-td-md">{{ number_format($contribution->remaining_amount, 2) }}</td>
                                            <td class="table-td-md">
                                                <span
                                                    class="badge badge-size {{ strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark' }}">
                                                    {{ strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika' }}
                                                </span>
                                            </td>
                                            <td class="table-td-md">
                                                @can('admin.monthly.contributions.edit')
                                                    <a href="{{ route('admin.monthly.contributions.edit', $contribution->id) }}"
                                                        class="btn btn-outline-secondary btn-md" title="Hariri">
                                                        Hariri
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')

<!-- Custom js -->
@section('js')
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                document.getElementById('year-form').submit();
            });
        });
    </script>
@endsection
