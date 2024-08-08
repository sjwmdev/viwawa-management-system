@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Mahudhurio ya Jumuiya">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="max-height: 90vh; overflow-y: auto;">
                <div class="card-header">
                    <h4>Mahudhurio ya Jumuiya</h4>
                    @can('admin.attendance.create')
                        <a href="{{ route('admin.attendance.create') }}" class="btn btn-light float-right"><i class="fa fa-calendar-alt fa-md"></i>&nbsp;&nbsp;Ongeza Mahudhurio</a>
                    @endcan
                </div>
                <div class="card-body">
                    @can('admin.attendance.index')
                        <!-- Date Selection Form -->
                        <form action="{{ route('admin.attendance.index') }}" method="GET" class="mb-4">
                            <div class="form-group">
                                <label for="date">Chagua Jumamosi ya Mwezi</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $date }}">
                            </div>
                            <button type="submit" class="btn btn-primary col-md-2">Tafuta</button>
                        </form>
                    @endcan

                    @if(!$attendances->isEmpty())
                        <!-- Attendance Summary -->
                        <div class="mb-4 d-flex justify-content-between">
                            <p><strong>Waliohudhuria:</strong> {{ $presentCount }} / {{ $totalMembers }}</p>
                            <p><strong>Wasiohudhuria:</strong> {{ $absentCount }}</p>
                        </div>
                        
                        <!-- Icon Information -->
                        <div class="mb-4">
                            <p><i class="fas fa-check text-success"></i> Mwanachama ame/alihudhuria</p>
                            <p><i class="fas fa-times text-danger"></i> Mwanachama ame/hakuhudhuria</p>
                        </div>

                        <!-- Attendance Table -->
                        <div class="table-responsive">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Jina la Mwanachama</th>
                                        <th>Mahudhurio</th>
                                        <th class="not-printable" width="25%">Badilisha Mahudhurio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $member->user->full_name }}</td>
                                            <td>
                                                @if(isset($attendances[$member->id]))
                                                    @if($attendances[$member->id]->present)
                                                        <i class="fas fa-check text-success"></i> <!-- Tick mark for present -->
                                                    @else
                                                        <i class="fas fa-times text-danger"></i> <!-- Cross mark for absent -->
                                                    @endif
                                                @else
                                                    <i class="fas fa-times text-danger"></i> <!-- Cross mark for absent if no record -->
                                                @endif
                                            </td>
                                            @can('admin.attendance.update')
                                                <td>
                                                    @if(isset($attendances[$member->id]))
                                                        <form action="{{ route('admin.attendance.update', $attendances[$member->id]->id) }}" method="POST" class="update-form">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="present" class="form-control update-attendance" data-id="{{ $attendances[$member->id]->id }}">
                                                                <option value="1" {{ $attendances[$member->id]->present ? 'selected' : '' }}>Alihudhuria</option>
                                                                <option value="0" {{ !$attendances[$member->id]->present ? 'selected' : '' }}>Hakuhudhuria</option>
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- No Attendance Records Message -->
                        <div class="alert alert-light text-danger" role="alert">
                            Hakuna mahudhurio yaliyoandikishwa kwa tarehe ya Jumamosi uliyochagua.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <!-- DataTables JS -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.update-attendance').forEach(function(select) {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
    });
</script>
@endsection
