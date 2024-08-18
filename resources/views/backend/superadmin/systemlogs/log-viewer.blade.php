@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="my-1 float-left">System Logs</h4>
                <div class="btn-group btn-group-md float-right" role="group">
                    <a href="{{-- {{ route('superadmin.system.logs.delete') }} --}}" class="btn btn-outline-light" title="Download Logs">
                        <i class="fas fa-md fa-trash"></i>&nbsp;&nbsp;Delete All Logs
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('superadmin.system.logs.filter') }}" method="POST" class="mb-4" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select name="level" class="form-control">
                                <option value="">Select Log Level</option>
                                <option value="ERROR">Error</option>
                                <option value="INFO">Info</option>
                                <option value="DEBUG">Debug</option>
                                <option value="WARNING">Warning</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="mb-4"></div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Date</th>
                                <th>Level</th>
                                <th>Context</th>
                                <th>Message</th>
                                <th class="not-printable" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $key => $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::createFromDate($log['date'])->format('d F Y') }}</td>
                                    <td>{{ $log['level'] }}</td>
                                    <td>{{ $log['context'] }}</td>
                                    <td>{{ $log['message'] }}</td>
                                    <td>
                                        <div class="btn-group btn-group-md" role="group">
                                            <button class="btn btn-outline-secondary" title="View Details"
                                                data-toggle="modal" data-target="#viewModal{{ $key }}">
                                                View
                                            </button>
                                        </div>

                                        <!-- View Modal -->
                                        <div class="modal fade" id="viewModal{{ $key }}" tabindex="-1"
                                            aria-labelledby="viewModalLabel{{ $key }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel{{ $key }}">Log
                                                            Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <pre>{{ print_r($log, true) }}</pre>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No logs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
