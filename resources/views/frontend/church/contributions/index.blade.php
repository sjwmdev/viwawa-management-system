@extends('frontend.layout.master')

@section('title', 'Michango ya Ujenzi')

@section('header', 'Michango ya Ujenzi wa Kanisa')

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Title Message -->
    <div class="alert alert-light mb-3">
        @if (request('year') && request('month'))
            <strong>Onyesho:</strong> Michango ya Ujenzi wa Kanisa kwa mwezi
            {{ \Carbon\Carbon::createFromFormat('m', request('month'))->locale('sw')->translatedFormat('F') }}
            {{ request('year') }}.
        @elseif (request('year'))
            <strong>Onyesho:</strong> Michango ya Ujenzi wa Kanisa kwa mwaka {{ request('year') }}.
        @else
            <strong>Onyesho:</strong> Michango yote ya Ujenzi wa Kanisa.
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
                    <a href="{{ route('frontend.church.contributions.index', ['year' => request('year', now()->year), 'month' => $num]) }}"
                        class="btn btn-outline-secondary {{ request('month') == $num ? 'btn-primary text-white' : '' }}">
                        {{ $monthName }}
                    </a>
                @endforeach
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-borderless table-condensed table-hover elevation-top-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jina la Familia</th>
                            <th>Kiasi (TZS)</th>
                            @if (!request('month'))
                                <!-- Only show 'Mwezi' column if 'month' query is not present -->
                                <th>Mwezi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contributions as $contribution)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contribution->family_name }}</td>
                                <td>{{ number_format($contribution->amount, 2) }}</td>
                                @if (!request('month'))
                                    <!-- Display the month name in Swahili -->
                                    <td>{{ \Carbon\Carbon::create()->month($contribution->month)->locale('sw')->translatedFormat('F') }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- <!-- Share Button -->
            <p class="mt-3">
                <button class="btn btn-sm btn-primary" id="shareButton">
                    <i class="fas fa-share-alt"></i> Shiriki Rekodi
                </button>
            </p> --}}
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables JS -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                "paging": true,
                "pageLength": 10, // Show 10 entries per page
                "lengthChange": false, // Disable the ability to change the number of records per page
                "searching": false, // Enable search
                "ordering": false, // Disable ordering
                "info": false, // Hide info
                "autoWidth": false, // Disable automatic column width calculation
                "responsive": true, // Make table responsive
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Swahili.json",
                    "search": "Tafuta Jina la Familia"
                }
            });

            // Handle share button functionality
            $('#shareButton').click(function() {
                if (navigator.share) {
                    navigator.share({
                        title: 'Michango ya Ujenzi wa Kanisa',
                        text: 'Angalia michango ya ujenzi wa kanisa Jumuiya ya Mt. Zita.',
                        url: window.location.href
                    }).then(() => {
                        console.log('Successfully shared');
                    }).catch((error) => {
                        console.error('Error sharing:', error);
                    });
                } else {
                    alert('Kisakuzi chako hakiungi mkono kushiriki moja kwa moja.');
                }
            });
        });
    </script>
@endsection
