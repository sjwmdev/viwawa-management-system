@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Michango ya Mwezi">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="cardz mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Michango ya Mwezi</h4>
                @can('admin.monthly.contributions.index')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <form id="year-form" method="GET" action="{{ route('admin.monthly.contributions.index') }}">
                            <label for="year" class="mr-2">Chagua Mwaka:</label>
                            <select id="year" name="year" class="form-control"
                                onchange="document.getElementById('year-form').submit();">
                                <option value="">Mwaka</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endcan
                @can('admin.monthly.contributions.create')
                    <div class="btn-group btn-group-md float-right" role="group" style="margin-right: 50px;">
                        <a href="{{ route('admin.monthly.contributions.create') }}" class="btn btn-light"><i
                                class="fa fa-plus-circle"></i>&nbsp;&nbsp;Ongeza Mchango</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($months->isEmpty())
                    <!-- No Monthly Contributions Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna michango iliyopatikana kwa mwaka uliochaguliwa.
                    </div>
                @else
                    @foreach ($months as $month => $data)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4>{{ \Carbon\Carbon::createFromDate($currentYear, $month, 1)->format('F Y') }}&nbsp;&nbsp;
                                    <span class="badge badge-secondary p-1">{{ $data['count'] }} /
                                        {{ $data['total_members'] }}</span> {{-- Wachangiaji --}}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Jina la Mwanachama</th>
                                                <th>Kiasi Kilicholipwa (TZS)</th>
                                                <th>Kiasi Kilichosalia (TZS)</th>
                                                <th class="not-printable" width="13%">Hali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['members'] as $contribution)
                                                <tr>
                                                    <td>{{ $contribution->member->user->first_name }}
                                                        {{ $contribution->member->user->middle_name }}
                                                        {{ $contribution->member->user->last_name }}</td>
                                                    <td>{{ number_format($contribution->total_paid, 2) }} TZS</td>
                                                    <td>{{ number_format($contribution->remaining_amount, 2) }} TZS</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-size {{ strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark' }}">
                                                            {{ strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @can('admin.monthly.contributions.details')
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <a href="{{ route('admin.monthly.contributions.details', ['year' => $contribution->year, 'month' => $contribution->month]) }}"
                                                            class="btn btn-outline-secondary tfooter-mr btn-sm">Tazama
                                                            Maelezo</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        @endcan
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
