@extends('backend.layout.master')

@section('content')
    <div class="container-fluid">
        <!-- Welcome message after login -->
        @session('success')
            <div class="row mt-0">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5 class="alert-heading">Karibu kwenye Dashibodi ya Msimamizi!</h5>
                    </div>
                </div>
            </div>
        @endsession

        @can('admin.monthly.contributions.details')
            <!-- Calendar -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h3 class="card-title">Ripoti ya Fedha za Michango ya Kila Mwezi</h3>
                        </div>
                        <div class="card-body">
                            <!-- Calendar goes here -->
                            <div id="calendar" style="width: 100%; height: 800px; margin: 0; padding: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

    </div>
@endsection

<!-- Custom css -->
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/main.min.css') }}">
    <style>
        .card-body {
            padding: 0;
        }

        #calendar {
            background: #ffffff;
            border: 1px solid #d3d3d3;
            box-shadow: 0 2px 4px rgba(221, 218, 218, 0.1);
            border-radius: 5px;
            height: 100% !important;
        }

        .card-header {
            border-bottom: 1px solid #dee2e6;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .fc-toolbar {
            margin-bottom: 10px;
        }

        .fc-event {
            font-size: 1.2em;
            background-color: var(--mystic-grey);
            color: white;
            padding: 5px;
            border: 1px solid var(--mystic-grey);
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
@endsection

<!-- All js -->
@section('js')
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fullcalendar/main.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                events: function(fetchInfo, successCallback, failureCallback) {
                    var events = [
                        @foreach ($monthlyContributions as $contribution)
                            {
                                title: 'Kiasi: {{ number_format($contribution->total_amount, 0) }} TZS - Wanachama: {{ $contribution->member_count }}',
                                start: '{{ $contribution->month }}-01',
                                url: '{{ route('admin.monthly.contributions.details', ['year' => substr($contribution->month, 0, 4), 'month' => substr($contribution->month, 5, 2)]) }}'
                                    .replace(/&amp;/g, '&')
                            },
                        @endforeach
                    ];
                    successCallback(events);
                },
                contentHeight: 'auto',
                eventDidMount: function(info) {
                    // Ensure no duplication of title
                    if (!info.el.classList.contains('title-processed')) {
                        var titleHtml = info.el.querySelector('.fc-event-title');
                        if (titleHtml) {
                            var lines = info.event.title.split(' - ');
                            titleHtml.innerHTML = lines.map(line => `<div>${line}</div>`).join('');
                        }
                        info.el.classList.add('title-processed');
                    }
                },
                eventClick: function(info) {
                    // Prevent the default browser behavior for clicking an event
                    info.jsEvent.preventDefault();

                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection
