@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Rekodi za Mfumo">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="h4">Rekodi za Mfumo</h4>
                    </div>
                    <div class="card-body">
                        @if ($logs->isEmpty())
                            <div class="alert alert-light text-danger" role="alert">
                                Hakuna rekodi zilizopatikana.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kitendo</th>
                                            <th>Mtumiaji</th>
                                            <th>Jedwali</th>
                                            <th>Maelezo</th>
                                            <th>Tarehe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td>{{ ucfirst($log->action) }}</td>
                                                <td>{{ $log->user ? $log->user->name : 'N/A' }}</td>
                                                <td>{{ $log->table_name }}</td>
                                                <td>
                                                    <button class="btn btn-link" data-toggle="modal"
                                                        data-target="#logModal{{ $log->id }}">
                                                        Tazama Zaidi
                                                    </button>
                                                    <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="logModalLabel{{ $log->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="logModalLabel{{ $log->id }}">Maelezo ya
                                                                        Rekodi</h5>
                                                                    <button type="button" class="close text-white"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Kitendo:</strong> {{ ucfirst($log->action) }}
                                                                    </p>
                                                                    <p><strong>Mtumiaji:</strong>
                                                                        {{ $log->user ? $log->user->name : 'N/A' }}</p>
                                                                    <p><strong>Jedwali:</strong> {{ $log->table_name }}</p>
                                                                    <p><strong>Taarifa za Zamani:</strong></p>
                                                                    <pre>{{ json_encode(array_diff_key(json_decode($log->old_data, true) ?? [], array_flip(['password', 'rsvd_1', 'rsvd_2', 'rsvd_3', 'rsvd_4', 'rsvd_5'])), JSON_PRETTY_PRINT) }}</pre>
                                                                    <p><strong>Taarifa Mpya:</strong></p>
                                                                    <pre>{{ json_encode(array_diff_key(json_decode($log->new_data, true) ?? [], array_flip(['password', 'rsvd_1', 'rsvd_2', 'rsvd_3', 'rsvd_4', 'rsvd_5'])), JSON_PRETTY_PRINT) }}</pre>
                                                                    <p><strong>Ombi URL:</strong> {{ $log->request_url }}
                                                                    </p>
                                                                    <p><strong>Njia ya Ombi:</strong>
                                                                        {{ $log->request_method }}</p>
                                                                    <p><strong>Namba ya Hali:</strong>
                                                                        {{ $log->status_code }}
                                                                    </p>
                                                                    <p><strong>Anwani ya Mbali:</strong>
                                                                        {{ $log->remote_address }}</p>
                                                                    <p><strong>Njia:</strong> {{ $log->path }}</p>
                                                                    <p><strong>Mwenyeji:</strong> {{ $log->host }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Funga</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Custom css -->
@section('css')
    <style>
        .card-body p {
            margin-bottom: 0.5rem;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }
    </style>
@endsection

<!-- All js -->
@include('backend.components.index.alljs')
