@extends('frontend.layout.master')

@section('title', 'Michango ya Mwezi - Viwawa')

@section('brandtitle', 'Viwawa Mt.Zita')
@section('header', 'Michango ya Kila Mwezi')

@section('chaguamwaka')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownYear" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">
                Chagua Mwaka
            </a>
            <ul aria-labelledby="dropdownYear" class="dropdown-menu border-0 shadow">
                <form id="yearForm" method="GET" action="{{ route('frontend.viwawa.contributions.monthly.index') }}">
                    @for ($i = now()->year; $i >= now()->year - 4; $i--)
                        <li>
                            <a href="javascript:void(0)" onclick="selectYear({{ $i }})"
                                class="dropdown-item {{ request('year', now()->year) == $i ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
                    <!-- Hidden input to store selected year -->
                    <input type="hidden" name="year" id="selectedYear" value="{{ request('year', now()->year) }}">
                </form>
            </ul>
        </li>
    </ul>
@endsection

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Title Message -->
    <div class="alert alert-light mb-3">
        @if (request('year') && request('month'))
            <strong>Onyesho:</strong> Michango ya mwezi
            {{ \Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F') }}
            mwaka {{ request('year') }}.
        @elseif (request('year'))
            <strong>Onyesho:</strong> Michango ya mwezi kwa mwaka {{ request('year') }}.
        @else
            <strong>Onyesho:</strong> Michango ya kila mwezi ya mwanachama.
        @endif
    </div>

    <div class="card elevation-1">
        <div class="card-body">
            <!-- Month Filter Buttons -->
            <div class="month-filter-container mb-4">
                @php
                    $months = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Machi',
                        '04' => 'Aprili',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Julai',
                        '08' => 'Agosti',
                        '09' => 'Septemba',
                        '10' => 'Oktoba',
                        '11' => 'Novemba',
                        '12' => 'Desemba',
                    ];
                @endphp
                @foreach ($months as $num => $monthName)
                    <a href="{{ route('frontend.viwawa.contributions.monthly.index', ['year' => request('year', now()->year), 'month' => $num]) }}"
                        class="btn btn-outline-secondary {{ request('month') == $num ? 'btn-primary text-white' : '' }}">
                        {{ $monthName }}
                    </a>
                @endforeach
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="border: none;">#</th>
                            <th class="text-nowrap" style="border: none;">Jina la Mwanachama</th>
                            @if (!request('month'))
                                <!-- Display all month columns if no month is selected -->
                                @foreach ($months as $num => $monthName)
                                    <th style="border: none;">{{ mb_substr($monthName, 0, 3) }}</th>
                                    <!-- Abbreviated month names -->
                                @endforeach
                            @else
                                <!-- Display only the selected month if a month is selected -->
                                <th style="border: none;">
                                    {{ \Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F') }}
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributions as $member => $contributionByMonth)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $member }}</td>
                                @if (!request('month'))
                                    <!-- Display contributions for all months -->
                                    @foreach ($months as $num => $month)
                                        <td>
                                            {{ isset($contributionByMonth[$num]) ? number_format($contributionByMonth[$num], 2) : '' }}
                                        </td>
                                    @endforeach
                                @else
                                    <!-- Display only the contribution for the selected month -->
                                    <td>
                                        {{ isset($contributionByMonth[request('month')]) ? number_format($contributionByMonth[request('month')], 2) : '' }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables JS -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Swahili.json",
                    "search": "Tafuata Jina lako: ",
                }
            });
        });
    </script>
@endsection
