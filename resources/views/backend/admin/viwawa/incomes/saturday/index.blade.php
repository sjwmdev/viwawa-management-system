@extends('backend.layout.master')

<!-- All css -->
@include('backend.components.index.allcss')

@section('meta')
    <meta name="report-title" content="Ripoti ya Mapato ya Jumamosi">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="cardz" style="max-height: 90vh; overflow-y: auto;">
            <div class="card-header">
                <h4 class="my-1 float-left">Mapato ya Jumamosi</h4>
                @can('admin.incomes.store')
                    <div class="btn-group btn-group-md float-right" role="group">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addIncomeModal">
                            <i class="fas fa-plus-circle"></i> Ongeza Mapato
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                @if ($incomes->isEmpty())
                    <!-- No Income Records Message -->
                    <div class="alert alert-light text-danger alert-md" role="alert">
                        Hakuna mapato iliyorekodiwa.
                    </div>
                @else
                    @php
                        $groupedIncomes = $incomes->groupBy('year');
                    @endphp

                    @foreach ($groupedIncomes as $year => $yearIncomes)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4>Mwaka {{ $year }}</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mwezi</th>
                                            <th>Jumla ya Kiasi (TZS)</th>
                                            <th class="not-printable">Vitendo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($yearIncomes as $income)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::create()->month($income->month)->format('F') }}</td>
                                                <td>{{ number_format($income->total_amount, 2) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.incomes.saturday.details', ['year' => $year, 'month' => $income->month]) }}"
                                                        class="btn btn-outline-secondary view-details-btn">
                                                        Mchanganua
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @can('admin.incomes.store')
        <!-- Add Income Modal -->
        <div class="modal fade" id="addIncomeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addIncomeModalLabel">Ongeza Mapato ya Jumamosi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.incomes.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="amount">Kiasi (TZS)</label>
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Tarehe ya Mapato</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <input type="hidden" name="type" value="sadaka ya jumamosi">
                            <input type="hidden" name="income_type_id" value="{{ $incomeTypeId }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Hifadhi</button>
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
