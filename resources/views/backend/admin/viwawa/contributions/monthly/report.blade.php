@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('title', 'Ripoti ya Michango ya Mwezi')

@section('content')
    <div class="container-fluid">
        <div class="card mx-auto" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header text-white">
                <h4 class="my-1 float-left">Ripoti ya Michango ya Mwezi</h4>
                <div class="float-right">
                    <form id="year-form" method="GET" action="{{ route('admin.monthlz.contributions.report') }}">
                        <label for="year" class="mr-2 text-white">Chagua Mwaka:</label>
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
                @if ($contributions->isEmpty())
                    <div class="alert alert-light text-danger text-center" role="alert">
                        Hakuna michango ya mwezi kwa mwaka ulioteuliwa.
                    </div>
                @else
                    @foreach ($contributions->groupBy('member.user.full_name') as $memberName => $memberContributions)
                        <h5 class="font-weight-bold pt-4 pb-2">{{ $memberName }}</h5>
                        @foreach ($memberContributions->groupBy('year') as $year => $yearContributions)
                            <table class="table table-hover table-lg">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="table-td-md" style="width: 20%;">Mwezi</th>
                                        <th class="table-td-md">Kiasi Kilicholipwa (TZS)</th>
                                        <th class="table-td-md">Kiasi Kilichobaki (TZS)</th>
                                        <th class="table-td-md not-printable" style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearContributions as $contribution)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::create()->month($contribution->month)->format('F') }}
                                            </td>
                                            <td class="table-td-md">
                                                {{ number_format($contribution->total_paid, 2) }}</td>
                                            <td class="table-td-md">
                                                {{ number_format($contribution->remaining_amount, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-size {{ strtolower($contribution->status) == 'completed' ? 'badge-success' : 'badge-warning text-dark' }}">
                                                    {{ strtolower($contribution->status) == 'completed' ? 'Amekamilisha' : 'Hajakamilika' }}
                                                </span>
                                            </td>
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
