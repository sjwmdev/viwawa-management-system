@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('title', 'Ripoti ya Michango ya Mwezi')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="my-1 float-left">Ripoti ya Michango ya Mwezi</h4>
            <div class="float-right">
                <form id="year-form" method="GET" action="{{ route('admin.monthlz.contributions.report') }}">
                    <label for="year" class="mr-2">Chagua Mwaka:</label>
                    <select id="year" name="year" class="form-control"
                            onchange="document.getElementById('year-form').submit();">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if($contributions->isEmpty())
                <div class="alert alert-light text-danger" role="alert">
                    Hakuna michango ya mwezi kwa mwaka ulioteuliwa.
                </div>
            @else
                @foreach($contributions->groupBy('member.user.full_name') as $memberName => $memberContributions)
                    <h4 class="pt-4 pb-2">{{ $memberName }}</h4>
                    @foreach($memberContributions->groupBy('year') as $year => $yearContributions)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Mwezi</th>
                                <th>Kiasi Kilicholipwa (TZS)</th>
                                <th>Kiasi Kilichobaki (TZS)</th>
                                <th class="not-printable" width="13%">Hali</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($yearContributions as $contribution)
                                <tr>
                                    <td>{{ \Carbon\Carbon::create()->month($contribution->month)->format('F') }}</td>
                                    <td>{{ number_format($contribution->total_paid, 0, ',', '.') }}</td>
                                    <td>{{ number_format($contribution->remaining_amount, 0, ',', '.') }}</td>
                                    <td>{{ strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endforeach
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
