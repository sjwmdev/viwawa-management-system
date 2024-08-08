@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Matumizi ya Mfuko">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Matumizi ya Mfuko</h4>
                @can('admin.expenditures.store')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addMatumiziModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Matumizi
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($expenditures->isEmpty())
                    <!-- No Expenditures Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna matumizi yaliyorekodiwa.
                    </div>
                @else
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tarehe</th>
                                <th>Maelezo</th>
                                <th>Kiasi (TZS)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenditures as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ number_format($item->amount, 2) }} TZS</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Jumla ya Matumizi:</strong></td>
                                <td><strong>{{ number_format($totalAmount, 2) }} TZS</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>

    @can('admin.expenditures.store')
        <!-- Add Matumizi Modal -->
        <div class="modal fade" id="addMatumiziModal" tabindex="-1" role="dialog" aria-labelledby="addMatumiziModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMatumiziModalLabel">Ongeza Matumizi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.expenditures.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="amount">Kiasi (TZS)</label>
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Maelezo</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Tarehe ya Matumizi</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Funga</button>
                            <button type="submit" class="btn btn-primary">Hifadhi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

<!-- All js -->
@include('backend.components.index.alljs')

<!-- Custom css -->
@section('css')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .view-details-btn {
            margin-left: 10px;
        }
    </style>
@endsection
