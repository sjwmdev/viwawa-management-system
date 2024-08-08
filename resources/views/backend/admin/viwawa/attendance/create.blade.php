@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mahudhurio ya Wanachama</h4>
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

                    <!-- Attendance Form -->
                    <form action="{{ route('admin.attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" value="{{ $date }}" id="hiddenDate">

                        <!-- Buttons to Mark All Attendance -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-light" id="mark-all-present">
                                    <i class="fas fa-check fa-md text-success"></i> &nbsp;Wote Wamehudhuria
                                </button>
                                <button type="button" class="btn btn-light" id="mark-all-absent">
                                    <i class="fas fa-times fa-md text-danger"></i> &nbsp;Wote Hawajahudhuria
                                </button>
                            </div>
                        </div>

                        <!-- Members Table -->
                        <div class="table-responsive">
                            <table id="datatable" class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jina la Mwanachama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="attendance[{{ $member->id }}][present]" value="1"
                                                    {{ isset($attendances[$member->id]) && $attendances[$member->id]->present ? 'checked' : '' }}>
                                                <input type="hidden" name="attendance[{{ $member->id }}][member_id]" value="{{ $member->id }}">
                                            </td>
                                            <td>{{ $member->user->full_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @can('admin.attendance.store')
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-block btn-primary">Hifadhi Mahudhurio</button>
                            </div>
                        @endcan
                    </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        const markAllPresentButton = document.getElementById('mark-all-present');
        const markAllAbsentButton = document.getElementById('mark-all-absent');
        const dateField = document.getElementById('date');
        const hiddenDateField = document.getElementById('hiddenDate');

        markAllPresentButton.addEventListener('click', function() {
            document.querySelectorAll('input[name^="attendance["][type="checkbox"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        });

        markAllAbsentButton.addEventListener('click', function() {
            document.querySelectorAll('input[name^="attendance["][type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        });

        dateField.addEventListener('change', function() {
            hiddenDateField.value = this.value;
        });
    });

    $(function() {
        $("#datatable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
